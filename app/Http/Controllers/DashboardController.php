<?php

namespace App\Http\Controllers;

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
use App\Models\TblKrIssueBody;

class DashboardController extends Controller
{
    public function index()
    {
        return view('index',["stock_item_count"=>$stock_item_count]);
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
