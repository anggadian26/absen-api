<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IjinController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\PresensiController;
use App\Http\Controllers\SakitController;
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

Route::get('/pengumuman', [PengumumanController::class, 'index'])->name('pengumuman');
Route::get('/add-pengumuman', [PengumumanController::class, 'add_view'])->name('add.pengumuman');
Route::get('/delete_pengumuman/{id}', [PengumumanController::class, 'delete_pengumuman'])->name('delete.pengumuman');
Route::post('/add-pengumuman-aksi', [PengumumanController::class, 'add_data'])->name('add_pengumuman');

Route::get('/data-ijin', [IjinController::class, 'index'])->name('ijin');

Route::get('/data-sakit', [SakitController::class, 'index'])->name('sakit');

Route::get('/data-presensi', [PresensiController::class, 'index'])->name('presensi');
