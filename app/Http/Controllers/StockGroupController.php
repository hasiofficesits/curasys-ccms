<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\TblStockPharmaGroup;

class StockGroupController extends Controller
{
    public function load_group_page()
    {
        return view('Stock.settings.stock_group');
    }

    public function load_stock_group_grid(Request $request)
    {
        if ($request->ajax()) {

            $supplier=TblStockPharmaGroup::orderBy('ID', 'ASC')->get();

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

    public function save_new_group(Request $request)
    {
        $group = $request->input('group');
        $code = $request->input('code');

        $exist_code = TblStockPharmaGroup::where('Code', $code)->first();

        if ($exist_code) {
            return response()->json(["success"=>false, "message"=>"Group Code Already Exist!"]);
        } else {
            $new_grp = new TblStockPharmaGroup();
            $new_grp->GroupName = $group;
            $new_grp->Code = $code;
            $new_grp->IsDelete = 0;
            $new_grp->save();

            if($new_grp->save()){
                return response()->json(["success"=>true, "message"=>"Group Added Successfully"]);
            }else{
                return response()->json(["success"=>false, "message"=>"Group Added Failed."]);
            }
        }
    }

    public function update_stock_group(Request $request)
    {
        $group_id = $request->input('group_id');
        $edit_code = $request->input('edit_code');
        $edit_group = $request->input('edit_group');

        $exist_code = TblStockPharmaGroup::where('Code', $edit_code)->first();

        if ($exist_code) {
            return response()->json(["success"=>false, "message"=>"Group Code Already Exist!"]);
        } else {
            $group = TblStockPharmaGroup::where('ID', $group_id)->first();
            $group->GroupName = $edit_group;
            $group->Code = $edit_code;
            $group->save();

            if($group->save()){
                return response()->json(["success"=>true, "message"=>"Group Updated Successfully"]);
            }else{
                return response()->json(["success"=>false, "message"=>"Group Updated Failed."]);
            }
        }
    }

    public function active_group_from_id(Request $request)
    {
        $group_id = $request->input('group_id');
        $group = TblStockPharmaGroup::where('ID', $group_id)->first();
        $group->IsDelete = 0;
        $group->save();

        if($group->save()){
            return response()->json(["success"=>true, "message"=>"Group Activated Successfully."]);
        }else{
            return response()->json(["success"=>false, "message"=>"Selected Group is Missing or Invalid"]);
        }
    }

    public function inactive_group_from_id(Request $request)
    {
        $group_id = $request->input('group_id');
        $group = TblStockPharmaGroup::where('ID', $group_id)->first();
        $group->IsDelete = 1;
        $group->save();

        if($group->save()){
            return response()->json(["success"=>true, "message"=>"Group Inactivated Successfully."]);
        }else{
            return response()->json(["success"=>false, "message"=>"Selected Group is Missing or Invalid"]);
        }
    }
}
