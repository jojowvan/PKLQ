<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Hash;
use Auth;
use Alert;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function gantiPassword(Request $request)
    {
        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
          // The passwords matches
          session()->flash('invalidPassword', 'Your current password does not matches with the password you provided. Please try again.');
          return redirect()->back();

        }

        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
          //Current password and new password are same
          session()->flash('invalidPassword', 'New Password cannot be same as your current password. Please choose a different password.');
          return redirect()->back();
        }

        $validatedData = $request->validate([
          'current-password' => 'required',
          'new-password' => 'required|string|min:6|confirmed',
        ]);

        //Change Password
        $user = Auth::user();
        $user->name = $request->name;
        $user->password = bcrypt($request->get('new-password'));
        $user->save();

        return redirect()->back()->with("success","Password changed successfully !");
        session()->flash('passwordChanged', 'Your Password Has Been Changed.');
        // return redirect()->back();
    }
}
