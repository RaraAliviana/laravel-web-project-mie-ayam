<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MenuController as ApiMenuController;
use App\Http\Controllers\Api\PemesananController as ApiPemesananController;
use App\Http\Controllers\Api\AuthController as ApiAuthController;

// Route untuk mendapatkan informasi user yang terautentikasi
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::middleware('auth:sanctum')->group(function () {
    // Menggunakan apiResource untuk resource menu dan pemesanan
    Route::apiResource('/menu', ApiMenuController::class);
    Route::apiResource('/pemesanan', ApiPemesananController::class);
    Route::get('menu/{id}', [ApiMenuController::class, 'show']);
});

Route::post('login', [ApiAuthController::class, 'login']);
