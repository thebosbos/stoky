<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/a', function () {
    return view('register');
});
Route::get('/login', function () {return view('login');})->name('login');;


Route::post("/register",[AuthController::class, "register"]);
Route::post("/logina",[AuthController::class, "login"]);
Route::post("/logout",[AuthController::class, "logout"]);


Route::middleware(['auth'])->get('/posts', [PostController::class, 'store']); 