<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::apiResource('todos', TodoController::class)->middleware("auth:sanctum");
Route::apiResource('users', UserController::class)->middleware("auth:sanctum");

Route::post('login', [LoginController::class, 'index']);
Route::post('register', [RegisterController::class, 'index']);
