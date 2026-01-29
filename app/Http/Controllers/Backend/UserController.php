<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User; // Assuming you have a User model for user management

class UserController extends Controller
{

    public function UserView()
    {
        // Fetch users from the database
        $users = User::all(); // Adjust this as needed for your application
        return view('backend.user.view_user', compact('users'));
        // return view('admin.user.view_user');

    }
    public function UserCreate()
    {
        return view('backend.user.create_user');
    }
    public function UserStore(Request $request)
    {

        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'usertype' => 'nullable|string|max:50',
            'mobile' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:255',


             // Adjust validation as needed
        ]);

        // Create a new user
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        $user->address = $request->address;
        $user->gender = $request->gender;
        // Upload and update image if provided

        if ($request->hasFile('image')) {
            $file = $request->file('image');
             // Delete old image if exists
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/user_image'), $filename);
            $user->image = $filename;
        }

        $user->password = bcrypt($request->password); // Hash the password
        $user->usertype = $request->usertype; // Set user type if applicable
        $user->save();
        $notification = array(
            'message' => 'User Created Successfully',
            'alert-type' => 'success'
        );


        return redirect()->route('user.view')->with($notification);
    }
    public function UserEdit($id)
    {

        $editData = User::find($id);
        return view('backend.user.edit_user', compact('editData'));

    }
    public function UserUpdate(Request $request, $id)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'mobile' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:255',
            'gender' => 'nullable|string|max:10',
            'password' => 'nullable|string|min:8|confirmed',
            'usertype' => 'nullable|string|max:50', // Adjust validation as needed
        ]);

        // Find the user by ID and update their information
        $user = User::find($id);
        if (!$user) {
            return redirect()->route('user.view')->with('error', 'User not found.');
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        $user->address = $request->address;
        $user->gender = $request->gender;
        // Upload and update image if provided
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            @unlink(public_path('upload/user_image/' .$user->image)); // Delete old image if exists
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/user_image'), $filename);
            $user->image = $filename;
        }



        if ($request->filled('password')) {
            $user->password = bcrypt($request->password); // Hash the password if it's being updated
        }
        $user->usertype = $request->usertype; // Update user type if applicable
        $user->save();
        $notification = array(
            'message' => 'User Updated Successfully',
            'alert-type' => 'info'
        );

        return redirect()->route('user.view')->with($notification);
    }
    public function UserDelete($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            $notification = array(
                'message' => 'User '. $user->name .' Deleted  Successfully',
                'alert-type' => 'error'
            );
            return redirect()->route('user.view')->with($notification);
        } else {
            return redirect()->route('user.view')->with('error', 'User not found.');
        }
    }
}
