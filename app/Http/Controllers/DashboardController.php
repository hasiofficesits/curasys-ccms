<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

use App\Models\TblKrStore;
use App\Models\TblKrSupplier;
use App\Models\TblKrSo;
use App\Models\TblKrSoBody;
use App\Models\TblDoctor;
use App\Models\TblPatient;
use App\Models\TblOPDService;
use App\Models\TblSupplier;
use App\Models\TblGrnHead;
use App\Models\TblGrnBody;

use App\Models\TblStockPharma;
use App\Models\TblStockPharmaLot;
use App\Models\TblInvoice;

use Carbon\Carbon;

use App\Models\TblOPDAppointment;
use App\Models\TblKrIssueBody;

class DashboardController extends Controller
{
    public function index()
    {
        return view('index',["stock_item_count"=>$stock_item_count]);
    }

    public function load_management_dashboard()
    {
        // get doctor count
        $doctor_count = TblDoctor::get()->count();
        // get patient count
        $patient_count = TblPatient::get()->count();
        // get OPD service count
        $opd_service_count = TblOPDService::get()->count();
        //  user count
        $user_count = User::get()->count();

        // patient arrival
        $current_year = date('Y');
        $arrived_patients = TblOPDAppointment::selectRaw('MONTH(Date) as month, COUNT(*) as count')
            ->whereYear('Date', $current_year)
            ->where('Status', 'Done')
            ->groupBy('month')
            ->orderBy('month')
            ->get();
        $monthlyCounts = array_fill(1, 12, 0);
        foreach ($arrived_patients as $month => $count) {
            $monthlyCounts[$month] = $count;
        }

        $chartData = array_values($monthlyCounts);

        $doctorSpecialities = TblDoctor::select('Speciality', DB::raw('count(*) as total'))
            ->whereNotNull('Speciality')
            ->where('Speciality', '!=', '')
            ->groupBy('Speciality')
            ->get();

        $specialityLabels = $doctorSpecialities->pluck('Speciality')->toArray();
        $specialityCounts = $doctorSpecialities->pluck('total')->toArray();

        return view('management.dashboard.management-dashboard', 
        compact('doctor_count', 'patient_count', 'opd_service_count', 'user_count', 'chartData', 'specialityLabels', 'specialityCounts'));
    }
    
    public function get_patient_chart_data(Request $request)
    {
        $year = $request->input('year', date('Y'));

        $arrived_patients = TblOPDAppointment::selectRaw('MONTH(Date) as month, COUNT(*) as count')
            ->whereYear('Date', $year)
            // ->where('Status', 'Done')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $monthlyCounts = array_fill(1, 12, 0);
        foreach ($arrived_patients as $item) {
            $monthlyCounts[$item->month] = $item->count;
        }

        return response()->json(array_values($monthlyCounts));
    }

    public function load_stock_dashboard()
    {
        $stock_item_count = TblStockPharma::count();

        $products_list = TblStockPharma::select('ID', 'Pharma_name')->orderBy('Pharma_name')->get();

        $all_stock_items = TblStockPharma::withSum('lots', 'QTY')->get();

        $low_stock_items = $all_stock_items->filter(function ($item) {
            $currentStock = $item->lots_sum_QTY ?? 0;
            $reorderPoint = $item->ReorderLevel ?? 0;
            return $currentStock <= $reorderPoint;
        });

        $low_stock_count = $low_stock_items->count();

        $out_of_stock_count = $all_stock_items->filter(function ($item) {
            $currentStock = $item->lots_sum_QTY ?? 0;
            return $currentStock <= 0;
        })->count();

        $dosage_distribution = \Illuminate\Support\Facades\DB::table('tblstock_pharma')
            ->select('DosageType', \Illuminate\Support\Facades\DB::raw('count(*) as total'))
            ->whereNotNull('DosageType')
            ->where('DosageType', '!=', '')
            ->groupBy('DosageType')
            ->get();

        $dosageLabels = $dosage_distribution->pluck('DosageType')->toArray();
        $dosageCounts = $dosage_distribution->pluck('total')->toArray();

        return view('stock.dashboard.stock-dashboard', 
        compact('stock_item_count', 'low_stock_count', 'out_of_stock_count', 'products_list', 'dosageLabels', 'dosageCounts'));
    }

    public function get_lot_chart_data(Request $request)
    {
        $productId = $request->input('product_id');

        $lots = \Illuminate\Support\Facades\DB::table('tblstock_pharma_lot')
            ->where('FKStock_ID', $productId)
            ->select('Batch', 'QTY')
            ->get();

        $labels = $lots->map(function($item) {
            return empty($item->Batch) ? 'No Batch' : $item->Batch;
        })->toArray();

        $data = $lots->map(function($item) {
            return (float) ($item->QTY ?? 0);
        })->toArray();

        return response()->json([
            'labels' => $labels,
            'data' => $data
        ]);
    }

    public function load_cashier_dashboard()
    {
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        $monthly_channel_income = TblInvoice::whereYear('date', $currentYear)
        ->whereMonth('date', $currentMonth)
        ->where('status', 'Paid')
        ->where('typecode', 'app_inv')
        ->sum('net');

        $monthly_pharmacy_income = TblInvoice::whereYear('date', $currentYear)
        ->whereMonth('date', $currentMonth)
        ->where('status', 'Paid')
        ->where('typecode', 'phm_inv')
        ->sum('net');


        return view('cashier.dashboard.cashier-dashboard', compact('monthly_channel_income', 'monthly_pharmacy_income'));
    }

    public function load_dashboard()
    {
        $stock_item = TblKrStore::get();
        $stock_item_total = TblKrStore::get()->count();
        $supplier_count = TblKrSupplier::get()->count();

        $count = 0;

        foreach ($stock_item as $key => $value) {
            $qty = $value->qty;
            $ctrl_qty = $value->critical_level;

            if ($qty < $ctrl_qty) {
                $count = $count + 1;
            }
        }

        $so = TblKrIssueBody::get();
        $total = 0;
        foreach ($so as $key => $value) {
            $price = $value->value;
            $total = $total+$price;
        }

        // dd($count);
        return view('index',["stock_item_count"=>$count, "stock_item_total"=>$stock_item_total, "supplier_count"=>$supplier_count, "total"=>$total]);
    }
}
