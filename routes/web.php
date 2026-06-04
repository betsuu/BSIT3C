<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ToDoController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => redirect('/login'));

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');

Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');

Route::post('/login', [AuthController::class, 'login']);

Route::get('/dashboard', [DashboardController::class, 'showDashboard'])->name('dashboard');

Route::get('/dashboard/stats', [DashboardController::class, 'getStats']);

Route::get('/user', [UserController::class, 'showUser'])->name('user');

Route::post('/addUser', [UserController::class, 'addUser']);

Route::post('/updateUser/{id}', [UserController::class, 'updateUser']);

Route::post('/deleteUser/{id}', [UserController::class, 'deleteUser']);

Route::get('/logout', [AuthController::class, 'logout']);

Route::get('/todo', [ToDoController::class, 'showToDo'])->name('todo');

Route::post('/todo', [ToDoController::class, 'addToDo']);

Route::get('/deleteToDo/{id}', [ToDoController::class, 'deleteToDo']);

Route::post('/updateToDo/{id}', [ToDoController::class, 'updateToDo']);

Route::get('/profile', [ProfileController::class, 'showProfile'])->name('profile');

Route::post('/updateProfile', [ProfileController::class, 'profile']);

Route::post('/changePassword', [ProfileController::class, 'changePassword']);

Route::post('/todo/{id}/done', [ToDoController::class, 'markDone']);

Route::post('/todo/{id}', [ToDoController::class, 'something']);