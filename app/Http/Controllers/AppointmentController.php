<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\TblOPDAppointment;
use App\Models\TblOPDAppointmentBody;
use App\Models\TblOPDQueue;
use App\Models\TblPatient;
use App\Models\TblPtPrescription;
use App\Models\TblPtPrescriptionBody;
use App\Models\TblPtClinicalNote;
use App\Models\TblPtClinicalNoteBody;
use App\Models\TblPtIX;
use App\Models\TblPtIXBody;
use App\Models\TblPtIXOrder;
use App\Models\TblDoctor;
use App\Models\TblOPDService;
use App\Models\TblStockPharmaLot;
use App\Models\TblFrequency;
use App\Models\TblOpdDosageList;

use DB;
use Carbon\Carbon;

class AppointmentController extends Controller
{
    public function load_appointment_page()
    {
        return view('appointment.appointment.new_appointment');
    }

    public function load_app_queue_grid(Request $request)
    {
        if ($request->ajax()) {

            $opd_queue=TblOPDQueue::where('Status','!=', 'Done')->orderBy('ID', 'DESC')->with('patient')->limit(100)->get();

            return datatables()->of($opd_queue)
                ->addColumn('action', function ($row) {
                    if ($row->Status == "Due") {
                        // $appointment = TblOPDAppointment::where('Qno', $row->ID)->first();
                        $html = '<a class="btn btn-success btn-sm waves-effect waves-light btn-select" href="/select_chennel_page/'.$row->ID.'">Select</a>';
                    }  else if($row->Status == "Done") {
                        $html = '<button class="btn btn-warning btn-sm waves-effect waves-light btn-done">Done</button> ';
                    } else if($row->Status == "True") {
                        $html = '<button class="btn btn-warning btn-sm waves-effect waves-light btn-done">Done</button> ';
                    } else {
                        $html = '<button class="btn btn-info btn-sm waves-effect waves-light btn-make">Make Appointment</button> ';
                    }
                    // $html = '<button class="btn btn-success btn-sm waves-effect waves-light btn-select">Select</button> ';
                    
                    return $html;
            })->toJson();
        }
    }

    public function select_chennel_page($id)
    {
        $que_id = $id;
        $appointment = TblOPDAppointment::where('Qno',$id)->with('doctor','patient')->first();
        return view('appointment.appointment.select_app',["appointment"=>$appointment, "que_id"=>$que_id]);
    }

    public function load_history_data(Request $request)
    {
        $appointment_id = $request->input('appointment_id');

        $prescription = TblPtPrescription::where('Fk_Appointment_Id', $appointment_id)->first();
        if ($prescription) {
            $pres_id = $prescription->Id;
            $pres_body = TblPtPrescriptionBody::where('Pre_Id', $pres_id)->with('item')->get();
        } else {
            $pres_body = [];
        }
        
        $note = TblPtClinicalNote::where('Fk_Appointment_Id', $appointment_id)->first();
        if ($note) {
            $note_id = $note->Id;
            $note_body = TblPtClinicalNoteBody::where('Note_Id', $note_id)->with('head')->get();
        } else {
            $note_body = [];
        }

        $investigation = TblPtIX::where('Fk_Appointment_Id',$appointment_id)->with('body')->get();

        $order = TblPtIXOrder::where('Fk_Appointment_Id',$appointment_id)->first();
        if ($order) {
            $inv_order = $order;
        } else {
            $inv_order = [];
        }

        $service = TblOPDAppointmentBody::where('App_ID', $appointment_id)->where('Type', 'Service')->get();
        if ($service) {
            $opd_ser = $service;
        } else {
            $opd_ser = [];
        }
        

        return response()->json(["success"=>true, "pres_body"=>$pres_body, "note_body"=>$note_body, "investigation"=>$investigation, "inv_order"=>$inv_order, "opd_ser"=>$opd_ser]);
    }

    public function load_doctor_appo(Request $request)
    {
        $doctor = TblDoctor::get();
        return response()->json(["success"=>true, "data"=>$doctor]);
    }

    public function load_frequency_appoi(Request $request)
    {
        $frequency = TblFrequency::where('Isdelete',0)->get();
        return response()->json(["success"=>true, "data"=>$frequency]);
    }

    public function load_unit_appoi(Request $request)
    {
        $unit = TblOpdDosageList::where('Isdelete',0)->get();
        return response()->json(["success"=>true, "data"=>$unit]);
    }

