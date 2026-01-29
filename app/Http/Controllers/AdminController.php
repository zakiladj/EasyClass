<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function logout(Request $request)
    {
        // Perform logout logic here, such as invalidating the session
        Auth::logout();

        // Redirect to the login page or home page after logout
        return redirect('/login')->with('message', 'You have been logged out successfully.');
    }
}
