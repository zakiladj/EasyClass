<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentShift;

class StudentShiftController extends Controller
{
    //

    public function ShiftView(){
        $data = StudentShift::all();
        return view('backend.setup.student_shifts.view_shift',compact('data'));
    }
    public function ShiftAdd(){
        return view('backend.setup.student_shifts.add_shift');
    }
    public function ShiftStore(Request $request){
        $validatedData = $request->validate([
            'name' => 'required|unique:student_shifts,name',
            'start_time' => 'nullable|date_format:H:i',
            'end_time' => 'nullable|date_format:H:i|after:start_time',
            'description' => 'nullable|string',
        ]);
        $data = new StudentShift();
        $data->name = $request->name;
        $data->start_time = $request->start_time;
        $data->end_time = $request->end_time;
        $data->description = $request->description;
        $data->status = 'active';
        $data->save();
        $notification = array(
            'message' => 'Student Shift Inserted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('student.shift.view')->with($notification);
    }
    public function ShiftEdit($id){
        $editData = StudentShift::find($id);
        return view('backend.setup.student_shifts.edit_shift',compact('editData'));
    }
    public function ShiftUpdate(Request $request,$id){
        $data = StudentShift::find($id);
        $validatedData = $request->validate([
            'name' => 'required|unique:student_shifts,name,'.$data->id,
            'start_time' => 'nullable|date_format:H:i',
            'end_time' => 'nullable|date_format:H:i|after:start_time',
            'description' => 'nullable|string',
        ]);
        $data->name = $request->name;
        $data->start_time = $request->start_time;
        $data->end_time = $request->end_time;
        $data->description = $request->description;
        $data->status = $request->status;
        $data->save();
        $notification = array(
            'message' => 'Student Shift Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('student.shift.view')->with($notification);
    }
    public function ShiftDelete($id){
        $data = StudentShift::find($id);
        $data->delete();
        $notification = array(
            'message' => 'Student Shift Deleted Successfully',
            'alert-type' => 'error'
        );
        return redirect()->route('student.shift.view')->with($notification);
    }
    public function ShiftDetails($id){
        $detail = StudentShift::find($id);
        return view('backend.setup.student_shifts.shift_details',compact('detail'));
    }

}
