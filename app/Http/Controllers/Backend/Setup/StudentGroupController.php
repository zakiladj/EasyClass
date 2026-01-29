<?php

namespace App\Http\Controllers\Backend\setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentGroup;

class StudentGroupController extends Controller
{
    //
    public function GroupView(){
        $data['allData'] = StudentGroup::all();
        return view('backend.setup.student_groups.view_group',$data);

    }
    public function GroupAdd(){
        return view('backend.setup.student_groups.add_group');
    }
    public function GroupStore(Request $request){
        $validatedData = $request->validate([
            'name' => 'required|unique:student_groups,name',
            'description' => 'nullable|string',
        ]);
        $data = new StudentGroup();
        $data->name = $request->name;
        $data->description = $request->description;
        $data->status = 'active';
        $data->save();
        $notification = array(
            'message' => 'Student Group Inserted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('student.group.view')->with($notification);
    }
    public function GroupEdit($id){
        $editData = StudentGroup::find($id);
        return view('backend.setup.student_groups.edit_group',compact('editData'));
    }
    public function GroupUpdate(Request $request,$id){
        $data = StudentGroup::find($id);
        $validatedData = $request->validate([
            'name' => 'required|unique:student_groups,name,'.$data->id,
            'description' => 'nullable|string',
        ]);
        $data->name = $request->name;
        $data->description = $request->description;
        $data->status = $request->status;
        $data->save();
        $notification = array(
            'message' => 'Student Group Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('student.group.view')->with($notification);
    }
    public function GroupDelete($id){
        $data = StudentGroup::find($id);
        $data->delete();
        $notification = array(
            'message' => 'Student Group Deleted Successfully',
            'alert-type' => 'error'
        );
        return redirect()->route('student.group.view')->with($notification);
    }
    public function GroupDetails($id){
        $detail = StudentGroup::find($id);
        return view('backend.setup.student_groups.group_details',compact('detail'));
    }
}
