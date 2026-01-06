<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\TblPatient;
use App\Models\TblNarration;
use App\Models\TblAccGroup;
use App\Models\TblMasterAcc;

class PatientController extends Controller
{
    public function load_patient()
    {
        return view('management.patient.patient');
    }

    public function load_patient_grid(Request $request)
    {
        $keyword=$request->search["value"];
        
        if ($request->ajax()) {
            if($request->search["value"]){
                $patients=TblPatient::where("FullName","LIKE" , "%".$keyword."%")->orWhere("ID",$keyword)->orWhere("Nic",$keyword)->orWhere("Mobile",$keyword)->orWhere("pass_no", $keyword)->orderBy("ID","desc")->limit(1000)->get();
            }else{
                $patients=TblPatient::orderBy("ID","desc")->limit(100)->get();
            }

            return datatables()->of($patients)
                ->addColumn('action', function ($row) {
                    $html = '<a class="btn btn-info btn-sm waves-effect waves-light btn-edit" href="/load_update_patient_page/'.$row->ID.'">Edit</a>';
                    // $html = '<button class="btn btn-info btn-sm waves-effect waves-light btn-edit" href="/management/patient/load_update_patient_page/'.$row->ID.'">Edit</button> ';
                    if ($row->Isdelete == 0) {
                        $html .= ' <button class="btn btn-danger btn-sm waves-effect waves-light btn-active ">Inactive</button>';
                    } else if($row->Isdelete == 1) {
                        $html .= ' <button class="btn btn-warning btn-sm waves-effect waves-light btn-active ">Active</button>';
                    }
                    
                    return $html;
            })->toJson();
        }
    }

    public function add_patient_page(Request $request)
    {
        $patient_id = TblPatient::max("ID");

        if(!$patient_id){
            $patient_id=0;
        }
        $patient_next_id=$patient_id+1;

        return view('management.patient.add',[ "patient_next_id"=>$patient_next_id]);
    }

    public function load_update_patient_page($id)
    {
        $customer=TblPatient::where("ID",$id)->first();
        return view('management.patient.update',["customer"=>$customer,"patient_next_id"=>$id]);
    }

    public function ajax_save_patient(Request $request)
    {
        $request->validate([
            'FullName'=>'required',
            'gender'=>'required',
            'dob'=>'required',
        ]);

        $title=$request->input("title");
        $fullName=$request->input("FullName");
        $nic=$request->input("nic");

        $pass_no = $request->input("pass_no");
        $dob=$request->input("dob");
        $address=$request->input("address");
        $ageY=$request->input("ageY");
        $ageM=$request->input("ageM");
        $ageD=$request->input("ageD");
        $email=$request->input("email");
        $mStatus=$request->input("mStatus");
        $religion=$request->input("religion");
        $isActive=$request->input("isActive");


        $mobile=$request->input("mobile");
        $guardner_name=$request->input("gname");
        $guardner_mumber=$request->input("gnumber");
        $guardner_relationship=$request->input("grelationship");

        $gender=$request->input("gender");
        if($gender=="Male"){
            $gender=1;
        }else{
            $gender=0;
        }
        //check exist NIC
        $exist_check_nic = TblPatient::where("Nic", $nic)->first();

        if($exist_check_nic)
        {
            return response()->json(["success"=>false, "message"=>"Nic Already Exist!"]);
        } else {
            $patient=new TblPatient;

            $patient->Title=$title;
            $patient->FullName=$fullName;
            $patient->Nic=$nic;
            $patient->pass_no=$pass_no;
            $patient->Gender=$gender;
            $patient->BirthDay=$dob;
            $patient->Address=$address;
            $patient->Email=$email;
            $patient->CivilStatus=$mStatus;
            $patient->CivilStatus=$mStatus;
            $patient->Religion=$religion;
            $patient->Mobile=$mobile;
            $patient->Height=0;
            $patient->Weight=0;
            $patient->BMI=0;
            if($isActive=="true"){
                $patient->Isdelete=False;
            }else{
                $patient->Isdelete=True;
            }

            $patient->GardnerName=$guardner_name;
            $patient->GardnerContact=$guardner_mumber;
            $patient->GardnerRelationShip=$guardner_relationship;
            

            //SAVE DEBTOR ACC AND ADVANCE ACC
            $debtor_acc = $request->input('debtor_acc');
            $advance_acc = $request->input('advance_acc');

            // dd($debtor_acc, $advance_acc);
            

            //save accounts
            if ($debtor_acc == 1) {

                $group = TblAccGroup::where('GroupName','Debtor')->first();
                $master = TblMasterAcc::where('ID', $group->MasterAcc_Id)->first();

                $narration = new TblNarration();
                $narration->Acc = $patient->FullName.' Debtor Ledger';
                $narration->AccCode = $master->Code;
                $narration->Group = $group->ID;
                $narration->Type = "Patient Debtor";
                $narration->MasterAcc = $group->MasterAcc_Id;
                $narration->Derive = "User";
                $narration->VisibleCode = $master->Code;
                $narration->Active = 1;
                $narration->save();

                $patient->DebtorLedger = $narration->ID;
            }

            if ($advance_acc== 1) {
                $group = TblAccGroup::where('GroupName','Advanced Creditor')->first();
                $master = TblMasterAcc::where('ID', $group->MasterAcc_Id)->first();

                $narration = new TblNarration();
                $narration->Acc = $patient->FullName.' Advanced Creditor Ledger';
                $narration->AccCode = $master->Code;
                $narration->Group = $group->ID;
                $narration->Type = "Patient Advanced Creditor";
                $narration->MasterAcc = $group->MasterAcc_Id;
                $narration->Derive = "User";
                $narration->VisibleCode = $master->Code;
                $narration->Active = 1;
                $narration->save();

                $patient->AdvanceLedger = $narration->ID;
            }

            $patient->save();
        }

        

        return response()->json(["success"=>true]);
    }

