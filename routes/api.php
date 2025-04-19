<?php

use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\OtpController;
use App\Http\Controllers\Api\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', [LoginController::class, 'login']);
Route::post('/lupa-password', [LoginController::class, 'lupaPass']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user/{id}', [ProfileController::class, 'getUser']);
    Route::get('/logout', [LoginController::class, 'logout']);
});
Route::middleware('auth:anggota')->put('/profile/update', [ProfileController::class, 'update']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
