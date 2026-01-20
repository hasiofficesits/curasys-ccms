<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\TblPatient;
use App\Models\TblInvoice;
use App\Models\TblInvoiceBody;
use App\Models\TblOPDAppointment;
use App\Models\TblOPDAppointmentBody;
use App\Models\TblMasterAcc;
use App\Models\TblNarration;
use App\Models\TblBank;
use App\Models\TblCash;
use App\Models\TblAccountSetting;
use App\Models\TblStockPharma;
use App\Models\TblStockPharmaLot;
use App\Models\TblGL;
use App\Models\TblCardTrn;
use App\Models\TblChq;
use App\Models\TblOPDService;
use App\Models\TblPtPrescription;
use App\Models\TblPtPrescriptionBody;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DueInvController extends Controller
{
    public function load_due_inv_page()
    {
        return view('cashier.sales.due_inv');
    }

    public function load_due_invoices(Request $request)
    {
        $today = date('Y-m-d');
        $yesterday = date('Y-m-d',strtotime("-1 days"));

        if ($request->ajax()) {

            // $appointment=TblOPDAppointment::where('Status', 'Done')->orderBy('ID', 'DESC')->where('Date','>=',$today)->where('Date','<=',$yesterday)->with('patient')->get();

            $appointment = TblOPDAppointment::where('Status', 'Done')
                ->whereBetween('Date', [$yesterday, $today])
                ->orderBy('ID', 'DESC')
                ->with('patient')
                ->get();

            return datatables()->of($appointment)
                ->addColumn('action', function ($row) {
                    $html = '<button class="btn btn-danger btn-sm waves-effect waves-light btn-remove me-1">Remove </button>';
                    $html .= '<a class="btn btn-success btn-sm waves-effect waves-light btn-view" href="/load_selected_due_inv_page/'.$row->ID.'">View</a>';
                    
                    return $html;
            })->toJson();
        }
    }

    public function load_selected_due_inv_page($id)
    {
        $appointment = TblOPDAppointment::where('ID', $id)->with('patient','doctor')->first();
        $app_body = TblOPDAppointmentBody::where('App_ID', $appointment->ID)->with('item','service')->get();
        // dd($app_body);

        return view('cashier.sales.select_dueinv',["appointment"=>$appointment, "app_body"=>$app_body]);
    }

    public function load_selected_due_inv_data($id)
    {
        $appointment = TblOPDAppointment::where('ID', $id)->with('patient','doctor')->first();
        $app_body = TblOPDAppointmentBody::where('App_ID', $appointment->ID)->with('item','service')->get();

        return response()->json(["app_body"=>$app_body, "appointment"=>$appointment]);
    } 

    public function load_taken_prescription(Request $request)
    {
        $app_id = $request->input('app_id');

        $appointment = TblOPDAppointment::where('ID', $app_id)->with('patient','doctor')->first();
        $app_body = TblOPDAppointmentBody::where('App_ID', $appointment->ID)->where('Type','TblStock_Pharma')->with('item','service')->get();

        return response()->json(["success"=>true, "data"=>$app_body]);
    }

    public function save_lot_to_body(Request $request)
    {
        $appointment_id = $request->input('appointment_id');
        $lot_id = $request->input('lot_id');
        $taken_qty = $request->input('taken_qty');
        $app_body_id = $request->input('app_body_id');
        $pharm_item = $request->input('pharm_item');

        $lot = TblStockPharmaLot::where('ID', $lot_id)->first();

        $app_body = TblOPDAppointmentBody::where('ID', $app_body_id)->first();
        $app_body->Qty_taken = $taken_qty;
        $app_body->Lot_ID = $lot_id;
        $app_body->Unit_Price = $lot->Price;
        $app_body->Total = $taken_qty*$lot->Price;
        $app_body->save();

        $pres = TblPtPrescription::where('Fk_Appointment_Id', $appointment_id)->first();
        $pres_body = TblPtPrescriptionBody::where('Pre_Id', $pres->Id)->get();

        foreach ($pres_body as $key => $value) {
            if ($value->Pharma_Id == $pharm_item) {
                $body = TblPtPrescriptionBody::where('Id', $value->Id)->first();
                $body->Lot_Id = $lot_id;
                $body->Qty_taken = $taken_qty;
                $body->save();
            }
        }

        return response()->json(["success"=>true]);
    }

    public function save_exist_dueinv(Request $request)
    {
        $appointment_id = $request->input('appointment_id');
        $app_body_grid = $request->input('app_body');

        $appointment = TblOPDAppointment::where('ID', $appointment_id)->first();
        // $app_body = TblOPDAppointmentBody::where('App_ID', $appointment->ID)->get();

        $body_data = json_decode($app_body_grid);

        foreach ($body_data as $key => $value) {

            $app_body = TblOPDAppointmentBody::where('ID',$value->ID)->first();
            if ($value->status == "old_updated") {
                if ($value->ID == $exist->ID) {

                    $app_body->Qty = $value->Qty;
                    $app_body->Total = $value->Total;
                    $app_body->save();

                    //prescription
                    $pres = TblPtPrescription::where('Fk_Appointment_Id', $appointment_id)->first();
                    $pres_body = TblPtPrescriptionBody::where('Pre_Id',$pres->Id)->get();
                }
            }
        }
        $deleted_body_data = $request->input('deleted_items');

        $deleted_item = json_decode($deleted_body_data);

        foreach ($deleted_item as $key => $value)
        {
            $body = TblOPDAppointmentBody::where('ID', $value->ID)->first();

            if($body)
            {
                $body->delete();
            }
        }

        return response()->json(["success"=>true]);
    }

    public function pay_invoice_appointment(Request $request)
    {
        $appointment_id = $request->input('appointment_id');

        if(!$appointment_id)
        {
            return response()->json(['success'=>false, 'message'=>"Invalid Appointment Number"]);
        }
        try
        {
            //transaction start
            DB::beginTransaction();

            $pay_amt = $request->input("pay_amt");
            $paid_amount = $request->input('paid_amount');

            $trn_date = $request->input("inv_date");

            $total = $request->input("total");
            $dis_val = $request->input("dis_val");
            $gross = $request->input("gross");

            //cash
            $cash_amount=$request->input("cash_amount");
            $cash_account_id=$request->input("cash_account_id");
            //card
            $card_amount=$request->input("card_amount");
            $card_type=$request->input("card_type");
            $card_number=$request->input("card_number");
            $card_bank=$request->input("institute");
            //cheque
            $cheque_amount=$request->input("cheque_amount");
            $cheque_date=$request->input("cheque_date");
            $cheque_bank=$request->input("cheque_bank");
            $cheque_number=$request->input("cheque_number");
            //bank
            $bank_amount=$request->input("bank_amount");
            $bank_transfer_branch=$request->input("bank_transfer_branch");
            //credit
            $credit_amount=$request->input("credit_amount");
            $credit_acc_ID = $request->input("credit_acc_ID");

            $invoice_bodies_encoded=$request->input("invoice_bodies");

            $pay = 0;
            $balance = 0;

            //Accounts
            $sales_account = TblAccountSetting::where('Name','SALES')->first();
            $cost_of_sales = TblAccountSetting::where('Name','COST OF SALES')->first();
            $stock_account = TblAccountSetting::where('Name','STOCK')->first();
            $given_discount = TblAccountSetting::where('Name','GIVEN DISCOUNT')->first();

            $appointment = TblOPDAppointment::where('ID', $appointment_id)->first();
            $app_body = TblOPDAppointmentBody::where('App_ID', $appointment->ID)->get();

            $customer=TblPatient::where("ID", $appointment->Pt_ID)->first();

            //IF CASHIER PAID MORE AMOUNT THAN BILL AMOUNT
            $extra_amount = null;

            if ($paid_amount > $pay_amt) {
                $extra_amount = $paid_amount - $pay_amt;
            } else {
                $extra_amount = 0;
            }

            //SAVE INVOICE
            $invoice = new TblInvoice();
            $invoice->code = "inv";
            $invoice->typecode = "app_inv";
            $invoice->date = $trn_date;
            $invoice->cusid = $appointment->Pt_ID;
            $invoice->type = "Appointment Sales";
            $invoice->AccCode = $sales_account->AccCode;
            $invoice->TaxAcc = null;
            $invoice->total = $total;
            $invoice->dis_val = $dis_val ?? 0;
            $invoice->net = $gross;
            $invoice->tax = 0;
            $invoice->gross = $gross;
            $invoice->pay = $paid_amount;
            $invoice->extra_pay = $extra_amount;
            $invoice->balance = 0;
            $invoice->status = "Paid";
            $invoice->ID = null;
            $invoice->HP = 0;
            $invoice->save();

            $cost_of_sale = 0;

            foreach ($app_body as $key => $value) {

                if ($value->Type == "TblStock_Pharma") {
                    $lot = TblStockPharmaLot::where('ID', $value->Lot_ID)->first();
                    $item = TblStockPharma::where('ID', $value->StockServiceID)->first();

                    $cost = $lot->Cost * $value->Qty_taken;
                    $cost_of_sale = $cost_of_sale + $cost;

                    $body = new TblInvoiceBody();
                    $body->invno = $invoice->invno;
                    $body->sn = 0;
                    $body->Lot_Id = $value->Lot_Id;
                    $body->code = $item->Code;
                    $body->description = $value->Description;
                    $body->rate = $value->Unit_Price;
                    $body->dis_val = $dis_val ?? 0;
                    $body->qty = $value->Qty_taken;
                    $body->total = $value->Total;
                    $body->save();

                    //REDUCE QTY ROM LOT
                    $exist_qty = $lot->QTY;
                    $new_qty = $exist_qty - $value->Qty_taken;
                    
                    $lot->QTY = $new_qty;
                    $lot->save();
                } else {
                        $service = TblOPDService::where('ID', $value->StockServiceID)->first();

                        // if (!$service) {
                        //     DB::rollBack();
                        //     return response()->json(['success' => false, 'message' => "Service ID {$value->StockServiceID} not found in database."]);
                        // }
                        $narration = TblNarration::where('ID', $service->Ledgeracc)->first();

                        $gl_acc_name = $narration ? $narration->Acc : null;
                        $gl_acc_id   = $narration ? $narration->ID : null;

                        // if (!$narration) {
                        //     DB::rollBack();
                        //     return response()->json(['success' => false, 'message' => "Configuration Error: The service '{$service->Name}' is linked to a Ledger Account (ID: {$service->Ledgeracc}) that does not exist. Please update this service in settings."]);
                        // }

                        $phm_gl = new TblGL();
                        $phm_gl->Date = $trn_date;
                        $phm_gl->Acc = $gl_acc_name;
                        $phm_gl->AccCode = $gl_acc_id;
                        $phm_gl->Description = "Appoitment Sales ( INV No : ".$invoice->invno.")(Customer : ".$customer->FullName.")";
                        $phm_gl->Reference = $invoice->invno;
                        $phm_gl->ReferenceType = "Invoice";
                        $phm_gl->Dr = 0;
                        $phm_gl->Cr = $value->Total;
                        $phm_gl->save();
    
                        $body = new TblInvoiceBody();
                        $body->invno = $invoice->invno;
                        $body->sn = 0;
                        $body->Lot_Id = null;
                        $body->code = $service->Name;
                        $body->description = $value->Description;
                        $body->rate = $value->Unit_Price;
                        $body->dis_val = $dis_val ?? 0;
                        $body->qty = $value->Qty;
                        $body->total = $value->Total;
                        $body->save();
                    // }
                }
            }
            $pharma_total = 0;
            foreach ($app_body as $key => $value) {
                if ($value->Type == "TblStock_Pharma") {
                    $pharma_total = $pharma_total + $value->Total;
                }
            }

            //Extra Income ------ CR
            $phm_gl = new TblGL();
            $phm_gl->Date = $trn_date;
            $phm_gl->Acc = $sales_account->Acc;
            $phm_gl->AccCode = $sales_account->AccCode;
            $phm_gl->Description = "Pharmacy Sales - Extra Income ( INV No : ".$invoice->invno.")(Customer : ".$customer->FullName.")";
            $phm_gl->Reference = $invoice->invno;
            $phm_gl->ReferenceType = "Invoice";
            $phm_gl->Dr = 0;
            $phm_gl->Cr = $extra_amount;
            $phm_gl->save();
            
            //Pharmacy Sales ---- CR
            $phm_gl = new TblGL();
            $phm_gl->Date = $trn_date;
            $phm_gl->Acc = $sales_account->Acc;
            $phm_gl->AccCode = $sales_account->AccCode;
            $phm_gl->Description = "Appoitment Sales ( INV No : ".$invoice->invno.")(Customer : ".$customer->FullName.")";
            $phm_gl->Reference = $invoice->invno;
            $phm_gl->ReferenceType = "Invoice";
            $phm_gl->Dr = 0;
            $phm_gl->Cr = $pharma_total;
            $phm_gl->save();

            //Cost Of Sales ---- DR
            $cos_gl = new TblGL();
            $cos_gl->Date = $trn_date;
            $cos_gl->Acc = $cost_of_sales->Acc;
            $cos_gl->AccCode = $cost_of_sales->AccCode;
            $cos_gl->Description = "Pharmacy Sales ( INV No : ".$invoice->invno.")(Customer : ".$customer->FullName.")";
            $cos_gl->Reference = $invoice->invno;
            $cos_gl->ReferenceType = "Invoice";
            $cos_gl->Dr = $cost_of_sale;
            $cos_gl->Cr = 0;
            $cos_gl->save();

            //Stock ---- CR
            $stock_gl = new TblGL();
            $stock_gl->Date = $trn_date;
            $stock_gl->Acc = $stock_account->Acc;
            $stock_gl->AccCode = $stock_account->AccCode;
            $stock_gl->Description = "Appoitment Sales ( INV No : ".$invoice->invno.")(Customer : ".$customer->FullName.")";
            $stock_gl->Reference = $invoice->invno;
            $stock_gl->ReferenceType = "Invoice";
            $stock_gl->Dr = 0;
            $stock_gl->Cr = $cost_of_sale;
            $stock_gl->save();

            if ($dis_val != 0) {
                //Discount ---- CR
                $stock_gl = new TblGL();
                $stock_gl->Date = $trn_date;
                $stock_gl->Acc = $given_discount->Acc;
                $stock_gl->AccCode = $given_discount->AccCode;
                $stock_gl->Description = "Pharmacy Sales ( INV No : ".$invoice->invno.")(Customer : ".$customer->FullName.")";
                $stock_gl->Reference = $invoice->invno;
                $stock_gl->ReferenceType = "Invoice";
                $stock_gl->Dr = $dis_val ?? 0;
                $stock_gl->Cr = 0;
                $stock_gl->save();
            }

            if($cash_amount>0){

                $cash_ledger_info=TblCash::where("ID",$cash_account_id)->first();

                //save in gl
                $tbl_gl=new TblGL();
                $tbl_gl->Date = $trn_date;
                $tbl_gl->Acc = $cash_ledger_info->Acc;
                $tbl_gl->AccCode = $cash_ledger_info->ledgeracc;
                $tbl_gl->Description = "Pharmacy Sales ( INV No : ".$invoice->invno.")(Customer : ".$customer->FullName.")";
                $tbl_gl->Reference = $invoice->invno;
                $tbl_gl->ReferenceType = "Invoice";
                $tbl_gl->Dr = $cash_amount;
                $tbl_gl->Cr=0;
                $tbl_gl->save();
            }

            if($card_amount>0){

                $narration_acc = TblAccountSetting::where("Name","CARD TRANSACTION - NON REALIZED")->first();

                //save in card trn
                $tblcardTrn = new TblCardTrn();
                $tblcardTrn->referenceNo = $invoice->invno;
                $tblcardTrn->Date = $trn_date;
                $tblcardTrn->refType = "Invoice";
                $tblcardTrn->Narration = $narration_acc->Acc;
                $tblcardTrn->CardNo = $card_number;
                $tblcardTrn->Type = $card_type;
                $tblcardTrn->PayAmt = $card_amount;
                $tblcardTrn->Claimed = "No";
                $tblcardTrn->save();

                //save in gl
                $tbl_gl=new TblGL();
                $tbl_gl->Date = $trn_date;
                $tbl_gl->Acc = "Card Transaction - Non Realized";
                $tbl_gl->AccCode = $narration_acc->AccCode;
                $tbl_gl->Description = "Pharmacy Sales ( INV No : ".$invoice->invno.")(Customer : ".$customer->FullName.")";
                $tbl_gl->Reference = $invoice->invno;
                $tbl_gl->ReferenceType = "Invoice";
                $tbl_gl->Dr = $card_amount;
                $tbl_gl->Cr = 0;
                $tbl_gl->save();
            }

            if($bank_amount>0){

                $bank = TblBank::where('BankCode', $bank_transfer_branch)->first();

                //save in gl
                $tbl_gl=new TblGL();
                $tbl_gl->Date = $trn_date;
                $tbl_gl->Acc = $bank_transfer_branch;
                $tbl_gl->AccCode = $bank->ledgeracc;
                $tbl_gl->Description = "Pharmacy Sales ( INV No : ".$invoice->invno.")(Customer : ".$customer->FullName.")";
                $tbl_gl->Reference = $invoice->invno;
                $tbl_gl->ReferenceType = "Invoice";
                $tbl_gl->Dr = $bank_amount;
                $tbl_gl->Cr = 0;
                $tbl_gl->save();
            }

            if($cheque_amount>0){

                $narration_acc=TblNarration::where("Acc","Cheques In Hand")->first();

                $tblchq=new TblChq();
                $tblchq->Date = $trn_date;
                $tblchq->Narration = $narration_acc->ID;
                $tblchq->Description = "Pharmacy Sales ( INV No : ".$invoice->invno.")(Customer : ".$customer->FullName.")";
                $tblchq->ChqNo = $cheque_number;
                $tblchq->PayBy = $customer->FullName;
                $tblchq->Dr = $cheque_amount;
                $tblchq->RealiseDate = $cheque_date;
                $tblchq->Ref = $invoice->invno;
                $tblchq->RefName = "Invoice";
                $tblchq->Bank = $cheque_bank;
                $tblchq->Company = "All";
                $tblchq->Hold = "No";
                $tblchq->save();

                //save in gl
                $tbl_gl = new TblGL();
                $tbl_gl->Date = $trn_date;
                $tbl_gl->Acc = "Cheques In Hand";
                $tbl_gl->AccCode = $narration_acc->ID;
                $tbl_gl->Description = "Pharmacy Sales ( INV No : ".$invoice->invno.")(Customer : ".$customer->FullName.")";
                $tbl_gl->Reference = $invoice->invno;
                $tbl_gl->ReferenceType = "Invoice";
                $tbl_gl->Dr = $cheque_amount;
                $tbl_gl->Cr = 0;
                $tbl_gl->save();
            }

            if($credit_amount>0){
                if($credit_account_code){

                    $acc_selected=TblNarration::where("ID", $credit_acc_ID)->first();
                    //save in gl
                    $tbl_gl=new TblGL();
                    $tbl_gl->Date = $trn_date;
                    $tbl_gl->Acc = $acc_selected->Acc;
                    $tbl_gl->AccCode = $acc_selected->ID;
                    $tbl_gl->Description = "Pharmacy Sales ( INV No : ".$invoice->invno.")(Customer : ".$customer->FullName.")";
                    $tbl_gl->Reference = $invoice->invno;
                    $tbl_gl->ReferenceType = "Invoice";
                    $tbl_gl->Dr = $credit_amount;
                    $tbl_gl->Cr = 0;
                    $tbl_gl->save();

                }else{
                    throw new \Exception("Tansfer account is invalid");
                }
            }

            $appointment->Status = "Paid";
            $appointment->save();
            
            DB::commit();
            return response()->json(['success'=>true, "Invoice_no"=>$invoice->invno]);
        } catch (\Exception $e) {
            //transaction rollbabk
            DB::rollBack();
            return $e;
        }
    }

    public function remove_due_inv(Request $request)
    {
        $inv_id = $request->input('inv_id');

        $appointment = TblOPDAppointment::where('ID', $inv_id)->first();
        $appointment->Status = "Remove";
        $appointment->save();

        if($appointment->save()){
            return response()->json(["success"=>true, "message"=>"Appointment Removed Successfully."]);
        }else{
            return response()->json(["success"=>false, "message"=>"Selected Appointment is Missing or Invalid"]);
        }
    }
}
