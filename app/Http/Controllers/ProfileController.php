<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    //
    public function showProfile(){
        return view('profile_pic');
    }

    public function profile(Request $request){
        $user = User::find(session('user')->id);
    
      if($request->hasFile('profile_pic')){
        $file = $request->file('profile_pic');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads'), $filename);
        $user->profile_pic = $filename;
      }

      
        $user->address  = $request->address;
        $user->birthday = $request->birthday;
        $user->gender = $request->gender;
        $user->bio = $request->bio;
        $user->name = $request->name;
        $user->email = $request->email;

      $user->save();

      session(['user' => $user ]);

      return back()->with('success', 'Profile Updated Successfully');
    }

    public function changePassword(Request $request){
        $request->validate([
            'current_password' => 'required',
            'new_password'     => 'required|min:8|confirmed',
        ]);

        $user = User::find(session('user')->id);

        if (!\Illuminate\Support\Facades\Hash::check($request->current_password, $user->password)) {
            return back()->with('pw_error', 'Current password is incorrect.');
        }

        $user->password = \Illuminate\Support\Facades\Hash::make($request->new_password);
        $user->save();
        session(['user' => $user]);

        return back()->with('pw_success', 'Password updated successfully.');
    }
}
