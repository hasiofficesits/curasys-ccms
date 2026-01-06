<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\TblStockPharmaCategory;

class StockCategoryController extends Controller
{
    public function load_category_page()
    {
        return view('Stock.settings.stock_category');
    }

    public function load_stock_category_grid(Request $request)
    {
        if ($request->ajax()) {

            $supplier=TblStockPharmaCategory::orderBy('ID', 'ASC')->get();

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

    public function save_new_category(Request $request)
    {
        $category = $request->input('category');
        $code = $request->input('code');

        $exist_code = TblStockPharmaCategory::where('Code', $code)->first();

        if ($exist_code) {
            return response()->json(["success"=>false, "message"=>"Category Code Already Exist!"]);
        } else {
            $new_cat = new TblStockPharmaCategory();
            $new_cat->CategoryName = $category;
            $new_cat->Code = $code;
            $new_cat->IsDelete = 0;
            $new_cat->save();

            if($new_cat->save()){
                return response()->json(["success"=>true, "message"=>"Category Added Successfully"]);
            }else{
                return response()->json(["success"=>false, "message"=>"Category Added Failed."]);
            }
        }
    }

    public function update_stock_category(Request $request)
    {
        $edit_cat_id = $request->input('edit_cat_id');
        $edit_code = $request->input('edit_code');
        $edit_category = $request->input('edit_category');

        $exist_code = TblStockPharmaCategory::where('Code', $edit_code)->first();

        if ($exist_code) {
            return response()->json(["success"=>false, "message"=>"Item Code Already Exist!"]);
        } else {
            $item = TblStockPharmaCategory::where('ID', $edit_cat_id)->first();
            $item->CategoryName = $edit_category;
            $item->Code = $edit_code;
            $item->save();

            if($item->save()){
                return response()->json(["success"=>true, "message"=>"Category Updated Successfully"]);
            }else{
                return response()->json(["success"=>false, "message"=>"Category Updated Failed."]);
            }
        }
    }

    public function active_category_from_id(Request $request)
    {
        $category_id = $request->input('category_id');
        $category = TblStockPharmaCategory::where('ID', $category_id)->first();
        $category->IsDelete = 0;
        $category->save();

        if($category->save()){
            return response()->json(["success"=>true, "message"=>"Category Activated Successfully."]);
        }else{
            return response()->json(["success"=>false, "message"=>"Selected Category is Missing or Invalid"]);
        }
    }

    public function inactive_category_from_id(Request $request)
    {
        $category_id = $request->input('category_id');
        $category = TblStockPharmaCategory::where('ID', $category_id)->first();
        $category->IsDelete = 1;
        $category->save();

        if($category->save()){
            return response()->json(["success"=>true, "message"=>"Category Inactivated Successfully."]);
        }else{
            return response()->json(["success"=>false, "message"=>"Selected Category is Missing or Invalid"]);
        }
    }
}
