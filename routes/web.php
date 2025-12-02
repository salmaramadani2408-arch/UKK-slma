<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DisposisiController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\KabanController;

// ============================================
// PUBLIC ROUTES (Tidak perlu login)
// ============================================

// Landing Page dengan 2 pilihan portal login
Route::get('/', function () {
    return view('landing');
})->name('welcome');

// Route untuk menampilkan form login
Route::get('/login/admin', [AuthController::class, 'showAdminLogin'])->name('login.admin');
Route::get('/login/kaban', [AuthController::class, 'showKabanLogin'])->name('login.kaban');

// Route untuk proses login (POST)
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

// ============================================
// PROTECTED ROUTES - ADMIN
// ============================================
Route::middleware(['auth', 'role:admin'])->group(function () {
    // Dashboard Admin
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    
    // Disposisi Management
    Route::resource('disposisi', DisposisiController::class);
    
    // History
    Route::get('/history', [HistoryController::class, 'index'])->name('history.index');
    
    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// ============================================
// PROTECTED ROUTES - KABAN/PIMPINAN
// ============================================
Route::middleware(['auth', 'role:kaban'])->prefix('kaban')->name('kaban.')->group(function () {
    // Dashboard Kaban
    Route::get('/dashboard', [KabanController::class, 'dashboard'])->name('dashboard');
    
    // Surat Masuk Management
    Route::get('/suratmasuk', [KabanController::class, 'suratmasuk'])->name('suratmasuk');
    Route::get('/suratmasuk/{nomorsurat}', [KabanController::class, 'show'])->name('suratmasuk.show');
    Route::get('/suratmasuk/{nomorsurat}/edit', [KabanController::class, 'edit'])->name('suratmasuk.edit');
    Route::put('/suratmasuk/{nomorsurat}', [KabanController::class, 'update'])->name('suratmasuk.update');
    
    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});