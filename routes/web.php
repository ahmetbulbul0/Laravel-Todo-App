<?php

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

// Route::get('/', function () {return view('pages.home');})->name("home");
// Route::get('/register', function () {return view('pages.register');})->name("register");
// Route::get('/login', function () {return view('pages.login');})->name("login");
// Route::get('/todo-list', function () {return view('pages.todo-list');})->name("todo-list");
// Route::get('/todo-add', function () {return view('pages.todo-add');})->name("todo-add");
// Route::get('/todo-detail', function () {return view('pages.todo-detail');})->name("todo-detail");
// Route::get('/todo-edit', function () {return view('pages.todo-edit');})->name("todo-edit");
// Route::get('/log-out', function () {return "log out";})->name("log-out");

Route::get('/{route?}', function () {
    return view('app');
});
Route::get('/{route}/{route1?}', function () {
    return view('app');
});
