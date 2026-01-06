<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\TblOPDService;
use App\Models\TblNarration;
use App\Models\TblAccGroup;
use App\Models\TblMasterAcc;

class OPDController extends Controller
{
    public function load_opd_page()
    {
        return view('management.opd.list');
    }

    public function load_opdservice_grid(Request $request)
    {
        if ($request->ajax()) {

            $supplier=TblOPDService::orderBy('ID', 'ASC')->get();

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

    // public function load_rev_acc_service(Request $request)
    // {
    //     $rev_acc = TblNarration::get();
    //     return response()->json(["success"=>true, "data"=>$rev_acc]);
    // }

    public function save_new_service(Request $request)
    {
        $name = $request->input('name');
        $type = $request->input('type');
        $price = $request->input('price');
        // $rev_acc = $request->input('rev_acc');

        $service = new TblOPDService();
        $service->Type = $type;
        $service->Name = $name;
        $service->Price = $price;
        // $service->Ledgeracc = $rev_acc;
        $service->IsDelete = 0;
        $service->save();

        if($service->save()){
            return response()->json(["success"=>true, "message"=>"Service Added Successfully"]);
        }else{
            return response()->json(["success"=>false, "message"=>"Service Added Failed."]);
        }
    }

    public function update_opd_service(Request $request)
    {
        $service_id = $request->input('service_id');
        $name = $request->input('name');
        $type = $request->input('type');
        $price = $request->input('price');
        // $rev_acc = $request->input('rev_acc');

        $service = TblOPDService::where('ID', $service_id)->first();
        $service->Type = $type;
        $service->Name = $name;
        $service->Price = $price;
        // $service->Ledgeracc = $rev_acc;
        $service->save();

        if($service->save()){
            return response()->json(["success"=>true, "message"=>"Service Updated Successfully"]);
        }else{
            return response()->json(["success"=>false, "message"=>"Service Updated Failed."]);
        }
    }

    public function active_service_from_id(Request $request)
    {
        $act_service_id = $request->input('act_service_id');
        $service = TblOPDService::where('ID', $act_service_id)->first();
        $service->Isdelete = 0;
        $service->save();

        if($service->save()){
            return response()->json(["success"=>true, "message"=>"Service Activated Successfully."]);
        }else{
            return response()->json(["success"=>false, "message"=>"Selected Service is Missing or Invalid"]);
        }
    }

    public function inactive_service_from_id(Request $request)
    {
        $act_service_id = $request->input('act_service_id');
        $service = TblOPDService::where('ID', $act_service_id)->first();
        $service->Isdelete = 1;
        $service->save();

        if($service->save()){
            return response()->json(["success"=>true, "message"=>"Service Inactivated Successfully."]);
        }else{
            return response()->json(["success"=>false, "message"=>"Selected Service is Missing or Invalid"]);
        }
    }
}
