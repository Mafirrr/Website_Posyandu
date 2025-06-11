<?php

use App\Http\Controllers\{
    AnggotaController,
    Auth\OtpController,
    BeritaController,
    ProfileController,
    PetugasController,
    DashboardController,
    JadwalController,
    KaderController,
    RiwayatPemeriksaanController,
    PemeriksaanController
};
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => view('welcome'));

Route::get('/verify-otp',        [OtpController::class, 'show'])->name('otp.form');
Route::post('/verify-otp',        [OtpController::class, 'verify'])->name('otp.verify');
Route::get('/reset-password-otp', [OtpController::class, 'index'])->name('otp.index');
Route::post('/reset-password-otp', [OtpController::class, 'store'])->name('otp.store');

Route::middleware('auth.multi')->group(function () {

    Route::get('/profile',   [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile',   [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile',   [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get(
        '/riwayat-pemeriksaan',
        [RiwayatPemeriksaanController::class, 'index']
    )->name('riwayat.index');

    Route::get(
        '/riwayat-pemeriksaan/anggota/{anggota}',
        [RiwayatPemeriksaanController::class, 'byAnggota']
    )->name('riwayat.anggota');

    Route::get(
        '/riwayat-pemeriksaan/{id}',
        [RiwayatPemeriksaanController::class, 'show']
    )->whereNumber('id')
        ->name('detail.riwayat');
});

Route::middleware(['auth.multi', 'roleAkses:admin,bidan,kader,ibu_hamil_kader'])
    ->group(function () {
        Route::resource('/petugas',   PetugasController::class);
        Route::resource('kader',      KaderController::class);
        Route::resource('/anggota',   AnggotaController::class)->except(['show']);
        Route::resource('berita',     BeritaController::class);
        Route::resource('/jadwal',    JadwalController::class);
        Route::resource('pemeriksaan', PemeriksaanController::class);
    });

Route::get('/anggota/saran', [AnggotaController::class, 'suggest']);

require __DIR__ . '/auth.php';
