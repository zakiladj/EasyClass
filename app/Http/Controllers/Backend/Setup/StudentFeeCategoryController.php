<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentFee;

class StudentFeeCategoryController extends Controller
{
    //
    public function FeeCategoryView(){
        $data['allData'] = StudentFee::all();
        return view('backend.setup.student_fee_categories.view_fee_category',$data);

    }
    public function FeeCategoryAdd(){
        return view('backend.setup.student_fee_categories.add_fee_category');
    }
    public function FeeCategoryStore(Request $request){
        $validatedData = $request->validate([
            'name' => 'required|unique:student_fees,name',
            'description' => 'nullable|string',
        ]);
        $data = new StudentFee();
        $data->name = $request->name;
        $data->description = $request->description;
        $data->status = 'active';
        $data->save();
        $notification = array(
            'message' => 'Student Fee Category Inserted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('student.fee.category.view')->with($notification);
    }
    public function FeeCategoryEdit($id){
        $editData = StudentFee::find($id);
        return view('backend.setup.student_fee_categories.edit_fee_category',compact('editData'));
    }
    public function FeeCategoryUpdate(Request $request,$id){
        $data = StudentFee::find($id);
        $validatedData = $request->validate([
            'name' => 'required|unique:student_fees,name,'.$data->id,
            'description' => 'nullable|string',
        ]);
        $data->name = $request->name;
        $data->description = $request->description;
        $data->status = $request->status;
        $data->save();
        $notification = array(
            'message' => 'Student Fee Category Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('student.fee.category.view')->with($notification);
    }
    public function FeeCategoryDelete($id){
        $data = StudentFee::find($id);
        $data->delete();
        $notification = array(
            'message' => 'Student Fee Category Deleted Successfully',
            'alert-type' => 'warning'
        );
        return redirect()->route('student.fee.category.view')->with($notification);
    }
    public function FeeCategoryDetails($id){
        $data['detail'] = StudentFee::find($id);
        return view('backend.setup.student_fee_categories.fee_category_details',$data);
    }



}
