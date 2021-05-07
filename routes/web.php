<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'home');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::name('install')->get('install', 'RepositoryController@create');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
