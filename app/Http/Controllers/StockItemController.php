<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\TblStockPharma;
use App\Models\TblSupplier;
use App\Models\TblStockPharmaCategory;
use App\Models\TblStockPharmaGroup;
use App\Models\TblStockPharmaLot;

class StockItemController extends Controller
{
    public function load_stock_item_page()
    {
        //Item Code
        $code_prefix = "PHM";
        $c_size = strlen($code_prefix);

        $last_code = TblStockPharma::where("Code", "LIKE", $code_prefix . "%")->selectRaw("MAX(CAST(SUBSTR(Code,5) AS UNSIGNED)) as max_code")->first();
        if ($last_code->max_code) {

            $item_code = ($last_code->max_code + 1);
        } else {
            $item_code = "1";
        }
        $n = "" . $item_code;
        $x = substr("000000000" . $n, strlen($n)); //add your amount of zeros
        $next_code = $code_prefix . $x;


        return view('Stock.stockMaster.item',compact('next_code'));
    }

    public function load_stock_item_grid(Request $request)
    {
        if ($request->ajax()) {

            $supplier=TblStockPharma::orderBy('ID', 'ASC')->get();

            return datatables()->of($supplier)
                ->addColumn('action', function ($row) {
                    $html = '<button class="btn btn-success btn-sm waves-effect waves-light btn-add">Add Lot</button> ';
                    $html .= '<button class="btn btn-info btn-sm waves-effect waves-light btn-edit">Edit</button> ';
                    if ($row->IsDelete == 0) {
                        $html .= ' <button class="btn btn-danger btn-sm waves-effect waves-light btn-active">Inactive</button>';
                    } else if($row->IsDelete == 1) {
                        $html .= ' <button class="btn btn-warning btn-sm waves-effect waves-light btn-active">Active</button>';
                    }
                    
                    return $html;
            })->toJson();
        }
    }

    public function load_supplier_to_stock(Request $request)
    {
        $supplier = TblSupplier::get();
        return response()->json(["success"=>true, "data"=>$supplier]);
    }
    public function load_category_to_stock(Request $request)
    {
        $category = TblStockPharmaCategory::get();
        return response()->json(["success"=>true, "data"=>$category]);
    }
    public function load_group_to_stock(Request $request)
    {
        $group = TblStockPharmaGroup::get();
        return response()->json(["success"=>true, "data"=>$group]);
    }

    public function add_pharmacy_stock_item(Request $request)
    {
        $code = $request->input('code');
        $phm_name = $request->input('phm_name');
        $chm_name = $request->input('chm_name');
        $brand_name = $request->input('brand_name');
        $supplier = $request->input('supplier');
        $move_type = $request->input('move_type');
        $category = $request->input('category');
        $group = $request->input('group');
        $dosage = $request->input('dosage');
        $dosage_strength = $request->input('dosage_strength');
        $pack_type = $request->input('pack_type');
        $pack_qty = $request->input('pack_qty');
        $exp = $request->input('exp');
        $order_lvl = $request->input('order_lvl');
        $distributor = $request->input('distributor');
        $importer = $request->input('importer');

        //Check exist code
        $exist_code = TblStockPharma::where("Code", $code)->first();

        if ($exist_code) {
            return response()->json(["success"=>false, "message"=>"Item Code Already Exist!"]);
        } else {
            $new_item = new TblStockPharma();
            $new_item->Code = $code;
            $new_item->FKGruop = $group;
            $new_item->FKCatrgory = $category;
            $new_item->Pharma_name = $phm_name;
            $new_item->Chemical_Name = $chm_name;
            $new_item->Brand_Name = $brand_name;
            $new_item->Move_Type = $move_type;
            $new_item->Pack_Type = $pack_type;
            $new_item->Pack_Qty = $pack_qty;
            $new_item->Importer = $importer;
            $new_item->Distributor = $distributor;
            $new_item->FKSupplier_ID = $supplier;
            $new_item->ReorderLevel = $order_lvl;
            $new_item->Exp = $exp;
            $new_item->DosageType = $dosage;
            $new_item->DosageStrength = $dosage_strength;
            $new_item->IsDelete = 0;
            $new_item->save();

            if($new_item->save()){
                return response()->json(["success"=>true, "message"=>"Item Added Successfully"]);
            }else{
                return response()->json(["success"=>false, "message"=>"Item Added Failed."]);
            }
        }
    }

    public function load_next_item_code(Request $request)
    {
        //Item Code
        $code_prefix = "PHM";
        $c_size = strlen($code_prefix);

        $last_code = TblStockPharma::where("Code", "LIKE", $code_prefix . "%")->selectRaw("MAX(CAST(SUBSTR(Code,5) AS UNSIGNED)) as max_code")->first();
        if ($last_code->max_code) {

            $item_code = ($last_code->max_code + 1);
        } else {
            $item_code = "1";
        }
        $n = "" . $item_code;
        $x = substr("000000000" . $n, strlen($n)); //add your amount of zeros
        $next_code = $code_prefix . $x;

        return response()->json(["success"=>true, "data"=>$next_code]);
    }

