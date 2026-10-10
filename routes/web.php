<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login-register');
})->name('login');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

Route::get('/notifikasi', function () {
    return view('notifikasi');
})->name('notifikasi');

Route::get('/profil', function () {
    return view('profil');
})->name('profil');

Route::get('/profil/kelola-langkah', function () {
    return view('kelola-langkah');
})->name('profil.langkah');

Route::view('/katalog', 'katalog.index')->name('katalog');
Route::view('/jurnal/pagi', 'jurnal.pagi')->name('jurnal.pagi');
Route::view('/jurnal/malam', 'jurnal.malam')->name('jurnal.malam');
Route::view('/jurnal/riwayat', 'jurnal.riwayat')->name('jurnal.riwayat');
Route::view('/analisis/kecocokan', 'analisis.kecocokan')->name('analisis.kecocokan');
