<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\IjinController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\PresensiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::post('/login', [AuthController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('save-presensi', [PresensiController::class, 'savePresensi']);
    Route::get('/get-presensi', [PresensiController::class, 'getPresensi']);
    
    Route::get('/get-pengumuman', [PengumumanController::class, 'getPengumuman']);

    Route::post('/ijin-store', [IjinController::class, 'create']);
});