    public function save_appointment_table(Request $request)
    {
        $que_id = $request->input('que_id');
        $doctor_id = $request->input('doctor_id');

        if ($doctor_id == null) {
            return response()->json(["success"=>false, "message"=>"Doctor Required!"]);
        } else {
            $que = TblOPDQueue::where('ID', $que_id)->first();

            $new_app = new TblOPDAppointment();
            $new_app->Date = Carbon::now();
            $new_app->Pt_ID = $que->Pt_id;
            $new_app->Pt_Table = "tblcustomer";
            $new_app->Dr_ID = $doctor_id;
            $new_app->Time = Carbon::now(new \DateTimeZone('Asia/Colombo'))->format('H:i');
            $new_app->Complain = $que->Complaint;
            $new_app->Qno = $que->ID;
            $new_app->Inv = null;
            $new_app->User_id = null;
            $new_app->Status = "Due";
            $new_app->save();

            $que->Status = "Due";
            $que->save();
        }


        return response()->json(["success"=>true]);
    }

    public function save_prescription(Request $request)
    {
        $app_id = $request->input('app_id');
        $body_data = $request->input('body_data');
        $deleted_body_data = $request->input('deleted_items');

        if ($request->pres_image !== 'not') {
            $imageName = time() . "." . $request->pres_image->extension();
            $request->pres_image->move(public_path('pres_image'), $imageName);

        } else {
            $imageName = '';
        }

        $appointment = TblOPDAppointment::where('ID', $app_id)->first();
        // dd($appointment);

        //Delete Prescription item
        $deleted_item = json_decode($deleted_body_data);

        foreach ($deleted_item as $key => $value)
        {
            $exist_prescription_body = TblPtPrescriptionBody::where('Id', $value->ID)->first();
            // dd($exist_prescription_body->Pharma_Id);
            $exist_app_body = TblOPDAppointmentBody::where('App_ID',$appointment->ID)->where('StockServiceID',$exist_prescription_body->Pharma_Id)->where('Type','TblStock_Pharma')->first();

            if($exist_prescription_body)
            {
                $exist_prescription_body->delete();
            }
            if ($exist_app_body) {
                $exist_app_body->delete();
            }
        }

        $exist_prescription = TblPtPrescription::where('Fk_Appointment_Id', $appointment->ID)->first();

        if ($exist_prescription == null) {

            //save prescription
            $pres = new TblPtPrescription();
            $pres->Pt_ID = $appointment->Pt_ID;
            $pres->Dr_ID = $appointment->Dr_ID;
            $pres->Date = Carbon::now();
            $pres->Active = 0;
            $pres->ImageString = 'pres_image'.'/'.$appointment->ID.'/'.$appointment->Pt_ID.'/'.$imageName;
            $pres->Fk_Appointment_Id = $appointment->ID;
            $pres->save();

            $pres_bodies = json_decode($body_data);

            foreach ($pres_bodies as $key => $value) {

                if ($value->status == "new_add") {
                    //Prescription body
                    $pres_body = new TblPtPrescriptionBody();
                    $pres_body->Pre_Id = $pres->Id;
                    $pres_body->Date = Carbon::now();
                    $pres_body->Pharma_Id = $value->ID;
                    $pres_body->Lot_Id = null;
                    $pres_body->Period = $value->Period;
                    $pres_body->Dose = $value->Dose;
                    $pres_body->Dose_Type = null;
                    $pres_body->Qty = $value->Qty;
                    $pres_body->Unit = $value->Unit;
                    $pres_body->Freq = $value->Freq;
                    $pres_body->Period_Type	= null;
                    $pres_body->save();

                    //appointment body
                    $app_body = new TblOPDAppointmentBody();
                    $app_body->App_ID = $appointment->ID;
                    $app_body->StockServiceID = $value->ID;
                    $app_body->Lot_ID = null;
                    $app_body->Type = "TblStock_Pharma";
                    $app_body->Narration = $appointment->Complain;
                    $app_body->Description = $value->Name;
                    $app_body->Freq = $value->Freq;
                    $app_body->Dose = $value->Dose;
                    $app_body->Unit = $value->Unit;
                    $app_body->Qty = $value->Qty;
                    $app_body->Unit_Price = null;
                    $app_body->Total = null;
                    $app_body->Period = $value->Period;
                    $app_body->Period_Type = null;
                    $app_body->save();

                } elseif ($value->status == "old_updated")
                {
                    $pres_body = TblPtPrescriptionBody::where('Id', $value->ID)->first();
                    $pres_body->Period = $value->Period;
                    $pres_body->Dose = $value->Dose;
                    $pres_body->save();

                    $app_body = TblOPDAppointmentBody::where('App_ID',$appointment->ID)->where('StockServiceID',$pres_body->Pharma_Id)->where('Lot_ID',$pres_body->Lot_Id)->first();
                    $app_body->Dose = $value->Dose;
                    $app_body->Period = $value->Period;
                    $app_body->save();
                } else {}
                
            }
        } else {
            $pres_bodies = json_decode($body_data);
            $exist_prescription->ImageString = 'pres_image'.'/'.$appointment->ID.'/'.$appointment->Pt_ID.'/'.$imageName;

            foreach ($pres_bodies as $key => $value) {

                if ($value->status == "new_add") {
                    //Prescription body
                    $pres_body = new TblPtPrescriptionBody();
                    $pres_body->Pre_Id = $exist_prescription->Id;
                    $pres_body->Date = Carbon::now();
                    $pres_body->Pharma_Id = $value->ID;
                    $pres_body->Lot_Id = null;
                    $pres_body->Period = $value->Period;
                    $pres_body->Dose = $value->Dose;
                    $pres_body->Dose_Type = null;
                    $pres_body->Qty = $value->Qty;
                    $pres_body->Unit = $value->Unit;
                    $pres_body->Freq = $value->Freq;
                    $pres_body->Period_Type	= null;
                    $pres_body->save();

                    //appointment body
                    $app_body = new TblOPDAppointmentBody();
                    $app_body->App_ID = $appointment->ID;
                    $app_body->StockServiceID = $value->ID;
                    $app_body->Lot_ID = null;
                    $app_body->Type = "TblStock_Pharma";
                    $app_body->Narration = $appointment->Complain;
                    $app_body->Description = $value->Name;
                    $app_body->Freq = $value->Freq;
                    $app_body->Dose = $value->Dose;
                    $app_body->Unit = $value->Unit;
                    $app_body->Qty = $value->Qty;
                    $app_body->Unit_Price = null;
                    $app_body->Total = null;
                    $app_body->Period = $value->Period;
                    $app_body->Period_Type = null;
                    $app_body->save();

                } elseif ($value->status == "old_updated")
                {
                    $pres_body = TblPtPrescriptionBody::where('Id', $value->ID)->first();
                    $pres_body->Period = $value->Period;
                    $pres_body->Dose = $value->Dose;
                    $pres_body->save();

                    $app_body = TblOPDAppointmentBody::where('App_ID',$appointment->ID)->where('StockServiceID',$pres_body->Pharma_Id)->where('Lot_ID',$pres_body->Lot_Id)->first();
                    $app_body->Dose = $value->Dose;
                    $app_body->Period = $value->Period;
                    $app_body->save();
                } else {}
                
            }
        }

        return response()->json(["success"=>true]);
    }

