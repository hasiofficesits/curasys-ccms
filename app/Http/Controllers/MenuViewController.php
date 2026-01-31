<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Models\TblStockPharma;
use App\Models\TblStockPharmaLot;
use App\Models\TblInvoice;

use App\Models\TblDoctor;
use App\Models\TblPatient;
use App\Models\TblOPDService;
use App\Models\TblOPDAppointment;
use App\Models\User;
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

    public function load_appointment_view(Request $request)
    {
        $request->session()->put('menu', "appointment");

        return view('appointment.appointment.new_appointment');
    }

    public function load_cashier_view(Request $request)
    {
        $request->session()->put('menu', "cashier");
        $date = Carbon::now();
        
        // Get all doctors with role ID 3
        $all_doctors = DB::table('users')
            ->where('users.role', 3) 
            ->select('users.Doc_ID as ID', 'users.name')
            ->get();
        
        $doctor_queue_numbers = [];
        foreach ($all_doctors as $doctor) {
            $last_queue_number = TblOPDQueue::where('Date', $date->format('Y-m-d'))
                ->where('Doctor', $doctor->ID)
                ->max('DocQueueNo');
            
            $doctor_queue_numbers[$doctor->ID] = ($last_queue_number == null) ? 1 : $last_queue_number + 1;
        }

        return view('cashier.appointment.make_appointment', [
            "all_doctors" => $all_doctors,
            "doctor_queue_numbers" => $doctor_queue_numbers,
            "current_date" => $date->format('Y-m-d')
        ]);
    }

    public function load_report_view(Request $request)
    {
        $request->session()->put('menu', "reports");
        return view('reports.stock.current-stock');
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

        $request->session()->put('menu', "stock");
        return view('stock.dashboard.stock-dashboard', ["pharma_item_count"=>$pharma_item_count, 
                                        "low_stock"=>$low_stock, 
                                        "out_of_stock_item_count"=>$out_of_stock_item_count, 
                                        "get_invoice_total"=>$get_invoice_total,
                                        'stock_item_count' => $stock_item_count,
                                        'low_stock_count' => $low_stock_count,
                                        'out_of_stock_count' => $out_of_stock_count,
                                        'products_list' => $products_list,
                                        'dosageLabels' => $dosageLabels,
                                        'dosageCounts' => $dosageCounts
                                    ]);
    }
}
