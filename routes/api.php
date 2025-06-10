<?php

use App\Http\Controllers\Api\ArtikelController;
use App\Http\Controllers\Api\DashboardFController;
use App\Http\Controllers\Api\JadwalController;
use App\Http\Controllers\Api\KategoriController;
use App\Http\Controllers\Api\KehamilanControlller;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\Trimester;
use App\Http\Controllers\Api\UploadImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PetugasbidanController;
use App\Http\Controllers\Api\FCMTokenController;
use App\Http\Controllers\Api\AnggotaKaderController;
use App\Http\Controllers\Api\GrafikController;
use App\Http\Controllers\API\DashboardApiController;
use App\Http\Controllers\API\NotifController;

// Rute API untuk AnggotaKader
Route::prefix('anggota')->group(function () {
    Route::get('/', [AnggotaKaderController::class, 'index']);
    Route::post('/', [AnggotaKaderController::class, 'store']);
    Route::get('/{id}', [AnggotaKaderController::class, 'show']);
    Route::put('/{id}', [AnggotaKaderController::class, 'update']);
    Route::delete('/{id}', [AnggotaKaderController::class, 'destroy']);
});
Route::post('/login', [LoginController::class, 'login']);
Route::post('/lupa-password', [LoginController::class, 'lupaPass']);
Route::post('/send-otp', [LoginController::class, 'sendOtp']);
Route::post('/verify-otp', [LoginController::class, 'verifyOtp']);
Route::post('/resetPass', [LoginController::class, 'resetPassword']);

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
    Route::apiResource('/pemeriksaan-kehamilan', Trimester::class);
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


Route::apiResource('petugas', PetugasbidanController::class);

Route::get('/jadwal_FD', [DashboardFController::class, 'show']);
Route::middleware('auth:sanctum')->post('/update_fcm_token', [FCMTokenController::class, 'update']);

Route::apiResource('/jadwal', JadwalController::class);

Route::get('/posyandu', [AnggotaKaderController::class, 'posyandu']);

Route::get('/dashboard/grafik', [DashboardApiController::class, 'grafik']);
Route::get('/dashboard/riwayat', [DashboardApiController::class, 'riwayat']);

Route::get('/getbb/{id}', [GrafikController::class, 'getBB']);
Route::get('/jadwalnotif/{id}', [NotifController::class, 'index']);
Route::get('/jadwal/check/{id}', [NotifController::class, 'checkStatus']);
