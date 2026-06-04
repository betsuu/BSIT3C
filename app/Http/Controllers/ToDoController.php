<?php

namespace App\Http\Controllers;

use App\Models\ToDo;
use Illuminate\Http\Request;

class ToDoController extends Controller
{
    public function showToDo(){
        if(!session('user')){
            return redirect('/login');
        } 

        $todos = ToDo::where('user_id', session('user')->id)->get();
        return view('todo', compact('todos'));
    }

    public function addToDo(Request $request){
        if(!session('user')){
            return redirect('/login');
        }

        ToDo::create([
            'task'     => $request->task,
            'location' => $request->location,
            'time'     => $request->time,
            'user_id'  => session('user')->id,
        ]);

        return back()->with('success', 'Task Added Successfully');
    }

    public function deleteToDo($id){
        if(!session('user')){
            return redirect('/login');
        }

        $todo = ToDo::where('id', $id)
                    ->where('user_id', session('user')->id)
                    ->first();

        if(!$todo){
            return back()->with('error', 'Unable to delete record');
        }

        $todo->delete();
        return back()->with('success', 'Task deleted Successfully');
    }

    public function updateToDo(Request $request, $id){
        if(!session('user')){
            return redirect('/login');
        }
         
        $todo = ToDo::where('id', $id)
                    ->where('user_id', session('user')->id)
                    ->first();

        if(!$todo){
            return back()->with('error', 'Unable to update task');
        }

        $todo->update([
            'task'     => $request->task,
            'location' => $request->location,
            'time'     => $request->time,
        ]);

        return back()->with('success', 'Task updated Successfully');
    }

    public function markDone(Request $request, $id){
        if(!session('user')){
            return redirect('/login');
        }

        $todo = ToDo::where('id', $id)
                    ->where('user_id', session('user')->id)
                    ->first();

        if(!$todo){
            return response()->json(['error' => 'Not found'], 404);
        }

       $todo->update(['is_done' => $request->is_done ? 1 : 0]);

        return response()->json(['success' => true]);
    }
}