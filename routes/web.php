<?php

use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/user', [App\Http\Controllers\UserController::class, 'index'])->name('user');
Route::get('/create-user', [App\Http\Controllers\UserController::class, 'create'])->name('user');
Route::post('/store-user', [App\Http\Controllers\UserController::class, 'store'])->name('user-store');
