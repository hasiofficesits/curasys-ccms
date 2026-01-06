<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\TblNarration;
use App\Models\TblAccGroup;
use App\Models\TblMasterAcc;
use App\Models\TblDoctor;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Mail;
use App\Mail\NewUserCredentialsMail;

class SystemUserController extends Controller
{
    public function load_users()
    {
        return view('management.user.user');
    }

    public function load_user_grid(Request $request)
    {
        if ($request->ajax()) {

            $supplier=User::orderBy('id', 'ASC')->where('role','>',0)->get();

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

    public function load_exist_doctors(Request $request)
    {
        $doctors = TblDoctor::where("Isdelete", 0)->get();
        // dd($doctors);
        return response()->json(['success' => true, 'doctors' => $doctors]);
    }
    public function load_selected_doctors_data(Request $request)
    {
        $doctor_id = $request->input('doctor_id');
        $doctor = TblDoctor::where('DID', $doctor_id)->where('Isdelete', 0)->first();
        // dd($doctor);

        if (!$doctor) {
            return response()->json([
                "success" => false,
                "message" => "Doctor not found"
            ]);
        }

        return response()->json([
            "success" => true,
            "doctor" => [
                "Name" => $doctor->Name,
                "Email" => $doctor->Email,
                "Mobile" => $doctor->Mobile,
                "doctor_id" => $doctor->DID
            ]
        ]);
    }

    public function save_new_user(Request $request)
    {
        $name = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');
        $contact = $request->input('contact');
        $user_type = $request->input('user_type');
        $doctor_id = $request->input('doctor_id');
        // dd($doctor_id);

        $exist_email = User::where('email',$email)->first();

        if($exist_email)
        {
            return response()->json(["success"=>false, "message"=>"Email Already Exist!"]);
        } else {
            $new_user = new User();
            $new_user->name = $name;
            $new_user->email = $email;
            $new_user->contact = $contact;
            $new_user->password = Hash::make($password);
            $new_user->Doc_Id = $doctor_id ?? null;
            $new_user->role = $user_type;
            $new_user->save();

            // Send email to the newly added user
            try {
                Mail::to($email)->send(new NewUserCredentialsMail($name, $email, $password));
            } catch (\Exception $e) {
                return response()->json([
                    "success" => true,
                    "message" => "User added successfully, but email sending failed: " . $e->getMessage()
                ]);
            }
        }

        return response()->json(["success"=>true, "message" => "User added and email sent successfully"]);
    }

    public function update_user(Request $request)
    {
        $user_id = $request->input('user_id');
        $name = $request->input('name');
        $email = $request->input('email');
        $contact = $request->input('contact');

        $user = User::where('id', $user_id)->first();
        $user->name = $name;
        $user->email = $email;
        $user->contact = $contact;
        $user->save();

        if($user->save()){
            return response()->json(["success"=>true, "message"=>"User Updated Successfully"]);
        }else{
            return response()->json(["success"=>false, "message"=>"User Updated Failed."]);
        }
    }

    public function active_user_from_id(Request $request)
    {
        $act_user_id = $request->input('act_user_id');
        $user = User::where('id', $act_user_id)->first();
        $user->Isdelete = 0;
        $user->save();

        if($user->save()){
            return response()->json(["success"=>true, "message"=>"User Activated Successfully."]);
        }else{
            return response()->json(["success"=>false, "message"=>"Selected User is Missing or Invalid"]);
        }
    }

    public function inactive_user_from_id(Request $request)
    {
        $act_user_id = $request->input('act_user_id');
        $user = User::where('id', $act_user_id)->first();
        $user->Isdelete = 1;
        $user->save();

        if($user->save()){
            return response()->json(["success"=>true, "message"=>"User Inactivated Successfully."]);
        }else{
            return response()->json(["success"=>false, "message"=>"Selected User is Missing or Invalid"]);
        }
    }
}
