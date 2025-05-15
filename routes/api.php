<?php

use App\Http\Controllers\Api\ArtikelController;
use App\Http\Controllers\Api\KategoriController;
use App\Http\Controllers\Api\KehamilanControlller;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\UploadImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use PHPUnit\Framework\Attributes\Group;
use App\Http\Controllers\Api\FCMTokenController;
use App\Http\Controllers\NotificationController;

Route::post('/login', [LoginController::class, 'login']);
Route::post('/lupa-password', [LoginController::class, 'lupaPass']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user/{id}', [ProfileController::class, 'getUser']);
    Route::get('/logout', [LoginController::class, 'logout']);
    Route::put('/profile/update', [ProfileController::class, 'update']);
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/artikel', [ArtikelController::class, 'index']);
Route::get('/artikel/{id}', [ArtikelController::class, 'show']);
Route::get('/kategori', [KategoriController::class, 'index']);
Route::get('/kategori/{id}', [KategoriController::class, 'show']);


Route::prefix('kehamilan')->group(function () {
    Route::get('/{id}', [KehamilanControlller::class, 'handle']);
});

Route::post('/upload-image', [UploadImage::class, 'uploadPhoto']);
Route::post('/image', [UploadImage::class, 'getImage']);
Route::middleware('auth:sanctum')->post('/update_fcm_token', [FCMTokenController::class, 'update']);
