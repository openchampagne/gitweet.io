<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'home');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
