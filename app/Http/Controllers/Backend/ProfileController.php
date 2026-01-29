<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{

    public function ProfileView()
    {
        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('backend.profile.view_profile2', compact('profileData'));
        // return view('backend.profile.view_profile', compact('profileData'));

    }
     public function ProfileIdView($id)
    {

        $profileData = User::find($id);
        return view('backend.profile.view_profile_id', compact('profileData'));
        // return view('backend.profile.view_profile', compact('profileData'));

    }
    public function PasswordView()
    {
        $id = Auth::user()->id;
        $editData = User::find($id);
        return view('backend.profile.password_view', compact('editData'));
    }

    public function PasswordUpdate(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'oldpassword' => 'required',
            'password' => 'required|string|min:8|confirmed',
             // Adjust validation as needed


        ]);

        $hashedPassword = Auth::user()->password;



        if (Hash::check($request->oldpassword, $hashedPassword)) {

            $user = User::find(Auth::id());
            $user->password = bcrypt($request->password);
            $user->save();
            Auth::logout();
            return redirect()->route('login');
        } else {

            return redirect()->back();
        }
    }
}
