<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'home');

Route::get('login/github', 'Auth\LoginController@redirectToProvider')->name('register');
Route::get('login/github/callback', 'Auth\LoginController@handleProviderCallback');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('install', 'RepositoryController@create')->name('install');

    Route::get('pipeline/add/{author}/{repository}', 'PipelineController@addRepository')->name('pipeline.create');
    Route::get('pipeline', 'PipelineController@index')->name('pipeline.index');
    Route::delete('pipeline/{pipeline}', 'PipelineController@destroy')->name('pipeline.destroy');

    // Link Twitter to Pipeline
    Route::get('pipeline/{pipeline}/link/twitter', 'Auth\TwitterController@redirectToProvider')->name('pipeline.twitter.link');
    Route::get('pipeline/twitter/callback', 'Auth\TwitterController@handleProviderCallback');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
