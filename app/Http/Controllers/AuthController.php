<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Auth\User as AuthUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //
    public function showRegister(){
            return view('register');    
        }

    public function register(Request $request){

        $request->validate([
        'name'            => 'required',
        'email'           => 'required|email|unique:users',
        'password'        => 'required|min:8',
        'confirmpassword' => 'required|same:password',
    ]);

       if(User::where('email', $request->email)->exists()){
            return back()->with('error', 'Email Already Exist');
        }

        if($request->password !== $request->confirmpassword){
            return back()->with('error', 'Password do not match');
        }
            
             User::create([
             'name' => $request->name,
             'email' => $request->email,
             'password' => Hash::make($request->password)
           ]);

            return back()->with('success', 'Email Successfully Register');
    }   

    public function showLogin(){
        return view('login');
    }

    public function login(Request $request){
        $user = User::where('email', $request->email)->first();

         if(!$user || !Hash::check($request->password, $user->password)){
            return back()->with('error', 'Invalid Credentials');
        }

        session(['user' => $user]);

        return redirect('/dashboard')->with('success', 'Login Successful');
    }

    public function logout(){
        session()->forget('user');
        return redirect('/login')->with('success', 'Logged-out Successfully');
    }

}