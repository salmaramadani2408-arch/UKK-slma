<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DisposisiController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\KabanController;

Route::get('/', function () {
    return view('landing');
})->name('welcome');

Route::get('/login', function () {
    return redirect()->route('admin.login');
})->name('login');

// Admin Login
Route::get('/admin/login', [AuthController::class, 'showAdminLogin'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'adminLogin']);

// Kaban Login
Route::get('/kaban/login', [AuthController::class, 'showKabanLogin'])->name('kaban.login');
Route::post('/kaban/login', [AuthController::class, 'kabanLogin']);

// Admin Routes
Route::prefix('admin')->middleware('auth:web')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Disposisi Routes - URUTAN SUDAH DIPERBAIKI
    Route::get('/disposisi', [DisposisiController::class, 'index'])->name('disposisi.index');
    Route::get('/disposisi/create', [DisposisiController::class, 'create'])->name('disposisi.create');
    Route::post('/disposisi', [DisposisiController::class, 'store'])->name('disposisi.store');
    
    // Route spesifik HARUS DI ATAS (yang ada suffix seperti /edit, /kirim)
    Route::get('/disposisi/{nomorsurat}/edit', [DisposisiController::class, 'edit'])
        ->where('nomorsurat', '.*')
        ->name('disposisi.edit');
    
    Route::post('/disposisi/kirim/{nomorsurat}', [DisposisiController::class, 'kirim'])
        ->where('nomorsurat', '.*')
        ->name('disposisi.kirim');
    
    // Route umum (wildcard) HARUS DI BAWAH
    Route::get('/disposisi/{nomorsurat}', [DisposisiController::class, 'show'])
        ->where('nomorsurat', '.*')
        ->name('disposisi.show');
    
    Route::put('/disposisi/{nomorsurat}', [DisposisiController::class, 'update'])
        ->where('nomorsurat', '.*')
        ->name('disposisi.update');
    
    Route::delete('/disposisi/{nomorsurat}', [DisposisiController::class, 'destroy'])
        ->where('nomorsurat', '.*')
        ->name('disposisi.destroy');
    
    // History Routes
    Route::get('/history', [HistoryController::class, 'index'])->name('history.index');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// Kaban Routes
Route::prefix('kaban')->middleware('auth:kaban')->name('kaban.')->group(function () {
    Route::get('/dashboard', [KabanController::class, 'dashboard'])->name('dashboard');

    Route::get('/suratmasuk', [KabanController::class, 'suratmasuk'])->name('suratmasuk');
    

    Route::get('/suratmasuk/{nomorsurat}/edit', [KabanController::class, 'edit'])
        ->where('nomorsurat', '.*')
        ->name('suratmasuk.edit');
    
    
    Route::get('/suratmasuk/{nomorsurat}', [KabanController::class, 'show'])
        ->where('nomorsurat', '.*')
        ->name('suratmasuk.show');
    
    Route::put('/suratmasuk/{nomorsurat}', [KabanController::class, 'update'])
        ->where('nomorsurat', '.*')
        ->name('suratmasuk.update');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});