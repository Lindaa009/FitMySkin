<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login-register');
})->name('login');

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::view('/katalog', 'katalog.index')->name('katalog');
Route::view('/jurnal/pagi', 'jurnal.pagi')->name('jurnal.pagi');
Route::view('/jurnal/malam', 'jurnal.malam')->name('jurnal.malam');
Route::view('/jurnal/riwayat', 'jurnal.riwayat')->name('jurnal.riwayat');
Route::view('/analisis/kecocokan', 'analisis.kecocokan')->name('analisis.kecocokan');