    public function update_pharmacy_stock_item(Request $request)
    {
        $edit_code = $request->input('edit_code');
        $edit_phm_name = $request->input('edit_phm_name');
        $edit_chm_name = $request->input('edit_chm_name');
        $edit_brand_name = $request->input('edit_brand_name');
        $edit_supplier = $request->input('edit_supplier');
        $edit_move_type = $request->input('edit_move_type');
        $edit_category = $request->input('edit_category');
        $edit_group = $request->input('edit_group');
        $edit_dosage = $request->input('edit_dosage');
        $edit_dosage_strength = $request->input('edit_dosage_strength');
        $edit_pack_type = $request->input('edit_pack_type');
        // $edit_pack_qty = $request->input('edit_pack_qty');
        $edit_exp = $request->input('edit_exp');
        $edit_order_lvl = $request->input('edit_order_lvl');
        $edit_distributor = $request->input('edit_distributor');
        $edit_importer = $request->input('edit_importer');

        $item = TblStockPharma::where('Code', $edit_code)->first();
        $item->FKGruop = $edit_group;
        $item->FKCatrgory = $edit_category;
        $item->Pharma_name = $edit_phm_name;
        $item->Chemical_Name = $edit_chm_name;
        $item->Brand_Name = $edit_brand_name;
        $item->Move_Type = $edit_move_type;
        $item->Pack_Type = $edit_pack_type;
        // $item->Pack_Qty = $edit_pack_qty;
        $item->Importer = $edit_importer;
        $item->Distributor = $edit_distributor;
        $item->FKSupplier_ID = $edit_supplier;
        $item->ReorderLevel = $edit_order_lvl;
        $item->Exp = $edit_exp;
        $item->DosageType = $edit_dosage;
        $item->DosageStrength = $edit_dosage_strength;
        $item->save();

        if($item->save()){
            return response()->json(["success"=>true, "message"=>"Item Updated Successfully"]);
        }else{
            return response()->json(["success"=>false, "message"=>"Item Updated Failed."]);
        }

    }

    public function load_stock_lot_grid(Request $request)
    {
        $item_id = $request->input('item_id');

        $lot = TblStockPharmaLot::where('FKStock_ID', $item_id)->where('Isdelete',0)->with('supplier')->get();
        return response()->json(["success"=>true, "data"=>$lot]);
    }

    public function add_phm_stock_lot(Request $request)
    {
        $lot_item_id = $request->input('lot_item_id');
        $lot = $request->input('lot');
        $batch = $request->input('batch');
        $exp_date = $request->input('exp_date');
        $supplier = $request->input('supplier');
        $price = $request->input('price');
        $cost = $request->input('cost');
        $discount = $request->input('discount');
        $qty = $request->input('qty');

        
        $dis_price = $discount*100;
        // dd($dis_price);

        $new_lot = new TblStockPharmaLot();
        $new_lot->FKStock_ID = $lot_item_id;
        $new_lot->Lot = $lot;
        $new_lot->Cost = $cost;
        $new_lot->Price = $price;
        $new_lot->DisCount = $dis_price;
        $new_lot->Batch = $batch;
        $new_lot->Exp_date = $exp_date;
        $new_lot->QTY = $qty;
        $new_lot->Supplier_ID = $supplier;
        $new_lot->Isdelete = 0;
        $new_lot->save();

        if($new_lot->save()){
            return response()->json(["success"=>true, "message"=>"Lot Added Successfully"]);
        }else{
            return response()->json(["success"=>false, "message"=>"Lot Added Failed."]);
        }
    }

    public function update_phm_stock_lot(Request $request)
    {
        $lot_id = $request->input('lot_id');
        $edit_lot = $request->input('edit_lot');
        $edit_batch = $request->input('edit_batch');
        $edit_exp_date = $request->input('edit_exp_date');
        $edit_supplier = $request->input('edit_supplier');
        $edit_price = $request->input('edit_price');
        $edit_cost = $request->input('edit_cost');
        $edit_discount = $request->input('edit_discount');
        $edit_lot_qty = $request->input('edit_lot_qty');

        // dd($edit_discount);

        $lot = TblStockPharmaLot::where('ID', $lot_id)->first();
        $lot->Lot = $edit_lot;
        $lot->Cost = $edit_cost;
        $lot->Price = $edit_price;
        $lot->DisCount = $edit_discount;
        $lot->Batch = $edit_batch;
        $lot->Exp_date = $edit_exp_date;
        $lot->QTY = $edit_lot_qty;
        $lot->Supplier_ID = $edit_supplier;
        $lot->save();

        if($lot->save()){
            return response()->json(["success"=>true, "message"=>"Lot Updated Successfully"]);
        }else{
            return response()->json(["success"=>false, "message"=>"Lot Updated Failed."]);
        }
    }

    public function delete_phm_stock_lot(Request $request)
    {
        $delete_lot_id = $request->input('delete_lot_id');
        $lot = TblStockPharmaLot::where('ID', $delete_lot_id)->first();
        $lot->Isdelete = 1;
        $lot->save();

        if($lot->save()){
            return response()->json(["success"=>true, "message"=>"Lot Deleted Successfully"]);
        }else{
            return response()->json(["success"=>false, "message"=>"Lot Deleted Failed."]);
        }
    }

    public function active_item_from_id(Request $request)
    {
        $item_id = $request->input('item_id');
        $item = TblStockPharma::where('ID', $item_id)->first();
        $item->IsDelete = 0;
        $item->save();

        if($item->save()){
            return response()->json(["success"=>true, "message"=>"Item Activated Successfully."]);
        }else{
            return response()->json(["success"=>false, "message"=>"Selected Item is Missing or Invalid"]);
        }
    }

    public function inactive_item_from_id(Request $request)
    {
        $item_id = $request->input('item_id');
        $item = TblStockPharma::where('ID', $item_id)->first();
        $item->IsDelete = 1;
        $item->save();

        if($item->save()){
            return response()->json(["success"=>true, "message"=>"Item Inactivated Successfully."]);
        }else{
            return response()->json(["success"=>false, "message"=>"Selected Item is Missing or Invalid"]);
        }
    }

    
}
