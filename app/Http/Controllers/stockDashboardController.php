<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\TblStockPharma;
use App\Models\TblStockPharmaLot;
use App\Models\TblInvoice;
use Carbon\Carbon;
use DB;

class stockDashboardController extends Controller
{
    public function load_sales_to_chart(Request $request)
    {
        $start_of_month = '2023-01-01';
        $end_of_month = '2023-01-31';

        // Monthly Sales
        $monthly_sales = TblInvoice::selectRaw('MONTH(date) as month, SUM(total) as Total')
        ->whereBetween('date', [$start_of_month, $end_of_month])
        ->where('status', 'paid')
        ->groupby('month')
        ->orderby('month')
        ->pluck('Total', 'month');
        // dd($monthly_sales);
        $formatted_sales_data = [];
        for ($i = 1; $i <= 12; $i++) {
            $formatted_sales_data[] = isset($monthly_sales[$i]) ? $monthly_sales[$i] : 0;
        }
        
        // dd($formatted_sales_data);

        return response()->json(["success"=>true, "data"=>$formatted_sales_data]);
    }

    
}
