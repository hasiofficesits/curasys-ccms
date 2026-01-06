<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\TblStockPharma;
use App\Models\TblStockPharmaLot;
use App\Models\TblInvoice;

use App\Models\TblPatient;
use App\Models\TblDoctor;
use App\Models\TblOPDQueue;

use Carbon\Carbon;

class MenuViewController extends Controller
{
    public function menu_view()
    {
        return view('menu_view');
    }

    public function load_management_view(Request $request)
    {
        $request->session()->put('menu', "management");
        return view('management.doctor.dashboard');
    }

    public function load_appointment_view(Request $request)
    {
        $request->session()->put('menu', "appointment");

        // Patient Count
        $patient_count = TblPatient::get()->count();

        // Doctor Count
        $doctor_count = TblDoctor::get()->count();

        $current_date = "2023-01-12";
        // Queue Count
        $queue_count = TblOPDQueue::where('Date', $current_date)->get()->count();

        return view('appointment.dashboard', ["patient_count"=>$patient_count, "doctor_count"=>$doctor_count, "queue_count"=>$queue_count]);
    }

    public function load_cashier_view(Request $request)
    {
        $request->session()->put('menu', "cashier");
        return view('cashier.dashboard');
    }

    public function load_report_view(Request $request)
    {
        $request->session()->put('menu', "reports");
        return view('reports.dashboard');
    }

    public function load_stock_view(Request $request)
    {
        
        $pharma_item_count = TblStockPharma::get()->count();
        // dd($pharma_item_count);

        $low_stock = TblStockPharma::where('ReorderLevel', '<', 2)->get()->count();
        // dd($low_stock);

        $out_of_lot = TblStockPharmaLot::where('QTY', '<', 1)->get();
        $out_of_stock_items_ids = $out_of_lot->pluck('FKStock_ID')->unique();
        // dd($out_of_stock_items);
        $out_of_stock_item_count = TblStockPharma::whereIn('ID', $out_of_stock_items_ids)->get()->count();
        // dd($out_of_stock_item_count);

        // TOTAL INCOME
        // $start_of_month = Carbon::now()->startOfMonth();
        // $end_of_month = Carbon::now()->endOfMonth();

        $start_of_month = '2023-01-01';
        $end_of_month = '2023-01-31';

        $get_invoice_total = TblInvoice::where('typecode', 'phm_inv')
                        ->whereBetween('date', [$start_of_month, $end_of_month])
                        ->where('status', 'paid')
                        ->sum('total');

        $request->session()->put('menu', "stock");
        return view('Stock.dashboard', ["pharma_item_count"=>$pharma_item_count, 
                                        "low_stock"=>$low_stock, 
                                        "out_of_stock_item_count"=>$out_of_stock_item_count, 
                                        "get_invoice_total"=>$get_invoice_total]);
    }
}
