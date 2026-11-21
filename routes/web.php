<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CmsController;
use App\Http\Controllers\PortfolioController;
use Illuminate\Support\Facades\Route;

// ==========================================
// 1. HALAMAN PUBLIK (Bisa diakses siapa saja)
// ==========================================
Route::get('/', [PortfolioController::class, 'index'])->name('portfolio.home');
Route::post('/kontak/kirim', [PortfolioController::class, 'kirimPesan'])->name('kontak.kirim');

// ==========================================
// 2. OTENTIKASI ADMIN CMS (Guest Only)
// ==========================================
Route::prefix('admin')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('admin.login');
    Route::post('/login', [AuthController::class, 'login'])->name('admin.login.submit');
});

// Alias route named 'login' for Laravel middleware compatibility
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');

// ==========================================
// 3. PANEL ADMIN CMS (Wajib Login Sebagai Admin)
// ==========================================
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    // Logout Admin
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Dashboard & Operasi CMS
    Route::get('/', [CmsController::class, 'dashboard'])->name('dashboard');
    Route::post('/proyek/simpan', [CmsController::class, 'simpanProyek'])->name('proyek.simpan');
    Route::post('/profil/update', [CmsController::class, 'updateProfil'])->name('profil.update');
});
