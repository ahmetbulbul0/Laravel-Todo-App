<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {return view('app');})->name("Welcome");
Route::get('/register', function () {return view('app');})->name("Register");
Route::get('/login', function () {return view('app');})->name("login");
Route::get('/my-todos/{page?}', function () {return view('app');})->name("MyTodos");
Route::get('/new-todo', function () {return view('app');})->name("NewTodo");
Route::get('/todo-detail/{todoId}', function () {return view('app');})->name("TodoDetail");
Route::get('/is-complete/{todoId}', function () {return view('app');})->name("IsComplete");
Route::get('/todo-edit/{todoId}', function () {return view('app');})->name("TodoEdit");
Route::get('/todo-delete/{todoId}', function () {return view('app');})->name("TodoDelete");
Route::get('/log-out', function () {return view('app');})->name("LogOut");
