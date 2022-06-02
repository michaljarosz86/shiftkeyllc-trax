<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\WelcomeController;

Route::get('/', WelcomeController::class)->name('welcome');

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])
    ->name('home')
    ->middleware('auth');
