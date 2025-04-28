<?php

use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\ProfileController;
use App\Livewire\AnggotaTable;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/data-anggota', [AnggotaController::class,'index'])->name('anggota.index');
Route::get('/tambah-anggota',[AnggotaController::class,'anggota_add'])->name('anggota.add');// ke yambah
Route::post('/anggota-store', [AnggotaController::class, 'anggota_store'])->name('anggota.store');
Route::get('/anggota/{id}/edit', [AnggotaController::class, 'anggota_edit'])->name('anggota.edit');
Route::put('/anggota/{id}', [AnggotaController::class, 'anggota_update'])->name('anggota.update');
Route::delete('/anggota/{id}', [AnggotaController::class, 'anggota_destroy'])->name('anggota.destroy');
Route::get('/berita', [BeritaController::class,'index'])->name('berita.index');

Route::get('/tambahberita',[BeritaController::class,'create'])->name('berita.tambah');
Route::post('/tambahberita',[BeritaController::class,'store'])->name('berita.store');
Route::get('/beritaedit', [BeritaController::class, 'berita.edit'])->name('berita.edit');
// Route::put('/beritaupdate', [BeritaController::class, 'berita.update'])->name('berita.update');
// Route::post('/anggota-store', [AnggotaController::class, 'anggota_store'])->name('anggota.store');
Route::delete('/beritaupdate', [BeritaController::class, 'berita.delete'])->name('berita.destroy');
require __DIR__.'/auth.php';
