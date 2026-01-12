<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TblStockPharma;
use App\Models\TblSupplier;
use App\Models\TblStockPharmaCategory;
use App\Models\TblStockPharmaGroup;
use App\Models\TblStockPharmaLot;
use DB;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\StockSummaryReportExport;
use App\Exports\ExpiredStockLotExport;

use Yajra\DataTables\Facades\DataTables;

class stockReportController extends Controller
{

    // STOCK SUMMARY REPORT
    public function load_current_stock_report(Request $request)
    {
        return view('reports.stock.current-stock');
    }

    public function load_stock_report_grid(Request $request)
    {
        $keyword = $request->search["value"] ?? null;
        $itemId = $request->pharma_item;
        $supplierId = $request->pharma_supplier;

        if ($request->ajax()) {
            $query = TblStockPharma::with(['category', 'suplier']);

            // Apply filters
            if (!empty($itemId)) {
                $query->where('ID', $itemId);
            }

            if (!empty($supplierId)) {
                $query->where('FKSupplier_ID', $supplierId); // adjust column name if different
            }

            // Apply search keyword
            if ($keyword) {
                $query->where(function ($q) use ($keyword) {
                    $q->where("Pharma_name", "LIKE", "%{$keyword}%")
                    ->orWhere("ID", $keyword);
                });
            }

            $stock_data = $query->orderBy('ID', 'ASC')->limit(1000)->get();

            return datatables()->of($stock_data)->toJson();
        }
    }
    public function load_stock_item_to_dropdown(Request $request)
    {
        $stock_items = TblStockPharma::orderBy('ID', 'ASC')->get();
        // dd($stock_items);
        return response()->json($stock_items);
    }
    public function load_supplier_to_dropdown(Request $request)
    {
        $suppliers = TblSupplier::orderBy('ID', 'ASC')->get();
        return response()->json($suppliers);
    }
    public function export_stock_report_excel(Request $request)
    {
        $itemId = $request->pharma_item;
        $supplierId = $request->pharma_supplier;

        $fileName = 'Current_Stock_Summary_Report_' . now()->format('Ymd_His') . '.xlsx';

        return Excel::download(new StockSummaryReportExport($itemId, $supplierId), $fileName);
    }


    // EXPIRED LOT REPORT
    public function load_expred_stock_report(Request $request)
    {
        return view('reports.stock.expired-stock');
    }
    public function load_expired_report_grid(Request $request)
    {
        $keyword = $request->search['value'] ?? null;
        $itemId = $request->pharma_item;
        $supplierId = $request->pharma_supplier;
        $from_date = $request->from_date;
        $to_date = $request->to_date;

        if ($request->ajax()) {
            $query = TblStockPharmaLot::with(['stock_item', 'supplier'])
                ->whereNotNull('Exp_date')
                ->whereDate('Exp_date', '<', now()); // expired stocks

            // Apply filters
            if (!empty($itemId)) {
                $query->where('FKStock_ID', $itemId);
            }

            if (!empty($supplierId)) {
                $query->where('Supplier_ID', $supplierId);
            }

            if (!empty($from_date) && !empty($to_date)) {
                $query->whereBetween('Exp_date', [$from_date, $to_date]);
            }

            if (!empty($keyword)) {
                $query->where(function ($q) use ($keyword) {
                    $q->whereHas('stock_item', function ($q2) use ($keyword) {
                        $q2->where('Pharma_name', 'like', "%{$keyword}%");
                    })->orWhereHas('supplier', function ($q3) use ($keyword) {
                        $q3->where('Company', 'like', "%{$keyword}%");
                    });
                });
            }

            $query->orderBy('Exp_date', 'ASC');

            return DataTables::of($query)
                ->addColumn('stock_item.Pharma_name', fn($row) => $row->stock_item->Pharma_name ?? '-')
                ->addColumn('supplier.Company', fn($row) => $row->supplier->Company ?? '-')
                ->editColumn('Exp_date', function($row) {
                    return $row->Exp_date ? Carbon::parse($row->Exp_date)->format('Y-m-d') : '-';
                })
                ->make(true);
        }
    }
    public function export_expired_lot_stock(Request $request)
    {
        $filters = [
            'pharma_item' => $request->pharma_item,
            'pharma_supplier' => $request->pharma_supplier,
            'from_date' => $request->from_date,
            'to_date' => $request->to_date,
        ];

        $fileName = 'Expired_Stock_Lot_Report_' . now()->format('Ymd_His') . '.xlsx';
        return Excel::download(new ExpiredStockLotExport($filters), $fileName);
    }

    // SALES REPORT
    public function load_sales_report(Request $request)
    {
        return view('reports.stock.sales-report');
    }

    public function load_sales_report_grid(Request $request)
    {
        try {
            $fromDate = $request->from_date;
            $toDate = $request->to_date;
            $status = $request->status;

            $query = DB::table('tblinvoice') // Replace with your actual table name
                ->whereBetween('date', [$fromDate, $toDate]);

            if ($status) {
                $query->where('status', $status);
            }

            $data = $query->orderBy('date', 'desc')->get();

            $summary = [
                'total_gross' => $data->sum('gross'),
                'total_paid' => $data->sum('pay'),
                'total_balance' => $data->sum('balance'),
                'total_count' => $data->count()
            ];

            return response()->json([
                'success' => true,
                'data' => $data,
                'summary' => $summary
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    
    }

    function export_sales_report_excel(Request $request)
    {
        $fromDate = $request->from_date;
        $toDate = $request->to_date;
        $status = $request->status;

        $fileName = 'Sales_Report_' . now()->format('Ymd_His') . '.xlsx';

        return Excel::download(new \App\Exports\SalesReportExport($fromDate, $toDate, $status), $fileName);
    }

    function load_day_report(Request $request)
    {
        return view('reports.stock.day-report');
    }

    function load_day_report_grid(Request $request)
    {
        try {
            $reportDate = $request->report_date ?? $request->from_date;
            
            // Validate date is provided
            if (!$reportDate) {
                return response()->json([
                    'success' => false,
                    'message' => 'Please provide a report date'
                ], 400);
            }

            // Get invoice data for the specific day
            $query = DB::table('tblinvoice')
                ->where('date', $reportDate)
                ->orderBy('invno', 'desc');
            
            $data = $query->get();

            // Calculate summary statistics
            $summary = [
                'total_invoices' => $data->count(),
                'total_amount' => $data->sum('total'),
                'total_discount' => $data->sum('dis_val'),
                'total_net' => $data->sum('net'),
                'total_gross' => $data->sum('gross'),
                'total_paid' => $data->sum('pay'),
                'total_balance' => $data->sum('balance')
            ];

            return response()->json([
                'success' => true,
                'data' => $data,
                'summary' => $summary,
                'report_date' => $reportDate
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    function export_day_report_excel(Request $request)
    {
        try {
            $reportDate = $request->report_date ?? $request->from_date;
            
            // Validate date is provided
            if (!$reportDate) {
                return back()->with('error', 'Please select a date');
            }

            // Format filename with the report date
            $fileName = 'Day_Report_' . date('Ymd', strtotime($reportDate)) . '_' . now()->format('His') . '.xlsx';

            return Excel::download(new \App\Exports\DayReportExport($reportDate), $fileName);
            
        } catch (\Exception $e) {
            return back()->with('error', 'Error exporting report: ' . $e->getMessage());
        }
    }
}
