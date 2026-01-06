<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\TblFrequency;

class FrequencyController extends Controller
{
    public function load_frequency_page()
    {
        return view('appointment.settings.frequency');
    }

    public function load_frequency_list(Request $request)
    {
        if ($request->ajax()) {

            $supplier=TblFrequency::orderBy('Id', 'ASC')->get();

            return datatables()->of($supplier)
                ->addColumn('action', function ($row) {
                    $html = '<button class="btn btn-info btn-sm waves-effect waves-light btn-edit">Edit</button> ';
                    if ($row->Isdelete == 0) {
                        $html .= ' <button class="btn btn-danger btn-sm waves-effect waves-light btn-active">Inactive</button>';
                    } else if($row->Isdelete == 1) {
                        $html .= ' <button class="btn btn-warning btn-sm waves-effect waves-light btn-active">Active</button>';
                    }
                    
                    return $html;
            })->toJson();
        }
    }

    public function active_frequency(Request $request)
    {
        $frequency_id = $request->input('frequency_id');
        $frequency = TblFrequency::where('Id', $frequency_id)->first();
        $frequency->Isdelete = 0;
        $frequency->save();

        if($frequency->save()){
            return response()->json(["success"=>true, "message"=>"Frequency Activated Successfully."]);
        }else{
            return response()->json(["success"=>false, "message"=>"Selected Frequency is Missing or Invalid"]);
        }
    }

    public function inactive_frequency(Request $request)
    {
        $frequency_id = $request->input('frequency_id');
        $frequency = TblFrequency::where('Id', $frequency_id)->first();
        $frequency->Isdelete = 1;
        $frequency->save();

        if($frequency->save()){
            return response()->json(["success"=>true, "message"=>"Frequency Inactivated Successfully."]);
        }else{
            return response()->json(["success"=>false, "message"=>"Selected Frequency is Missing or Invalid"]);
        }
    }

    public function save_new_frequency(Request $request)
    {
        $frequency_name = $request->input('frequency_name');
        $frequency_number = $request->input('frequency_number');

        $freq = new TblFrequency();
        $freq->Freq_Name = $frequency_name;
        $freq->Freq_No = $frequency_number;
        $freq->save();

        if($freq->save()){
            return response()->json(["success"=>true, "message"=>"Frequency Added Successfully"]);
        }else{
            return response()->json(["success"=>false, "message"=>"Frequency Added Failed."]);
        }
    }

    public function update_frequency(Request $request)
    {
        $frequency_id = $request->input('frequency_id');
        $frequency_name = $request->input('frequency_name');
        $frequency_no = $request->input('frequency_no');

        $frequency = TblFrequency::where('Id', $frequency_id)->first();
        $frequency->Freq_Name = $frequency_name;
        $frequency->Freq_No = $frequency_no;
        $frequency->save();

        if($frequency->save()){
            return response()->json(["success"=>true, "message"=>"Frequency Updated Successfully."]);
        }else{
            return response()->json(["success"=>false, "message"=>"Selected Frequency is Missing or Invalid"]);
        }
    }
}
