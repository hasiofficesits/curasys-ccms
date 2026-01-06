<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\TblGrnHead;
use App\Models\TblGrnBody;
use App\Models\TblStockPharma;
use App\Models\TblStockPharmaLot;
use App\Models\TblGL;
use App\Models\TblSupplier;
use App\Models\TblAccountSetting;
use App\Models\TblSahanyaCompany;
use App\Models\TblInvoice;

use DB;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class GrnController extends Controller
{
    public function load_grn_page()
    {
        return view('Stock.GRN.grn');
    }

    public function load_grn_grid(Request $request)
    {
        if ($request->ajax()) {

            $supplier=TblGrnHead::orderBy('Grid', 'DESC')->with('supplier')->get();

            return datatables()->of($supplier)
                ->addColumn('action', function ($row) {
                    $html = '<button class="btn btn-success btn-sm waves-effect waves-light btn-print">Print</button> ';
                    
                    return $html;
            })->toJson();
        }
    }

    public function load_stock_item_grn(Request $request)
    {
        $item = TblStockPharma::get();
        return response()->json(["success"=>true, "data"=>$item]);
    }

    public function load_item_details_to_grid(Request $request)
    {
        $item_id = $request->input('item_id');
        $max_id = TblStockPharmaLot::where('FKStock_ID', $item_id)->where('Isdelete',0)->max('ID');

        $lot = TblStockPharmaLot::where('ID', $max_id)->first();

        return response()->json(["success"=>true, "data"=>$lot]);
    }

    public function save_pharma_grn(Request $request)
    {
        $invo_no = $request->input('invo_no');
        $supplier = $request->input('supplier');
        $grn_date = $request->input('grn_date');
        $po_type = $request->input('po_type');
        $final_gross = $request->input('final_gross');
        $final_total = $request->input('final_total');
        $final_discount = $request->input('final_discount');
        $body_data = $request->input('body_data');

        $exist_invo = TblGrnHead::where('RefInv', $invo_no)->first();
        if ($exist_invo) {
            return response()->json(["success"=>false, "message"=>"Invoice Already Exist!"]);
        } else {

            //SAVE GRN HEAD
            $head = new TblGrnHead();
            $head->Date = $grn_date;
            $head->Time = Carbon::now(new \DateTimeZone('Asia/Colombo'))->format('H:i');
            $head->Pono = null;
            $head->Type = $po_type;
            $head->RefInv = $invo_no;
            $head->Created = "Admin";
            $head->Supplier = $supplier;
            $head->Total = $final_total;
            $head->Discount = $final_discount;
            $head->Gross = $final_gross;
            $head->IsDelete = 0;
            $head->GRNType = "GRN";
            $head->save();

            //SAVE GRN BODY
            $grn_bodies = json_decode($body_data);
            foreach ($grn_bodies as $key => $value) {
                $body = new TblGrnBody();
                $body->Grnno = $head->Grid;
                $body->ItemID = $value->ID;
                $body->Code = $value->Code;
                $body->Qty = $value->Qty;
                $body->UnitCost = $value->Total;
                $body->Cost = $value->UnitCost;
                $body->ExpDate = $value->Exp;
                $body->IsDelete = 0;
                $body->DisCount = $value->Discount;
                $body->FreeQty = $value->Free_Qty;
                $body->Price = $value->Price;
                $body->save();

                //MAKE LOT
                //Exist Lot
                $max_id = TblStockPharmaLot::where('FKStock_ID', $value->ID)->where('Supplier_ID',$supplier)->where('Cost',$value->UnitCost)->where('Price',$value->Price)->where('Exp_date',$value->Exp)->where('Isdelete',0)->max('ID');
                $lot = TblStockPharmaLot::where('ID', $max_id)->first();
                // dd($lot);
                $total_qty = $value->Qty + $value->Free_Qty;
                if($lot) {
                    $new_qty = $lot->QTY + $total_qty;
                    $lot->QTY = $new_qty;
                    $lot->save();
                } else {
                    $new_lot = new TblStockPharmaLot();
                    $new_lot->FKStock_ID = $value->ID;
                    $new_lot->Lot = 1;
                    $new_lot->Cost = $value->UnitCost;
                    $new_lot->Price = $value->Price;
                    $new_lot->DisCount = $value->Discount;
                    $new_lot->Batch = null;
                    $new_lot->Exp_date = $value->Exp;
                    $new_lot->QTY = $total_qty;
                    $new_lot->Supplier_ID = $supplier;
                    $new_lot->Isdelete = 0;
                    $new_lot->save();
                }
            }

            //GL Ledger
            $supplier = TblSupplier::where('ID',$supplier)->first();
            $supplier_name = $supplier->Company;
            $sup_creditor = $supplier->CreditorLedger;

            $stock = TblAccountSetting::where('Name','STOCK')->first();
            $stock_ledger_AccCode = $stock->AccCode;
            $stock_ledger_Acc = $stock->Acc;

            $discount_ledger = TblAccountSetting::where('Name','RECEIVED DISCOUNT')->first();
            $discount_adv_AccCode = $discount_ledger->AccCode;
            $discount_adv_Acc = $discount_ledger->Acc;

            //Credit to GL
            $cr_gl = new TblGL();
            $cr_gl->Date = $grn_date;
            $cr_gl->Acc = $supplier_name.'Creditor Ledger';
            $cr_gl->AccCode = $sup_creditor;
            $cr_gl->Description = 'Transfer to Main Stock('.$invo_no.')';
            $cr_gl->Reference = $invo_no;
            $cr_gl->ReferenceType = 'GRN';
            $cr_gl->Dr = 0;
            $cr_gl->Cr = $final_gross;
            $cr_gl->save();

            //Debit to GL --- STOCK
            $dr_gl = new TblGL();
            $dr_gl->Date = $grn_date;
            $dr_gl->Acc = $stock_ledger_Acc;
            $dr_gl->AccCode = $stock_ledger_AccCode;
            $dr_gl->Description = 'Transfer from '.$supplier_name. '('.$invo_no.')';
            $dr_gl->Reference = $invo_no;
            $dr_gl->ReferenceType = 'GRN';
            $dr_gl->Dr = $final_total;
            $dr_gl->Cr = 0;
            $dr_gl->save();

            if ($final_discount != null) {
                //Debit to GL --- RECIEVED DISCOUNT
                $dis_val = $final_discount*$final_total;
                
                $dr_gl = new TblGL();
                $dr_gl->Date = $grn_date;
                $dr_gl->Acc = $discount_adv_Acc;
                $dr_gl->AccCode = $discount_adv_AccCode;
                $dr_gl->Description = 'Transfer from '.$supplier_name. '('.$invo_no.')';
                $dr_gl->Reference = $invo_no;
                $dr_gl->ReferenceType = 'GRN';
                $dr_gl->Dr = 0;
                $dr_gl->Cr = $dis_val;
                $dr_gl->save();
            }

        }

        return response()->json(["success"=>true]);
    }

    public function grn_invo($print_size, $grn_no) 
    {
        $company = TblSahanyaCompany::first();
        $grn = TblGrnHead::where('Grid', $grn_no)->with('supplier')->first();

        $grn_body = TblGrnBody::where('Grnno', $grn->Grid)->with('item')->get();

        $data = [
            "company" => $company,
            'grn' => $grn,
            "grn_body"=>$grn_body,
        ];

        $pdf = Pdf::loadView('Stock.GRN.grn_pdf', $data);
        $pdf->setPaper($print_size);
        return $pdf->stream('GRN_INV_' . $grn_no . '.pdf');

    }
}
