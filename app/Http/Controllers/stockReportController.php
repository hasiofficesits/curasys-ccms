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
}
