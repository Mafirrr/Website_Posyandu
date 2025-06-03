<?php

use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\Auth\OtpController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\KaderController;
use App\Http\Controllers\RiwayatPemeriksaanController;
use App\Http\Controllers\PemeriksaanController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/verify-otp', [OtpController::class, 'show'])->name('otp.form');
Route::post('/verify-otp', [OtpController::class, 'verify'])->name('otp.verify');
Route::get('/reset-password-otp', [OtpController::class, 'index'])->name('otp.index');
Route::post('/reset-password-otp', [OtpController::class, 'store'])->name('otp.store');

Route::middleware('auth.multi')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/riwayat-pemeriksaan', [RiwayatPemeriksaanController::class, 'index'])->name('riwayat.index');
    Route::get('/riwayat-pemeriksaan/{id}', [RiwayatPemeriksaanController::class, 'show'])->name('detail.riwayat');
});

Route::middleware(['auth.multi', 'roleAkses:admin,bidan,kader,ibu_hamil_kader'])->group((function () {
    Route::resource('/petugas', PetugasController::class);
    Route::resource('kader', KaderController::class);
    Route::resource('/anggota', AnggotaController::class)->except(['show']);
    Route::resource("berita", BeritaController::class);
    Route::resource('/jadwal', JadwalController::class);
    Route::resource('pemeriksaan', PemeriksaanController::class);
}));
Route::get('/anggota/saran', [AnggotaController::class, 'suggest']);

require __DIR__ . '/auth.php';
