<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //

    public function showUser(){
        $user = User::all();     
        return view('user', compact('user')); 
    }

    public function addUser(Request $request){
        $request->validate([
            'name'                  => 'required|string|max:255',
            'email'                 => 'required|email|unique:users',
            'password'              => 'required|min:8|confirmed',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => \Illuminate\Support\Facades\Hash::make($request->password),
        ]);

        return redirect('/user')->with('success', 'User added successfully.');
    }

    public function updateUser(Request $request, $id){
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
        ]);

        $user = User::findOrFail($id);
        $user->name  = $request->name;
        $user->email = $request->email;
        $user->save();

        return redirect('/user')->with('success', 'User updated successfully.');
    }

    public function deleteUser($id){
        $user = User::findOrFail($id);
        $user->delete();

        return redirect('/user')->with('success', 'User deleted successfully.');
    }
}