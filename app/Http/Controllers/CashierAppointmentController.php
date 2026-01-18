<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\TblOPDAppointment;
use App\Models\TblOPDQueue;
use App\Models\TblPatient;

use DB;
use Carbon\Carbon;

use Vonage\Client;
use Vonage\Client\Credentials\Basic;

class CashierAppointmentController extends Controller
{
    public function cashier_appointment_page()
    {
        $date = Carbon::now();
        
        // Get all doctors with role ID 3
        $all_doctors = DB::table('users')
            ->where('users.role', 3) 
            ->select('users.Doc_ID as ID', 'users.name')
            ->get();
        
        $doctor_queue_numbers = [];
        foreach ($all_doctors as $doctor) {
            $last_queue_number = TblOPDQueue::where('Date', $date->format('Y-m-d'))
                ->where('Doctor', $doctor->ID)
                ->max('DocQueueNo');
            
            $doctor_queue_numbers[$doctor->ID] = ($last_queue_number == null) ? 1 : $last_queue_number + 1;
        }

        return view('cashier.appointment.make_appointment', [
            "all_doctors" => $all_doctors,
            "doctor_queue_numbers" => $doctor_queue_numbers,
            "current_date" => $date->format('Y-m-d')
        ]);
    }

    public function get_doctor_next_queue(Request $request)
    {
        $doctor_id = $request->input('doctor_id');
        $date = $request->input('date', Carbon::now()->format('Y-m-d'));
        
        $last_queue_number = TblOPDQueue::where('Date', $date)
            ->where('Doctor', $doctor_id)
            ->max('DocQueueNo');
        
        $next_number = ($last_queue_number == null) ? 1 : $last_queue_number + 1;
        
        return response()->json([
            'next_queue_number' => $next_number
        ]);
    }

