<?php

use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\KaderController;
use App\Http\Controllers\RiwayatPemeriksaanController;
use App\Http\Controllers\PemeriksaanController;
use App\Livewire\AnggotaTable;
use App\Models\Petugas;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
// ->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

Route::middleware(['auth', 'roleAkses:bidan,kader'])->group((function () {
    Route::resource('/petugas', PetugasController::class);

    Route::resource('/anggota', AnggotaController::class);
    Route::resource("berita", BeritaController::class);
    Route::resource('/jadwal', JadwalController::class);

    Route::get('/riwayat-pemeriksaan', [RiwayatPemeriksaanController::class, 'index'])->name('riwayat.index');
    Route::resource('pemeriksaan', PemeriksaanController::class);
}));


Route::get('/anggota/saran', [AnggotaController::class, 'suggest']);

require __DIR__ . '/auth.php';
