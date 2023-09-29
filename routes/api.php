<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/register', [App\Http\Controllers\API\AuthController::class, 'register']);
//API route untuk user
Route::post('/login', [App\Http\Controllers\API\AuthController::class, 'login']);

//Melindungi Rute
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/profile', function(Request $request) {
        return auth()->user();
    });

    // Rute API untuk pengguna logout
    Route::post('/logout', [App\Http\Controllers\API\AuthController::class, 'logout']);
    Route::get('/get-presensi',  [App\Http\Controllers\API\PresensiController::class, 'getPresensis']);

    Route::post('save-presensi', [App\Http\Controllers\API\PresensiController::class, 'savePresensi']);
});