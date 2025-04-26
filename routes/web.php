<?php

use App\Http\Controllers\AnggotaController;
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

Route::middleware(['auth'])->group(function () {
    Route::get('/data-anggota', [AnggotaController::class,'index'])->name('anggota.index');
    Route::get('/tambah-anggota', [AnggotaController::class,'anggota_add'])->name('anggota.add');
    Route::post('/anggota-store', [AnggotaController::class, 'anggota_store'])->name('anggota.store');
    Route::get('/anggota/{id}/edit', [AnggotaController::class, 'anggota_edit'])->name('anggota.edit');
    Route::put('/anggota/{id}', [AnggotaController::class, 'anggota_update'])->name('anggota.update');
    Route::delete('/anggota/{id}', [AnggotaController::class, 'anggota_destroy'])->name('anggota.destroy');
});

require __DIR__.'/auth.php';