    public function ajax_update_patient(Request $request)
    {
        $request->validate([
            'FullName'=>'required',
            'gender'=>'required',
            'dob'=>'required',
        ]);
        
        $patient_id=$request->input("patient_id");
        $title=$request->input("title");
        $fullName=$request->input("FullName");
        $nic=$request->input("nic");

        $pass_no=$request->input("pass_no");

        $gender_value=0;
        $gender=$request->input("gender");
        if($gender=="Male"){
            $gender_value=1;
        }
        $dob=$request->input("dob");
        $address=$request->input("address");
        $ageY=$request->input("ageY");
        $ageM=$request->input("ageM");
        $ageD=$request->input("ageD");
        $email=$request->input("email");
        $mStatus=$request->input("mStatus");
        $religion=$request->input("religion");
        $isActive=$request->input("isActive");


        $mobile=$request->input("mobile");
        $guardner_name=$request->input("gname");
        $guardner_mumber=$request->input("gnumber");
        $guardner_relationship=$request->input("grelationship");

        $patient=TblPatient::where("ID",$patient_id)->first();

        $patient->Title=$title;
        $patient->FullName=$fullName;
        $patient->Nic=$nic;

        $patient->pass_no=$pass_no;
        
        $patient->Gender=$gender_value;
        $patient->BirthDay=$dob;
        $patient->Address=$address;
        $patient->Email=$email;
        $patient->CivilStatus=$mStatus;
        $patient->CivilStatus=$mStatus;
        $patient->Religion=$religion;
        $patient->Mobile=$mobile;
        $patient->Height=0;
        $patient->Weight=0;
        $patient->BMI=0;
        if($isActive=="true"){
            $patient->Isdelete=False;
        }else{
            $patient->Isdelete=True;
        }

        $patient->GardnerName=$guardner_name;
        $patient->GardnerContact=$guardner_mumber;
        $patient->GardnerRelationShip=$guardner_relationship;

        //SAVE DEBTOR ACC AND ADVANCE ACC
        $debtor_acc = $request->input('debtor_acc');
        $advance_acc = $request->input('advance_acc');

        if ($patient->AdvanceLedger == null) {

            if ($advance_acc == 1) {

                $group = TblAccGroup::where('GroupName','Advanced Creditor')->first();
                $master = TblMasterAcc::where('ID', $group->MasterAcc_Id)->first();

                $narration = new TblNarration();
                $narration->Acc = $patient->FullName.' Advanced Creditor Ledger';
                $narration->AccCode = $master->Code;
                $narration->Group = $group->ID;
                $narration->Type = "Patient Advanced Creditor";
                $narration->MasterAcc = $group->MasterAcc_Id;
                $narration->Derive = "User";
                $narration->VisibleCode = $master->Code;
                $narration->Active = 1;
                $narration->save();

                $patient->AdvanceLedger = $narration->ID;

            }
        }

        if ($patient->DebtorLedger == null) {
            if ($debtor_acc == 1) {

                $group = TblAccGroup::where('GroupName','Debtor')->first();
                $master = TblMasterAcc::where('ID', $group->MasterAcc_Id)->first();

                $narration = new TblNarration();
                $narration->Acc = $patient->FullName.' Debtor Ledger';
                $narration->AccCode = $master->Code;
                $narration->Group = $group->ID;
                $narration->Type = "Patient Debtor";
                $narration->MasterAcc = $group->MasterAcc_Id;
                $narration->Derive = "User";
                $narration->VisibleCode = $master->Code;
                $narration->Active = 1;
                $narration->save();

                $patient->DebtorLedger = $narration->ID;

            }
        }

        $patient->save();

        return response()->json(["success"=>true]);
    }

    public function active_patient(Request $request)
    {
        $patient_id = $request->input('patient_id');
        $patient = TblPatient::where('ID', $patient_id)->first();
        $patient->Isdelete = 0;
        $patient->save();

        if($patient->save()){
            return response()->json(["success"=>true, "message"=>"Patient Activated Successfully."]);
        }else{
            return response()->json(["success"=>false, "message"=>"Selected Patient is Missing or Invalid"]);
        }
    }

    public function inactive_patient(Request $request)
    {
        $patient_id = $request->input('patient_id');
        $patient = TblPatient::where('ID', $patient_id)->first();
        $patient->Isdelete = 1;
        $patient->save();

        if($patient->save()){
            return response()->json(["success"=>true, "message"=>"Patient Inactivated Successfully."]);
        }else{
            return response()->json(["success"=>false, "message"=>"Selected Patient is Missing or Invalid"]);
        }
    }
}
