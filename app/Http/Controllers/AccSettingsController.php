<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\TblNarration;
use App\Models\TblAccountSetting;

class AccSettingsController extends Controller
{
    public function load_acc_set()
    {
        return view('management.acc_setting.acc_setting');
    }

    public function load_def_acc(Request $request)
    {
        $acc = TblNarration::get();
        return response()->json(["success"=>true, "data"=>$acc]);
    }

    public function load_exist_def_acc(Request $request)
    {
        $stock_acc = TblAccountSetting::where('Name','STOCK')->first();
        $sales_acc = TblAccountSetting::where('Name','SALES')->first();
        $cost_sales_acc = TblAccountSetting::where('Name','COST OF SALES')->first();
        $rec_dis = TblAccountSetting::where('Name','RECEIVED DISCOUNT')->first();
        $giv_dis = TblAccountSetting::where('Name','GIVEN DISCOUNT')->first();

        return response()->json(["success"=>true, "stock_acc"=>$stock_acc,"sales_acc"=>$sales_acc,"cost_sales_acc"=>$cost_sales_acc,"rec_dis"=>$rec_dis,"giv_dis"=>$giv_dis]);
    }

    public function save_default_acc(Request $request)
    {
        $stock_acc = $request->input('stock_acc');
        $sales_acc = $request->input('sales_acc');
        $cost_sales = $request->input('cost_sales');
        $rec_dis = $request->input('rec_dis');
        $giv_dis = $request->input('giv_dis');

        if ($stock_acc != null) {
            $narration = TblNarration::where('ID', $stock_acc)->first();

            $stock = TblAccountSetting::where('Name','STOCK')->first();
            $stock->AccId = $narration->ID;
            $stock->Acc = $narration->Acc;
            $stock->AccCode = $narration->ID;
            $stock->Status = 0;
            $stock->CreateBy = null;
            $stock->save();
        }
        
        if ($sales_acc != null) {
            $narration = TblNarration::where('ID', $sales_acc)->first();

            $sales = TblAccountSetting::where('Name','SALES')->first();
            $sales->AccId = $narration->ID;
            $sales->Acc = $narration->Acc;
            $sales->AccCode = $narration->ID;
            $sales->Status = 0;
            $sales->CreateBy = null;
            $sales->save();
        }

        if ($cost_sales != null) {
            $narration = TblNarration::where('ID', $cost_sales)->first();

            $cost = TblAccountSetting::where('Name','COST OF SALES')->first();
            $cost->AccId = $narration->ID;
            $cost->Acc = $narration->Acc;
            $cost->AccCode = $narration->ID;
            $cost->Status = 0;
            $cost->CreateBy = null;
            $cost->save();
        }

        if ($rec_dis != null) {
            $narration = TblNarration::where('ID', $rec_dis)->first();

            $recieve = TblAccountSetting::where('Name','RECEIVED DISCOUNT')->first();
            $recieve->AccId = $narration->ID;
            $recieve->Acc = $narration->Acc;
            $recieve->AccCode = $narration->ID;
            $recieve->Status = 0;
            $recieve->CreateBy = null;
            $recieve->save();
        }

        if ($giv_dis != null) {
            $narration = TblNarration::where('ID', $giv_dis)->first();

            $given = TblAccountSetting::where('Name','GIVEN DISCOUNT')->first();
            $given->AccId = $narration->ID;
            $given->Acc = $narration->Acc;
            $given->AccCode = $narration->ID;
            $given->Status = 0;
            $given->CreateBy = null;
            $given->save();
        }

        return response()->json(["success"=>true]);
    }
}
