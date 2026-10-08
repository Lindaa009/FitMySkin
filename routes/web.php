<?php

use Illuminate\Support\Facades\Route;
Route::get('/', function () {
    return view('welcome');
});

Route::get('/analisis/kecocokan', function () {
    return view('analisis.kecocokan');
});
