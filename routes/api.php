<?php

use Illuminate\Support\Facades\Route;

Route::get('webhook/{pipeline}', 'Api\GithubWebHookController@show');
Route::post('webhook/{pipeline}', 'Api\GithubWebHookController@store');
