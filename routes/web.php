<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [Controller::class, 'loginShow'])->name('login');
Route::post('/login-action', [Controller::class, 'loginAction'])->name('login-action');

Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

Route::get('/data-pegawai', [UserController::class, 'index'])->name('data.pegawai');
Route::get('/delete-user/{id}', [UserController::class, 'delete_data'] )->name('delete.user');
Route::get('/tambah-pegawai', [UserController::class, 'add_view'])->name('view.add');
Route::post('/add-pegawai', [UserController::class, 'add_action'])->name('add.action');
