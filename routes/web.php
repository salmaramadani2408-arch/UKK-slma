<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DisposisiController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\KabanController;

// Pemanggilan halaman utama (landing page)
Route::get('/', function () {
    return view('landing');
})->name('welcome');

// Admin autentikasi admin
Route::prefix('admin')->name('admin.')->group(function () {
    // Login Form & Process
    Route::get('/login', [AuthController::class, 'showAdminLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'adminLogin'])->name('login.post');
});

// login autentikasi kaban
Route::prefix('kaban')->name('kaban.')->group(function () {
    // Login Form & Process
    Route::get('/login', [AuthController::class, 'showKabanLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'kabanLogin'])->name('login.post');
});

// proteksi admin
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard Admin dan menu menu nya
    Route::get('/dashboard', function () {
        return view('dashboard'); 
    })->name('dashboard');

    Route::resource('disposisi', DisposisiController::class);
    Route::get('/history', [HistoryController::class, 'index'])->name('history.index');
    
    // Logout admin
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// proteksi kaban
Route::middleware(['auth', 'role:kaban'])->prefix('kaban')->name('kaban.')->group(function () {
    // Dashboard Kaban dan menu nya
    Route::get('/dashboard', [KabanController::class, 'dashboard'])->name('dashboard');

    Route::get('/suratmasuk', [KabanController::class, 'suratmasuk'])->name('suratmasuk');
    Route::get('/suratmasuk/{nomorsurat}', [KabanController::class, 'show'])->name('suratmasuk.show');
    Route::get('/suratmasuk/{nomorsurat}/edit', [KabanController::class, 'edit'])->name('suratmasuk.edit');
    Route::put('/suratmasuk/{nomorsurat}', [KabanController::class, 'update'])->name('suratmasuk.update');
    
    // Logout kaban
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});