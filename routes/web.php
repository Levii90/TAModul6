<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PetugasProfileController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/form');

Route::get('/form', [LaporanController::class, 'create'])->name('laporan.create');
Route::post('/laporan', [LaporanController::class, 'store'])->name('laporan.store');
Route::get('/laporan/terkirim', [LaporanController::class, 'confirmation'])->name('laporan.confirmation');

Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisterController::class, 'create'])->name('register');
    Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
    Route::get('/login', [LoginController::class, 'create'])->name('login');
    Route::post('/login', [LoginController::class, 'store'])->name('login.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/daftar-laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('/profil-petugas', [PetugasProfileController::class, 'show'])->name('petugas.profile');
    Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');
});
