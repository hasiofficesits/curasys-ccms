<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\TblPatient;
use App\Models\TblInvoice;
use App\Models\TblInvoiceBody;
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
use App\Models\TblSahanyaCompany;

use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class SalesController extends Controller
{
    public function load_sales_page(Request $request)
    {
        $next_inv = TblInvoice::max('invno');
        // dd($next_inv);
        if ($next_inv == null) {
            $next_number = 1;
        } else {
            $next_number = $next_inv + 1;
        }

        return view('cashier.sales.sales',["next_inv_no"=>$next_number]);
    }

    public function load_lot_details_to_invoice(Request $request)
    {
        $item_id = $request->input('item_id');
        $lot = TblStockPharmaLot::where('FKStock_ID',$item_id)->where('Isdelete',0)->where('Exp_date','>',now())->get();
        return response()->json(["success"=>true, "data"=>$lot]);
    }

    public function load_next_inv(Request $request)
    {
        $next_inv = TblInvoice::max('invno');
        // dd($next_inv);
        if ($next_inv == null) {
            $next_number = 1;
        } else {
            $next_number = $next_inv + 1;
        }
        return response()->json(["success"=>true, "data"=>$next_number]);
    }

    public function load_customer_to_invoice(Request $request)
    {
        $customer = TblPatient::limit(100)->get();
        return response()->json(["success"=>true, "data"=>$customer]);
    }

    public function ajax_get_debotor_accs(Request $request)
    {
        $master_acc = TblMasterAcc::where('MasterAcc', 'Debtor')->first();
        $account = TblNarration::where('MasterAcc', $master_acc->ID)->get();

        return response()->json(["success"=>true, "data"=>$account]);
    }

    public function ajax_get_banks(Request $request)
    {
        $bank = TblBank::orderBy("ID","desc")->get();
        return response()->json(["success"=>true, "data"=>$bank]);
    }

    public function ajax_get_cash_ledgers(Request $request)
    {
        $cash_acc = TblCash::get();
        return response()->json(["success"=>true, "data"=>$cash_acc]);
    }

    // public function check_lot_available(Request $request)
    // {
    //     $Lot_Id = $request->input('Lot_Id');
    //     $Qty = $request->input('Qty');

    //     $lot = TblStockPharmaLot::where('ID', $Lot_Id)->first();
    //     $exist_qty = $lot->QTY;
    //     if ($exist_qty < $Qty) {
    //         return response()->json(['success'=>false, 'message'=>"Quentity Level Exceeded"]);
    //     } else {
    //         return response()->json(["success"=>true]);
    //     }
    // }

    public function pay_invoice(Request $request)
    {
        $invoice_number = $request->input('invoice_number');

        if(!$invoice_number)
        {
            return response()->json(['success'=>false, 'message'=>"Invalid Invoice Number"]);
        }
        try
        {
            //transaction start
            DB::beginTransaction();

            $pay_amt = $request->input("pay_amt");
            $paid_amount = $request->input('paid_amount');

            $cusid = $request->input("customer_id");

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

            if ($cusid == null) {
                $customer = TblPatient::where("FullName", "Cash")->first();
            } else {
                $customer = TblPatient::where("ID", $cusid)->first();
            }
            // dd($customer);
            
            //Accounts
            $sales_account = TblAccountSetting::where('Name','SALES')->first();
            $cost_of_sales = TblAccountSetting::where('Name','COST OF SALES')->first();
            $stock_account = TblAccountSetting::where('Name','STOCK')->first();
            $given_discount = TblAccountSetting::where('Name','GIVEN DISCOUNT')->first();

            //IF CASHIER PAID MORE AMOUNT THAN BILL AMOUNT
            $extra_amount = null;

            if ($paid_amount > $pay_amt) {
                $extra_amount = $paid_amount - $pay_amt;
            } else {
                $extra_amount = 0;
            }
            // dd($extra_amount);

            //SAVE INVOICE
            $invoice = new TblInvoice();
            $invoice->code = "inv";
            $invoice->typecode = "phm_inv";
            $invoice->date = $trn_date;
            $invoice->cusid = $customer ? $customer->ID : 0;
            $invoice->type = "Pharmacy Sales";
            $invoice->AccCode = $sales_account->AccCode;
            $invoice->TaxAcc = null;
            $invoice->total = $total;
            $invoice->dis_val = $dis_val;
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

            $invoice_bodies=json_decode($invoice_bodies_encoded);

            $cost_of_sale = 0;

            foreach ($invoice_bodies as $key => $value) {
                $lot = TblStockPharmaLot::where('ID', $value->Lot_Id)->first();
                $item = TblStockPharma::where('ID', $value->ID)->first();

                // dd($value->Qty);
                $cost = $lot->Cost * $value->Qty;
                $cost_of_sale = $cost_of_sale + $cost;

                $body = new TblInvoiceBody();
                $body->invno = $invoice->invno;
                $body->sn = 0;
                $body->Lot_Id = $value->Lot_Id;
                $body->code = $item->Code;
                $body->description = $value->Name;
                $body->rate = $value->Unit_Pice;
                $body->dis_val = $value->Discount;
                $body->qty = $value->Qty;
                $body->total = $value->Total;
                $body->save();

                //REDUCE QTY ROM LOT
                $exist_qty = $lot->QTY;
                $new_qty = $exist_qty - $value->Qty;
                
                $lot->QTY = $new_qty;
                $lot->save();
            }

            //Extra Income ------ CR
            $phm_gl = new TblGL();
            $phm_gl->Date = $trn_date;
            $phm_gl->Acc = $sales_account->Acc;
            $phm_gl->AccCode = $sales_account->AccCode;
            $phm_gl->Description = "Pharmacy Sales - Extra Income ( INV No : ".$invoice->invno.")(Customer : ".(optional($customer)->FullName ?? 'Cash').")";
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
            $phm_gl->Description = "Pharmacy Sales ( INV No : ".$invoice->invno.")(Customer : ".(optional($customer)->FullName ?? 'Cash').")";
            $phm_gl->Reference = $invoice->invno;
            $phm_gl->ReferenceType = "Invoice";
            $phm_gl->Dr = 0;
            $phm_gl->Cr = $total;
            $phm_gl->save();

            //Cost Of Sales ---- DR
            $cos_gl = new TblGL();
            $cos_gl->Date = $trn_date;
            $cos_gl->Acc = $cost_of_sales->Acc;
            $cos_gl->AccCode = $cost_of_sales->AccCode;
            $cos_gl->Description = "Pharmacy Sales ( INV No : ".$invoice->invno.")(Customer : ".(optional($customer)->FullName ?? 'Cash').")";
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
            $stock_gl->Description = "Pharmacy Sales ( INV No : ".$invoice->invno.")(Customer : ".(optional($customer)->FullName ?? 'Cash').")";
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
                $stock_gl->Description = "Pharmacy Sales ( INV No : ".$invoice->invno.")(Customer : ".(optional($customer)->FullName ?? 'Cash').")";
                $stock_gl->Reference = $invoice->invno;
                $stock_gl->ReferenceType = "Invoice";
                $stock_gl->Dr = $dis_val;
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
                $tbl_gl->Description = "Pharmacy Sales ( INV No : ".$invoice->invno.")(Customer : ".(optional($customer)->FullName ?? 'Cash').")";
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
                $tbl_gl->Description = "Pharmacy Sales ( INV No : ".$invoice->invno.")(Customer : ".(optional($customer)->FullName ?? 'Cash').")";
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
                $tbl_gl->Description = "Pharmacy Sales ( INV No : ".$invoice->invno.")(Customer : ".(optional($customer)->FullName ?? 'Cash').")";
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
                $tblchq->Description = "Pharmacy Sales ( INV No : ".$invoice->invno.")(Customer : ".(optional($customer)->FullName ?? 'Cash').")";
                $tblchq->ChqNo = $cheque_number;
                $tblchq->PayBy = optional($customer)->FullName ?? 'Cash';
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
                $tbl_gl->Description = "Pharmacy Sales ( INV No : ".$invoice->invno.")(Customer : ".(optional($customer)->FullName ?? 'Cash').")";
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
                    $tbl_gl->Description = "Pharmacy Sales ( INV No : ".$invoice->invno.")(Customer : ".(optional($customer)->FullName ?? 'Cash').")";
                    $tbl_gl->Reference = $invoice->invno;
                    $tbl_gl->ReferenceType = "Invoice";
                    $tbl_gl->Dr = $credit_amount;
                    $tbl_gl->Cr = 0;
                    $tbl_gl->save();

                }else{
                    throw new \Exception("Tansfer account is invalid");
                }
            }

            DB::commit();
            return response()->json(['success'=>true, "Invoice_no"=>$invoice->invno]);

        } catch (\Exception $e) {
            //transaction rollbabk
            DB::rollBack();
            return $e;
        }
    }

    public function load_sales_invoice(Request $request)
    {
        if ($request->ajax()) {

            $invoice=TblInvoice::orderBy('ID', 'DESC')->with('customer')->limit(100)->get();

            return datatables()->of($invoice)
                ->addColumn('action', function ($row) {
                    $html = '<button class="btn btn-success btn-sm waves-effect waves-light btn-print">Print</button> ';
                    
                    return $html;
            })->toJson();
        }
    }

    public function invoice($print_size, $invoice_number)
    {
        $company = TblSahanyaCompany::first();
        $invoice = TblInvoice::where('invno', $invoice_number)->with('customer')->first();
        // dd($invoice->invno);

        $invoice_body = TblInvoiceBody::where('invno', $invoice->invno)->get();

        $data = [
            "company" => $company,
            'invoice' => $invoice,
            "invoice_body"=>$invoice_body,
        ];

        if ($print_size == "Epson") {
            $Epson_size = array(0,0,223.937,500);
            $print_size = $Epson_size;
        }

        $pdf = Pdf::loadView('pdf.invoice', $data);
        $pdf->setPaper($print_size);
        return $pdf->stream('invoice_' . $invoice_number . '.pdf');
    }
}
