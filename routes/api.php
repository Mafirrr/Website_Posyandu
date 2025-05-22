<?php

use App\Http\Controllers\Api\ArtikelController;
use App\Http\Controllers\Api\DashboardFController;
use App\Http\Controllers\Api\JadwalController;
use App\Http\Controllers\Api\KategoriController;
use App\Http\Controllers\Api\KehamilanControlller;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\UploadImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PetugasController;
use PHPUnit\Framework\Attributes\Group;
use App\Http\Controllers\Api\FCMTokenController;
use App\Http\Controllers\NotificationController;

Route::post('/login', [LoginController::class, 'login']);
Route::post('/lupa-password', [LoginController::class, 'lupaPass']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/logout', [LoginController::class, 'logout']);
    Route::put('/profile/update', [ProfileController::class, 'update']);

    Route::prefix('user')->group(function () {
        Route::get('/{id}', [ProfileController::class, 'getUser']);
        Route::put('/pass-change', [ProfileController::class, 'change']);
        Route::get('/keluarga/{id}', [ProfileController::class, 'dataKeluarga']);
        Route::put('/keluarga', [ProfileController::class, 'putData']);
    });

    //upload
    Route::post('/upload-image', [UploadImage::class, 'uploadPhoto']);
    Route::post('/image', [UploadImage::class, 'getImage']);
});


Route::prefix('kehamilan')->group(function () {
    Route::get('/{id}', [KehamilanControlller::class, 'handle']);
});
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/artikel', [ArtikelController::class, 'index']);
Route::get('/artikel/{id}', [ArtikelController::class, 'show']);
Route::get('/kategori', [KategoriController::class, 'index']);
Route::get('/kategori/{id}', [KategoriController::class, 'show']);


Route::prefix('petugas')->group(function () {
    Route::get('/', [PetugasController::class, 'index']);       // Ambil semua petugas (dengan filter dan pagination)
    Route::post('/', [PetugasController::class, 'store']);      // Tambahkan petugas baru
    Route::get('/{id}', [PetugasController::class, 'show']);    // Ambil detail petugas berdasarkan ID
    Route::put('/{id}', [PetugasController::class, 'update']);  // Perbarui data petugas berdasarkan ID
    Route::delete('/{id}', [PetugasController::class, 'destroy']); // Hapus petugas berdasarkan ID
});



Route::post('/upload-image', [UploadImage::class, 'uploadPhoto']);
Route::post('/image', [UploadImage::class, 'getImage']);

Route::get('/jadwal_FD', [DashboardFController::class, 'show']);
Route::middleware('auth:sanctum')->post('/update_fcm_token', [FCMTokenController::class, 'update']);

Route::apiResource('/jadwal', JadwalController::class);
