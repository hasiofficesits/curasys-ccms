<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\TblOpdDosageList;

class DosageController extends Controller
{
    public function load_dosage_page()
    {
        return view('appointment.settings.dosage');
    }

    public function load_Dosage_unit_list(Request $request)
    {
        if ($request->ajax()) {

            $supplier=TblOpdDosageList::orderBy('Id', 'ASC')->get();

            return datatables()->of($supplier)
                ->addColumn('action', function ($row) {
                    $html = '<button class="btn btn-info btn-sm waves-effect waves-light btn-edit">Edit</button> ';
                    if ($row->Isdelete == 0) {
                        $html .= ' <button class="btn btn-danger btn-sm waves-effect waves-light btn-active">Inactive</button>';
                    } else if($row->Isdelete == 1) {
                        $html .= ' <button class="btn btn-warning btn-sm waves-effect waves-light btn-active">Active</button>';
                    }
                    
                    return $html;
            })->toJson();
        }
    }

    public function save_new_dosage_unit(Request $request)
    {
        $unit_name = $request->input('unit_name');
        $unit = new TblOpdDosageList();
        $unit->Name = $unit_name;
        $unit->Isdelete	= 0;
        $unit->save();

        if($unit->save()){
            return response()->json(["success"=>true, "message"=>"Unit Added Successfully"]);
        }else{
            return response()->json(["success"=>false, "message"=>"Unit Added Failed."]);
        }
    }

    public function update_new_dosage_unit(Request $request)
    {
        $name = $request->input('name');
        $id = $request->input('id');

        $exist_unit = TblOpdDosageList::where('Id', $id)->first();
        $exist_unit->Name = $name;
        $exist_unit->save();

        if($exist_unit->save()){
            return response()->json(["success"=>true, "message"=>"Unit Updated Successfully."]);
        }else{
            return response()->json(["success"=>false, "message"=>"Selected Unit is Missing or Invalid"]);
        }
    }

    public function active_dosage_list(Request $request)
    {
        $act_unit_id = $request->input('act_unit_id');
        $unit_list = TblOpdDosageList::where('Id', $act_unit_id)->first();
        $unit_list->Isdelete = 0;
        $unit_list->save();

        if($unit_list->save()){
            return response()->json(["success"=>true, "message"=>"Unit Activated Successfully."]);
        }else{
            return response()->json(["success"=>false, "message"=>"Selected Unit is Missing or Invalid"]);
        }
    }

    public function inactive_dosage_list(Request $request)
    {
        $act_unit_id = $request->input('act_unit_id');
        $unit_list = TblOpdDosageList::where('Id', $act_unit_id)->first();
        $unit_list->Isdelete = 1;
        $unit_list->save();

        if($unit_list->save()){
            return response()->json(["success"=>true, "message"=>"Unit Inctivated Successfully."]);
        }else{
            return response()->json(["success"=>false, "message"=>"Selected Unit is Missing or Invalid"]);
        }
    }
}
