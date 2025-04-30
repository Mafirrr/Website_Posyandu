<?php

use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\KaderController;
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
});

Route::middleware(['auth'])->group(function () {
    Route::get('/data-anggota', [AnggotaController::class,'index'])->name('anggota.index');
    Route::get('/tambah-anggota', [AnggotaController::class,'anggota_add'])->name('anggota.add');
    Route::post('/anggota-store', [AnggotaController::class, 'anggota_store'])->name('anggota.store');
    Route::get('/anggota/{id}/edit', [AnggotaController::class, 'anggota_edit'])->name('anggota.edit');
    Route::put('/anggota/{id}', [AnggotaController::class, 'anggota_update'])->name('anggota.update');
    Route::delete('/anggota/{id}', [AnggotaController::class, 'anggota_destroy'])->name('anggota.destroy');
});

Route::get('/data-kader', [KaderController::class, 'index'])->name('kader.index');
Route::get('/tambah-kader', [KaderController::class, 'kader_add'])->name('kader.add');
Route::post('/kader-store', [KaderController::class, 'kader_store'])->name('kader.store');
Route::get('/kader/{id}/edit', [KaderController::class, 'kader_edit'])->name('kader.edit');
Route::put('/kader/{id}', [KaderController::class, 'kader_update'])->name('kader.update');
Route::delete('/kader/{id}', [KaderController::class, 'kader_destroy'])->name('kader.destroy');

Route::get('/data-anggota', [AnggotaController::class, 'index'])->name('anggota.index');
Route::get('/tambah-anggota', [AnggotaController::class, 'anggota_add'])->name('anggota.add');
Route::post('/anggota-store', [AnggotaController::class, 'anggota_store'])->name('anggota.store');
Route::get('/anggota/{id}/edit', [AnggotaController::class, 'anggota_edit'])->name('anggota.edit');
Route::put('/anggota/{id}', [AnggotaController::class, 'anggota_update'])->name('anggota.update');
Route::delete('/anggota/{id}', [AnggotaController::class, 'anggota_destroy'])->name('anggota.destroy');

Route::get('/berita', [BeritaController::class,'index'])->name('berita.index');
Route::get('/tambahberita',[BeritaController::class,'create'])->name('berita.tambah');
Route::post('/beritastore',[BeritaController::class,'store'])->name('berita.store');
Route::put('/beritaedit{id}', [BeritaController::class, 'update'])->name('berita.update');
Route::get('/beritaedit{id}/edit', [BeritaController::class, 'edit'])->name('berita.edit');
Route::delete('/beritaupdate{id}', [BeritaController::class, 'destroy'])->name('berita.destroy');

Route::post('/anggota-store', [AnggotaController::class, 'anggota_store'])->name('anggota.store');
Route::delete('/beritaupdate', [BeritaController::class, 'berita.delete'])->name('berita.destroy');
Route::get('/jadwal', [JadwalController::class, 'view'])->name('jadwal');

require __DIR__ . '/auth.php';