    public function load_opdqueue_grid(Request $request)
    {
        if (!$request->ajax()) {
            return response()->json(['error' => 'Invalid request'], 400);
        }

        try {
            $queues = TblOPDQueue::with(['patient'])
                ->leftJoin('users', 'tblopdqueue.Doctor', '=', 'users.Doc_ID')
                ->orderBy('ID', 'DESC')
                ->select('TblOPDQueue.*', 'users.name as doctor_name')
                ->limit(100)
                ->get();

            return datatables()->of($queues)
                ->addColumn('action', function ($row) {
                    $html = '';
                    
                    if ($row->Status == "New") {
                        $html .= '<button class="btn btn-warning btn-sm waves-effect waves-light btn-cancel" data-id="' . $row->ID . '">Cancel</button> ';
                    }
                    
                    $html .= '<button class="btn btn-success btn-sm waves-effect waves-light btn-send-sms" data-id="' . $row->ID . '">Send SMS</button>';
                    
                    return $html;
                })
                ->rawColumns(['action'])
                ->toJson();
                
        } catch (\Exception $e) {
            \Log::error('OPD Queue Grid Error: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to load data'], 500);
        }
    }

    public function next_app_number(Request $request)
    {
        $date = $request->input('date');
        // dd($date);
        $next_app_number = TblOPDQueue::where('Date',$date)->max('DaiyCount');
        if (!$next_app_number) {
            $next_app_number = 1;
        } else {
            $next_app_number = $next_app_number + 1;
        }

        return response()->json(["success"=>true, "data"=>$next_app_number]);
    }

    public function load_patient_select_grid(Request $request)
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
                    $html = ' <button class="btn btn-success btn-sm waves-effect waves-light btn-select " type="button">Select</button>';
                    
                    return $html;
            })->toJson();
        }
    }

    public function save_patient_in_oppointment(Request $request)
    {
        $name = $request->input('name');
        $gender = $request->input('gender');
        $dob = $request->input('dob');
        $email = $request->input('email');
        $contact = $request->input('contact');
        $address = $request->input('address');

        if($gender=="Male"){
            $gender=1;
        }else{
            $gender=0;
        }

        $patient = new TblPatient();
        $patient->FullName = $name;
        $patient->Gender = $gender;
        $patient->BirthDay = $dob;
        $patient->Email = $email;
        $patient->Mobile = $contact;
        $patient->Address = $address;
        $patient->save();

        return response()->json(["success"=>true,"patient_id"=>$patient->ID,"patient_name"=>$patient->FullName]);
    }

    public function save_oppointment(Request $request)
    {
        $app_no = $request->input('app_no');
        $app_date = $request->input('app_date');
        $patient_id = $request->input('patient_id');
        $complaint = $request->input('complaint');

        $appointment = new TblOPDQueue();
        $appointment->Date = $app_date;
        $appointment->Doctor = $request->input('doctor_id');
        $appointment->DocQueueNo = $app_no;
        $appointment->Pt_id = $patient_id;
        $appointment->Pt_type = "OPD";
        $appointment->Pt_table = "tblcustomer";
        $appointment->Qno = null;
        $appointment->Narration = null;
        $appointment->Status = "New";
        $appointment->DaiyCount	= $app_no;
        $appointment->Complaint = $complaint;
        $appointment->SMS_Count = 1;
        $appointment->save();

        // SMS SEND ALERT
        // YOUR_VONAGE_API_SECRET === zqlmSSa53mdX4Slu

        try {
            $patient = TblPatient::find($patient_id);
            if ($patient && $patient->Mobile) {

                $mobile = preg_replace('/[^0-9]/', '', $patient->Mobile);
                if (substr($mobile, 0, 2) != '94') {
                    $mobile = '94' . ltrim($mobile, '0');
                }

                $basic = new Basic("10f41fc4", "zqlmSSa53mdX4Slu");
                $client = new Client($basic);

                $message = "Dear {$patient->FullName}, your appointment has been successfully scheduled for {$app_date}. Appointment Number: {$app_no}. Thank you for choosing CuraSys.";

                $client->sms()->send(
                    new \Vonage\SMS\Message\SMS($mobile, "CuraSys", $message)
                );
            } else {
                \Log::info("No mobile number found for patient ID: {$patient_id}. SMS not sent.");
            }
        } catch (\Exception $e) {
            \Log::error('SMS sending failed: ' . $e->getMessage());
        }

        $date = Carbon::now();
        $next_app_number = TblOPDQueue::where('Date',$date->format('Y-m-d'))->max('DaiyCount');
        // dd($next_app_number);
        if ($next_app_number == null) {
            $next_number = 1;
        } else {
            $next_number = $next_app_number + 1;
        }
        // dd($next_number);

        return response()->json(["success"=>true,"next_number"=>$next_number]);
    }

    public function cancel_appointment(Request $request)
    {
        $app_id = $request->input('app_id');

        $appointment = TblOPDQueue::where('ID', $app_id)->first();
        $appointment->Status = "Canceled";
        $appointment->save();

        if($appointment->save()){
            return response()->json(["success"=>true, "message"=>"Appointment Canceled Successfully"]);
        }else{
            return response()->json(["success"=>false, "message"=>"Appointment Canceled Failed."]);
        }
    }

    public function send_sms_to_appointment(Request $request)
    {
        $app_id = $request->input('app_id');

        // Fetch appointment with patient
        $appointment = TblOPDQueue::with('patient')->find($app_id);

        if (!$appointment) {
            return response()->json(["success" => false, "message" => "Appointment not found"]);
        }

        $patient = $appointment->patient;

        if (!$patient || !$patient->Mobile) {
            \Log::info("No mobile number found for patient ID: {$appointment->Pt_id}. SMS not sent.");
            return response()->json(["success" => false, "message" => "No mobile number found for patient"]);
        }

        try {
            // Format mobile number for Sri Lanka
            $mobile = preg_replace('/[^0-9]/', '', $patient->Mobile);
            if (substr($mobile, 0, 2) != '94') {
                $mobile = '94' . ltrim($mobile, '0');
            }

            $basic = new \Vonage\Client\Credentials\Basic("10f41fc4", "zqlmSSa53mdX4Slu");
            $client = new \Vonage\Client($basic);

            $app_date = $appointment->Date;
            $app_no = $appointment->DaiyCount;

            $message = "Dear {$patient->FullName}, your appointment has been successfully scheduled for {$app_date}. Appointment Number: {$app_no}. Thank you for choosing CuraSys.";

            $response = $client->sms()->send(
                new \Vonage\SMS\Message\SMS($mobile, "CuraSys", $message)
            );

            $messageResponse = $response->current();
            if ($messageResponse->getStatus() == 0) {
                // Update SMS count
                $appointment->SMS_Count = $appointment->SMS_Count + 1;
                $appointment->save();

                return response()->json(["success" => true, "message" => "SMS Sent Successfully"]);
            } else {
                \Log::error("SMS sending failed: " . $messageResponse->getErrorText());
                return response()->json(["success" => false, "message" => "SMS sending failed: " . $messageResponse->getErrorText()]);
            }

        } catch (\Exception $e) {
            \Log::error('SMS sending exception: ' . $e->getMessage());
            return response()->json(["success" => false, "message" => "SMS sending exception: " . $e->getMessage()]);
        }
    }

}
