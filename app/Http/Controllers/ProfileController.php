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
}
