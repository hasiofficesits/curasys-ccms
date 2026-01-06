<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TblDoctor;
use App\Models\TblNarration;
use App\Models\TblAccGroup;
use App\Models\TblMasterAcc;


class DoctorController extends Controller
{
    public function load_doctor()
    {
        return view('management.doctor.doctor');
    }

    public function load_doctor_grid(Request $request)
    {
        if ($request->ajax()) {

            $supplier=TblDoctor::orderBy('DID', 'ASC')->get();

            return datatables()->of($supplier)
                ->addColumn('action', function ($row) {
                    $html = '<button class="btn btn-info btn-sm waves-effect waves-light btn-edit">Edit</button> ';
                    if ($row->Isdelete == 0) {
                        $html .= ' <button class="btn btn-danger btn-sm waves-effect waves-light btn-active ">Inactive</button>';
                    } else if($row->Isdelete == 1) {
                        $html .= ' <button class="btn btn-warning btn-sm waves-effect waves-light btn-active ">Active</button>';
                    }
                    
                    return $html;
            })->toJson();
        }
    }

    public function save_new_doctor(Request $request)
    {
        $name = $request->input('name');
        $address = $request->input('address');
        $email = $request->input('email');
        $speciality = $request->input('speciality');
        $birthday = $request->input('birthday');
        $nic = $request->input('nic');
        $mobile = $request->input('mobile');
        $gender = $request->input('gender');

        //exist nic
        $doctor = TblDoctor::where('NICNumber', $nic)->first();

        if ($doctor) {
            return response()->json(["success"=>false, "message"=>"NIC Already Exist."]);
        } else {
            $new_doc = new TblDoctor();
            $new_doc->NICNumber = $nic;
            $new_doc->Name = $name;
            $new_doc->Address = $address;
            $new_doc->BirthDay = $birthday;
            $new_doc->Gender = $gender;
            $new_doc->Speciality = $speciality;
            $new_doc->Mobile = $mobile;
            $new_doc->Email = $email;
            $new_doc->Isdelete = 0;

            $group = TblAccGroup::where('GroupName','Creditor')->first();
            $master = TblMasterAcc::where('ID', $group->MasterAcc_Id)->first();

            $narration = new TblNarration();
            $narration->Acc = $name.' Creditor Ledger';
            $narration->AccCode = $master->Code;
            $narration->Group = $group->ID;
            $narration->Type = "Doctor Creditor";
            $narration->MasterAcc = $group->MasterAcc_Id;
            $narration->Derive = "User";
            $narration->VisibleCode = $master->Code;
            $narration->Active = 1;
            $narration->save();

            $new_doc->DebtorLedger = null;
            $new_doc->CreditorLedger = $narration->ID;
            $new_doc->save();
        }

        return response()->json(["success"=>true]);
    }

    public function update_exist_doctor(Request $request)
    {
        $doc_id = $request->input('doc_id');
        $name_edit = $request->input('name_edit');
        $address_edit = $request->input('address_edit');
        $email_edit = $request->input('email_edit');
        $speciality_edit = $request->input('speciality_edit');
        $nic_edit = $request->input('nic_edit');
        $mobile_edit = $request->input('mobile_edit');
        $gender_edit = $request->input('gender_edit');
        $date_edit = $request->input('date_edit');

        $exist_doc = TblDoctor::where('DID', $doc_id)->first();
        $exist_doc->NICNumber = $nic_edit;
        $exist_doc->Name = $name_edit;
        $exist_doc->Address = $address_edit;
        $exist_doc->BirthDay = $date_edit;
        $exist_doc->Gender = $gender_edit;
        $exist_doc->Speciality = $speciality_edit;
        $exist_doc->Mobile = $mobile_edit;
        $exist_doc->Email = $email_edit;
        $exist_doc->save();

        if($exist_doc->save()){
            return response()->json(["success"=>true, "message"=>"Updated Successfully"]);
        }else{
            return response()->json(["success"=>false, "message"=>"Updated Failed."]);
        }
    }

    public function active_doctor_from_id(Request $request)
    {
        $doctor_id = $request->input('doctor_id');
        $doctor = TblDoctor::where('DID', $doctor_id)->first();
        $doctor->Isdelete = 0;
        $doctor->save();

        if($doctor->save()){
            return response()->json(["success"=>true, "message"=>"Doctor Activated Successfully."]);
        }else{
            return response()->json(["success"=>false, "message"=>"Selected Doctor is Missing or Invalid"]);
        }
    }

    public function inactive_doctor_from_id(Request $request)
    {
        $doctor_id = $request->input('doctor_id');
        $doctor = TblDoctor::where('DID', $doctor_id)->first();
        $doctor->Isdelete = 1;
        $doctor->save();

        if($doctor->save()){
            return response()->json(["success"=>true, "message"=>"Doctor Inactivated Successfully."]);
        }else{
            return response()->json(["success"=>false, "message"=>"Selected Doctor is Missing or Invalid"]);
        }
    }
}
