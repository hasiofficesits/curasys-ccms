<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\TblOPDAppointment;
use App\Models\TblOPDAppointmentBody;
use App\Models\TblSahanyaCompany;
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

use Barryvdh\DomPDF\Facade\Pdf;

class CompleteAppController extends Controller
{
    public function load_complete_page()
    {
        return view('cashier.appointment.complete');
    }

    public function load_complete_appointment(Request $request)
    {
        $today = date('Y-m-d');
        $yesterday = date('Y-m-d',strtotime("-1 days"));
        // dd($yesterday);

        if ($request->ajax()) {

            // $appointment=TblOPDAppointment::where('Status','Done')->orderBy('ID', 'DESC')->with('patient')->where('Date','>=',$today)->where('Date','<=',$yesterday)->get();
            // $appointment = TblOPDAppointment::where('Status', 'Done')->where('Date', '>=', $today)->where('Date', '>', $yesterday)->orderBy('ID', 'DESC')->with('patient')->get();
            $appointment = TblOPDAppointment::where('Status', 'Done')
                ->whereBetween('Date', [$yesterday, $today])
                ->orderBy('ID', 'DESC')
                ->with('patient')
                ->get();
            // dd($appointment);

            return datatables()->of($appointment)
                ->addColumn('action', function ($row) {
                    $html = '<button class="btn btn-success btn-sm waves-effect waves-light btn-view">View</button> ';
                    $html .= ' <button class="btn btn-danger btn-sm waves-effect waves-light btn-print">Print</button>';

                    return $html;
            })->toJson();
        }
    }

    public function appointment($print_size, $appointment_id)
    {
        $company = TblSahanyaCompany::first();
        $appointment = TblOPDAppointment::where('ID', $appointment_id)->with('patient','doctor')->first();
        $app_body = TblOPDAppointmentBody::where('App_ID', $appointment_id)->get();

        $service = TblOPDAppointmentBody::where('App_ID', $appointment_id)->where('Type','Service')->get();

        $prescription = TblPtPrescription::where('Fk_Appointment_Id', $appointment_id)->first();

        if ($prescription) {
            $prescription_body = TblPtPrescriptionBody::where('Pre_Id', $prescription->Id)->with('item')->get();
            $pres_body = $prescription_body;
        } else {
            $pres_body = [];
        }

        $note = TblPtClinicalNote::where('Fk_Appointment_Id', $appointment_id)->first();
        if ($note) {
            $clinical_body = TblPtClinicalNoteBody::where('Note_Id', $note->Id)->get();
            $note_body = $clinical_body;
        } else {
            $note_body = [];
        }

        $ix_result = TblPtIX::where('Fk_Appointment_Id', $appointment_id)->get();
        $ix_body = TblPtIXBody::get();

        if ($ix_result) {
            $result = $ix_result;
        } else {
            $result = [];
        }


        $data = [
            "company" => $company,
            'appointment' => $appointment,
            "app_body"=>$app_body,
            "prescription"=>$prescription,
            "pres_body"=>$pres_body,
            "note"=>$note,
            "note_body"=>$note_body,
            "result"=>$result,
            "ix_body"=>$ix_body,
            "service"=>$service,
        ];

        $pdf = Pdf::loadView('pdf.view_app', $data);
        $pdf->setPaper($print_size);
        return $pdf->stream('appointment_' . $appointment_id . '.pdf');
    }
}