    public function save_clinical_note(Request $request)
    {
        $app_id = $request->input('app_id');
        $body_data = $request->input('body_data');
        $deleted_body_data = $request->input('deleted_items');

        $appointment = TblOPDAppointment::where('ID', $app_id)->first();

        //Delete Note
        $deleted_item = json_decode($deleted_body_data);

        foreach ($deleted_item as $key => $value)
        {
            $exist_note_delete = TblPtClinicalNoteBody::where('Description', $value->Note)->first();

            if($exist_note_delete)
            {
                $exist_note_delete->delete();
            }
        }

        $exist_note = TblPtClinicalNote::where('Fk_Appointment_Id', $appointment->ID)->first();

        $note_bodies = json_decode($body_data);

        if ($exist_note == null) {
            //save note
            $note = new TblPtClinicalNote();
            $note->Date = Carbon::now();
            $note->Pt_Id = $appointment->Pt_ID;
            $note->Dr_Id = $appointment->Dr_ID;
            $note->Active = 0;
            $note->ImageString = null;
            $note->Fk_Appointment_Id = $appointment->ID;
            $note->save();

            foreach ($note_bodies as $key => $value) {
                if ($value->status == "new_add") {

                    $body = new TblPtClinicalNoteBody();
                    $body->Note_Id = $note->Id;
                    $body->Type = $value->Category;
                    $body->Narration = $appointment->Complain;
                    $body->Description = $value->Note;
                    $body->save();

                } elseif ($value->status == "old_updated")
                {
                    $body = TblPtClinicalNoteBody::where('Id', $value->ID)->first();
                    $body->Description = $value->Note;
                    $body->save();
                }
                
            }
        } else {
            foreach ($note_bodies as $key => $value) {
                if ($value->status == "new_add") {

                    $body = new TblPtClinicalNoteBody();
                    $body->Note_Id = $exist_note->Id;
                    $body->Type = $value->Category;
                    $body->Narration = $appointment->Complain;
                    $body->Description = $value->Note;
                    $body->save();

                } elseif ($value->status == "old_updated")
                {
                    $body = TblPtClinicalNoteBody::where('Id', $value->ID)->first();
                    $body->Description = $value->Note;
                    $body->save();
                }
                
            }
        }

        return response()->json(["success"=>true]);
    }

