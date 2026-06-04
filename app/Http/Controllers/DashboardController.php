<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ToDo;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function showDashboard()
    {
        $userId        = session('user')->id;

        $usercount     = User::count();
        $todocount     = ToDo::where('user_id', $userId)->count();
        $donecount     = ToDo::where('user_id', $userId)->where('is_done', 1)->count();
        $pendingcount  = ToDo::where('user_id', $userId)->where('is_done', 0)->count();

        $recentTodos   = ToDo::with('user')->where('user_id', $userId)->latest()->take(5)->get();
        $recentUsers   = User::latest()->take(5)->get();

        $completionRate = $todocount > 0
            ? round(($donecount / $todocount) * 100)
            : 0;

        return view('dashboard', compact(
            'usercount',
            'todocount',
            'donecount',
            'pendingcount',
            'recentTodos',
            'recentUsers',
            'completionRate'
        ));
    }

    public function getStats()
    {
        $userId         = session('user')->id;
        $usercount      = User::count();
        $todocount      = ToDo::where('user_id', $userId)->count();
        $donecount      = ToDo::where('user_id', $userId)->where('is_done', 1)->count();
        $pendingcount   = ToDo::where('user_id', $userId)->where('is_done', 0)->count();
        $completionRate = $todocount > 0 ? round(($donecount / $todocount) * 100) : 0;

        return response()->json([
            'usercount'      => $usercount,
            'todocount'      => $todocount,
            'donecount'      => $donecount,
            'pendingcount'   => $pendingcount,
            'completionRate' => $completionRate,
        ]);
    }
}