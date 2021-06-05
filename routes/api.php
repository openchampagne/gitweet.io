<?php

use Illuminate\Support\Facades\Route;

Route::post('webhook/{pipeline}', 'Api\GithubWebHookController@store');