    public function load_opd_service(Request $request)
    {
        $service = TblOPDService::where('IsDelete',0)->get();
        return response()->json(["success"=>true, "data"=>$service]);
    }

    public function load_service_details(Request $request)
    {
        $service_id = $request->input('service_id');

        $service = TblOPDService::where('ID', $service_id)->first();
        return response()->json(["success"=>true, "data"=>$service]);
    }

    public function save_opd_service_appointment(Request $request)
    {
        $app_id = $request->input('app_id');
        $body_data = $request->input('body_data');
        $deleted_body_data = $request->input('deleted_items');

        $appointment = TblOPDAppointment::where('ID', $app_id)->first();

        //Delete Note
        $deleted_item = json_decode($deleted_body_data);

        foreach ($deleted_item as $key => $value)
        {
            $exist_body_delete = TblOPDAppointmentBody::where('App_ID',$app_id)->where('StockServiceID', $value->ID)->first();

            if($exist_body_delete)
            {
                $exist_body_delete->delete();
            }
        }

        $service_bodies = json_decode($body_data);

        foreach ($service_bodies as $key => $value) {

            $service = TblOPDService::where('ID', $value->ID)->first();

            $exist_body = TblOPDAppointmentBody::where('App_ID',$appointment->ID)->where('StockServiceID', $value->ID)->first();

            if ($exist_body) {
                if ($value->status == "old_updated") {
                    $exist_body->Qty = $value->Qty;
                }
            } else {
                //appointment body
                $app_body = new TblOPDAppointmentBody();
                $app_body->App_ID = $appointment->ID;
                $app_body->StockServiceID = $value->ID;
                $app_body->Lot_ID = null;
                $app_body->Type = "Service";
                $app_body->Narration = "Service";
                $app_body->Description = $value->Name;
                $app_body->Freq = null;
                $app_body->Dose = null;
                $app_body->Unit = null;
                $app_body->Qty = $value->Qty;
                $app_body->Qty_taken = $value->Qty;
                $app_body->Unit_Price = $value->Unit_price;
                $app_body->Total = $value->Total;
                $app_body->Period = null;
                $app_body->Period_Type = null;
                $app_body->save();
            }

        }

        return response()->json(["success"=>true]);
    }

    public function save_invest_order(Request $request)
    {
        $app_id = $request->input('app_id');
        $body_data = $request->input('body_data');
        $deleted_body_data = $request->input('deleted_items');

        $appointment = TblOPDAppointment::where('ID', $app_id)->first();
        $note = TblPtClinicalNote::where('Fk_Appointment_Id',$appointment->ID)->first();

        //Delete Note
        $deleted_item = json_decode($deleted_body_data);

        foreach ($deleted_item as $key => $value)
        {
            $exist_body_delete = TblPtIXOrder::where('Fk_Appointment_Id',$app_id)->where('Id', $value->ID)->first();

            if($exist_body_delete)
            {
                $exist_body_delete->delete();
            }
        }

        $order_bodies = json_decode($body_data);

        foreach ($order_bodies as $key => $value) {

            if ($value->status == "new_add") {
                $order = new TblPtIXOrder();
                if ($note) {
                    $order->Clinical_note_id = $note->Id;
                } else {
                    $order->Clinical_note_id = null;
                }
                $order->Ix_type = $value->Type;
                $order->Unit_id = null;
                $order->Narrations = $value->Narrarion;
                $order->Speciman = $value->Speciman;
                $order->Status = "Due";
                $order->Fk_Appointment_Id = $appointment->ID;
                $order->save();

            } else if ($value->status == "old_updated") {

                $exist_order = TblPtIXOrder::where('Id', $value->ID)->first();
                $exist_order->Ix_type = $value->Type;
                $exist_order->Narrations = $value->Narrarion;
                $exist_order->Speciman = $value->Speciman;
                $exist_order->save();

            }
        }

        return response()->json(["success"=>true]);
        
    }

