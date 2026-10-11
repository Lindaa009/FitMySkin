<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\JournalController;
use App\Http\Controllers\AnalisisController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RoutineController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\NotifikasiController;

// Login & Register
Route::get('/', [AuthController::class, 'showLoginRegister'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Halaman yang butuh login
Route::middleware(['auth'])->group(function () {
    // Product CRUD
    Route::get('/katalog', [ProductController::class, 'index'])->name('katalog');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');

    // Jurnal
    Route::get('/jurnal/pagi', [JournalController::class, 'morning'])->name('jurnal.pagi');
    Route::get('/jurnal/malam', [JournalController::class, 'evening'])->name('jurnal.malam');
    Route::get('/jurnal/riwayat', [JournalController::class, 'history'])->name('jurnal.riwayat');
    Route::post('/journals', [JournalController::class, 'store'])->name('journals.store');
    Route::delete('/journals/{id}', [JournalController::class, 'destroy'])->name('journals.destroy');

    // Halaman lain
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/notifikasi', [NotifikasiController::class, 'index'])->name('notifikasi');
    Route::get('/profil', [ProfileController::class, 'index'])->name('profil');
    Route::put('/profil', [ProfileController::class, 'update'])->name('profil.update');
    Route::put('/profil/password', [ProfileController::class, 'updatePassword'])->name('profil.password');
    Route::post('/profil/foto', [ProfileController::class, 'uploadFoto'])->name('profil.foto');
    Route::get('/profil/kelola-langkah', [RoutineController::class, 'index'])->name('profil.langkah');
    Route::post('/routines', [RoutineController::class, 'save'])->name('routines.save');
    Route::get('/analisis/kecocokan', [AnalisisController::class, 'index'])->name('analisis.kecocokan');
});