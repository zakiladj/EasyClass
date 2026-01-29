<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentYear;


class StudentYearController extends Controller
{
    //
    public function YearView(){
        $data['allData'] = StudentYear::all();
        return view('backend.setup.student_years.view_year',$data);
    }
    public function YearAdd(){
        return view('backend.setup.student_years.add_year');
    }
    public function YearStore(Request $request){
        $validatedData = $request->validate([
            'name' => 'required|unique:student_years,name',
            'level_order' => 'nullable|integer|min:1',
            'description' => 'nullable|string',
        ]);
        $data = new StudentYear();
        $data->name = $request->name;
        $data->level_order = $request->level_order;
        $data->description = $request->description;
        $data->status = 'active';
        $data->save();
        $notification = array(
            'message' => 'Student Year Inserted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('student.year.view')->with($notification);
    }
    public function YearEdit($id){
        $editData = StudentYear::find($id);
        return view('backend.setup.student_years.edit_year',compact('editData'));
    }
    public function YearUpdate(Request $request,$id){
        $data = StudentYear::find($id);
        $validatedData = $request->validate([
            'name' => 'required|unique:student_years,name,'.$data->id,
            'level_order' => 'nullable|integer|min:1',
            'description' => 'nullable|string',
        ]);
        $data->name = $request->name;
        $data->level_order = $request->level_order;
        $data->description = $request->description;
        $data->status = 'active';
        $data->save();
        $notification = array(
            'message' => 'Student Year Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('student.year.view')->with($notification);
    }
    public function YearDelete($id){
        $year = StudentYear::find($id);
        $year->delete();
        $notification = array(
            'message' => 'Student Year Deleted Successfully',
            'alert-type' => 'danger'
        );
        return redirect()->route('student.year.view')->with($notification);
    }
    public function YearDetails($id){
        $detail = StudentYear::find($id);
        return view('backend.setup.student_years.year_details',compact('detail'));
    }
}
