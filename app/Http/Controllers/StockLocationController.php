<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\TblStockLocation;

class StockLocationController extends Controller
{
    public function load_stock_location_page()
    {
        return view('Stock.stockMaster.location');
    }

    public function load_stock_location_grid(Request $request)
    {
        if ($request->ajax()) {

            $supplier=TblStockLocation::orderBy('ID', 'ASC')->get();

            return datatables()->of($supplier)
                ->addColumn('action', function ($row) {
                    $html = '<button class="btn btn-info btn-sm waves-effect waves-light btn-edit">Edit</button> ';
                    if ($row->IsDelete == 0) {
                        $html .= ' <button class="btn btn-danger btn-sm waves-effect waves-light btn-active">Inactive</button>';
                    } else if($row->IsDelete == 1) {
                        $html .= ' <button class="btn btn-warning btn-sm waves-effect waves-light btn-active">Active</button>';
                    }
                    
                    return $html;
            })->toJson();
        }
    }

    public function save_new_location(Request $request)
    {
        $name = $request->input('name');
        $type = $request->input('type');

        $location = new TblStockLocation();
        $location->Name = $name;
        $location->Type = $type;
        $location->IsDelete = 0;
        $location->save();

        if($location->save()){
            return response()->json(["success"=>true, "message"=>"Location Added Successfully"]);
        }else{
            return response()->json(["success"=>false, "message"=>"Location Added Failed."]);
        }
    }

    public function update_location(Request $request)
    {
        $location_id = $request->input('location_id');
        $edit_name = $request->input('edit_name');
        $edit_type = $request->input('edit_type');

        $location = TblStockLocation::where('ID', $location_id)->first();
        $location->Name = $edit_name;
        $location->Type = $edit_type;
        $location->save();

        if($location->save()){
            return response()->json(["success"=>true, "message"=>"Location Updated Successfully"]);
        }else{
            return response()->json(["success"=>false, "message"=>"Location Updated Failed."]);
        }
    }

    public function active_location_from_id(Request $request)
    {
        $act_location_id = $request->input('act_location_id');
        $location = TblStockLocation::where('ID', $act_location_id)->first();
        $location->IsDelete = 0;
        $location->save();

        if($location->save()){
            return response()->json(["success"=>true, "message"=>"Location Activated Successfully."]);
        }else{
            return response()->json(["success"=>false, "message"=>"Selected Location is Missing or Invalid"]);
        }
    }

    public function inactive_location_from_id(Request $request)
    {
        $act_location_id = $request->input('act_location_id');
        $location = TblStockLocation::where('ID', $act_location_id)->first();
        $location->IsDelete = 1;
        $location->save();

        if($location->save()){
            return response()->json(["success"=>true, "message"=>"Location Inctivated Successfully."]);
        }else{
            return response()->json(["success"=>false, "message"=>"Selected Location is Missing or Invalid"]);
        }
    }
}