    public function save_invest_result(Request $request)
    {
        $app_id = $request->input('app_id');
        $body_data = $request->input('body_data');
        $type = $request->input('type');
        $mlt = $request->input('mlt');
        $date = $request->input('date');
        $deleted_body_data = $request->input('deleted_items');

        $appointment = TblOPDAppointment::where('ID', $app_id)->first();

        //Delete Note
        $deleted_item = json_decode($deleted_body_data);

        foreach ($deleted_item as $key => $value)
        {
            $exist_body_delete = TblPtIXBody::where('Id',$value->ID)->first();

            if($exist_body_delete)
            {
                $exist_body_delete->delete();
            }
        }

        $result_bodies = json_decode($body_data);
        // dd($result_bodies);

        $exist_result = TblPtIX::where('Fk_Appointment_Id', $appointment->ID)->first();

        //Save result head
        $head = new TblPtIX();
        $head->Order_Id = null;
        $head->Date = $date;
        $head->Lab_Id = null;
        $head->Status = "Done";
        $head->Mlt = $mlt;
        $head->Ix = $type;
        $head->Fk_Appointment_Id = $appointment->ID;
        $head->save();

        foreach ($result_bodies as $key => $value) {
            $body = new TblPtIXBody();
            $body->Ix_id = $head->Id;
            $body->Narration = $value->Narration;
            $body->Results = $value->Result;
            $body->Normal_range = $value->Range;
            $body->Status = "Done";
            $body->save();
        }

        return response()->json(["success"=>true]);
    }

    public function load_exist_appointment_details(Request $request)
    {
        $selected_appointment = $request->input('selected_appointment');

        $prescription = TblPtPrescription::where('Fk_Appointment_Id', $selected_appointment)->first();
        if ($prescription) {
            $pres_id = $prescription->Id;
            $pres_body = TblPtPrescriptionBody::where('Pre_Id', $pres_id)->with('item')->get();
        } else {
            $pres_body = [];
        }

        $note = TblPtClinicalNote::where('Fk_Appointment_Id', $selected_appointment)->first();
        if ($note) {
            $note_id = $note->Id;
            $note_body = TblPtClinicalNoteBody::where('Note_Id', $note_id)->with('head')->get();
        } else {
            $note_body = [];
        }
        

        $investigation = TblPtIX::where('Fk_Appointment_Id', $selected_appointment)->first();
        // dd($investigation);
        if ($investigation) {
            $inv_id = $investigation->Id;
            $inves_body = TblPtIXBody::where('Ix_id', $inv_id)->with('head')->get();
        } else {
            $inves_body = [];
        }
        
        $inves = TblPtIXOrder::where('Fk_Appointment_Id', $selected_appointment)->get();
        if ($inves) {
            $inves_order = TblPtIXOrder::where('Fk_Appointment_Id', $selected_appointment)->get();
        } else {
            $inves_order = [];
        }

        $opd = TblOPDAppointmentBody::where('App_ID', $selected_appointment)->where('Type','Service')->get();
        if ($opd) {
            $opd_service = TblOPDAppointmentBody::where('App_ID', $selected_appointment)->where('Type','Service')->get();
        } else {
            $opd_service = [];
        }

        return response()->json(["success"=>true, "pres_body"=>$pres_body, "note_body"=>$note_body, "investigation"=>$investigation, "inves_body"=>$inves_body, "inves_order"=>$inves_order, "opd_service"=>$opd_service]);

    }

    public function record_appointment(Request $request)
    {
        $appointment_id = $request->input('appointment_id');
        $que_id = $request->input('que_id');

        $appointment = TblOPDAppointment::where('ID', $appointment_id)->first();
        $appointment->Status = "Done";
        $appointment->save();

        $que = TblOPDQueue::where('ID', $que_id)->first();
        $que->Status = "Done";
        $que->save();

        return response()->json(["success"=>true]);
    }

    public function load_result_bodyHistory(Request $request)
    {
        $result_ID = $request->input('result_ID');

        $investigation = TblPtIX::where('Id', $result_ID)->first();
        if ($investigation) {
            $inv_id = $investigation->Id;
            $inves_body = TblPtIXBody::where('Ix_id', $inv_id)->get();
        } else {
            $inves_body = [];
        }

        return response()->json(["success"=>true, "inves_body"=>$inves_body]);
    }
}
