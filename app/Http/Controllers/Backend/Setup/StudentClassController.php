<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentClass;

class StudentClassController extends Controller
{

    public function StudentView()
    {
        $data['allData'] = StudentClass::all();


        return view('backend.setup.student_class.view_class', $data);
    }
    public function ClassAdd()
    {
        return view('backend.setup.student_class.add_class');
    }
    public function ClassStore(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:student_classes,name',
            'grade_level' => 'nullable|string|max:50',
            'section' => 'nullable|string|max:50',
            'nombre' => 'nullable|integer|min:0',
        ]);

        $data = new StudentClass();
        $data->name = $request->name;
        $data->grade_level = $request->grade_level;
        $data->section = $request->section;
        $data->nombre = $request->nombre;

        $data->status = 1;
        $data->save();

        $notification = array(
            'message' => 'Student Class Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('student.class.view')->with($notification);
    }
    public function ClassEdit($id)
    {
        $editData = StudentClass::find($id);
        return view('backend.setup.student_class.edit_class', compact('editData'));
    }
    public function ClassUpdate(Request $request, $id)
    {
        $data = StudentClass::find($id);
        $validatedData = $request->validate([
            'name' => 'required|unique:student_classes,name,' . $data->id,
            'grade_level' => 'nullable|string|max:50',
            'section' => 'nullable|string|max:50',
            'nombre' => 'nullable|integer|min:0',
        ]);
        $data->name = $request->name;
        $data->grade_level = $request->grade_level;
        $data->section = $request->section;
        $data->nombre = $request->nombre;
        $data->status = 1;
        $data->save();
        $notification = array(
            'message' => 'Student Class Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('student.class.view')->with($notification);

    }
    public function ClassDelete($id)
    {
        $class = StudentClass::find($id);
        $class->delete();
        $notification = array(
            'message' => 'Student Class Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('student.class.view')->with($notification);
    }
    public function ClassDetails($id)
    {
        $detail = StudentClass::find($id);
        return view('backend.setup.student_class.class_detail', compact('detail'));
    }

}
