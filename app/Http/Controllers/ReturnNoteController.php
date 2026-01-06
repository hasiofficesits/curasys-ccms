<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\TblStockPharma;
use App\Models\TblStockPharmaLot;
use App\Models\TblGL;
use App\Models\TblSupplier;
use App\Models\TblAccountSetting;
use App\Models\TblSahanyaCompany;
use App\Models\TblReturnNoteHead;
use App\Models\TblReturnNoteBody;
use App\Models\TblReturnNoteValue;

use DB;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class ReturnNoteController extends Controller
{
    public function load_return_note_page()
    {
        return view('Stock.return_note.return_note');
    }

    public function load_return_note_grid(Request $request)
    {
        if ($request->ajax()) {

            $return_note=TblReturnNoteHead::orderBy('ID', 'ASC')->with('supplier')->get();

            return datatables()->of($return_note)
                ->addColumn('action', function ($row) {
                    $html = '<button class="btn btn-success btn-sm waves-effect waves-light btn-print">Print</button> ';
                    
                    return $html;
            })->toJson();
        }
    }

    public function load_lot_details(Request $request)
    {
        $item_id = $request->input('item_id');
        $lot = TblStockPharmaLot::where('FKStock_ID',$item_id)->where('Isdelete',0)->get();
        return response()->json(["success"=>true, "data"=>$lot]);
    }

    public function load_lot_price(Request $request)
    {
        $lot_id = $request->input('lot_id');
        $lot = TblStockPharmaLot::where('ID', $lot_id)->first();
        return response()->json(["success"=>true, "data"=>$lot]);
    }

    public function load_stock_item_from_supplier(Request $request)
    {
        $supplier_id = $request->input('supplier_id');
        $item = TblStockPharma::where('FKSupplier_ID', $supplier_id)->get();
        return response()->json(["success"=>true, "data"=>$item]);
    }

    public function save_return_note(Request $request)
    {
        $supplier = $request->input('supplier');
        $date = $request->input('date');
        $reason = $request->input('reason');
        $type = $request->input('type');
        $body_data = $request->input('body_data');
        $final_total = $request->input('final_total');

        //SAVE RETURN HEAD
        $head = new TblReturnNoteHead();
        $head->Date = $date;
        $head->FkSupplierID = $supplier;
        $head->Balance = $final_total;
        $head->Type = $type;
        $head->Total = $final_total;
        $head->Reason = $reason;
        $head->ReturnDate = Carbon::now();
        $head->ReturnTime = Carbon::now(new \DateTimeZone('Asia/Colombo'))->format('H:i');
        $head->CreateTo = "Admin";
        $head->IsDelete = 0;
        $head->save();

        //SAVE RETURN BODY
        $return_bodies = json_decode($body_data);

        foreach ($return_bodies as $key => $value) {

            $lot = TblStockPharmaLot::where('ID', $value->LotId)->first();
            $item_id = $lot->FKStock_ID;
            $stock = TblStockPharma::where('ID', $item_id)->first();

            $body = new TblReturnNoteBody();
            $body->FkSRNID = $head->ID;
            $body->ItemID = $value->ID;
            $body->Lotid = $value->LotId;
            $body->Code = $stock->Code;
            $body->Qty = $value->Qty;
            $body->Cost = $value->UnitCost;
            $body->ExpDate = $lot->Exp_date;
            $body->Total = $value->Total;
            $body->save();

            //REDUCE FROM STOCK LOT
            $new_qty = $lot->QTY - $value->Qty;
            $lot->QTY = $new_qty;
            $lot->save();
        }

        //SAVE RETUN NOTE VALUE
        $new_value = new TblReturnNoteValue();
        $new_value->FksupplierID = $supplier;
        $new_value->Date = $date;
        $new_value->Ref_invoice = $head->ID;
        $new_value->Amount = $final_total;
        $new_value->save();

        //GL ENTRY
        $supplier = TblSupplier::where('ID',$supplier)->first();
        $supplier_name = $supplier->Company;
        $sup_creditor = $supplier->CreditorLedger;

        $stock = TblAccountSetting::where('Name','STOCK')->first();
        $stock_ledger_AccCode = $stock->AccCode;
        $stock_ledger_Acc = $stock->Acc;

        //Credit to GL
        $dr_gl = new TblGL();
        $dr_gl->Date = $date;
        $dr_gl->Acc = $stock_ledger_Acc;
        $dr_gl->AccCode = $stock_ledger_AccCode;
        $dr_gl->Description = 'Return to '.$supplier_name. '('.$head->ID.')';
        $dr_gl->Reference = $head->ID;
        $dr_gl->ReferenceType = 'Return Note';
        $dr_gl->Dr = 0;
        $dr_gl->Cr = $final_total;
        $dr_gl->save();

        //Debit to GL
        $cr_gl = new TblGL();
        $cr_gl->Date = $date;
        $cr_gl->Acc = $supplier_name.'Creditor Ledger';
        $cr_gl->AccCode = $sup_creditor;
        $cr_gl->Description = 'Return from Main Stock('.$head->ID.')';
        $cr_gl->Reference = $head->ID;
        $cr_gl->ReferenceType = 'Return Note';
        $cr_gl->Dr = $final_total;
        $cr_gl->Cr = 0;
        $cr_gl->save();

        return response()->json(["success"=>true]);
        
    }

    public function return_note_invo($print_size, $return_note_id) 
    {
        $company = TblSahanyaCompany::first();
        $return = TblReturnNoteHead::where('ID', $return_note_id)->with('supplier')->first();

        $return_body = TblReturnNoteBody::where('FkSRNID', $return->ID)->with('item')->get();

        $data = [
            "company" => $company,
            'return' => $return,
            "return_body"=>$return_body,
        ];

        $pdf = Pdf::loadView('Stock.return_note.return_note_pdf', $data);
        $pdf->setPaper($print_size);
        return $pdf->stream('Return_Note_INV_' . $return_note_id . '.pdf');

    }
}
