<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TemperatureController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/home', [TemperatureController::class, 'index']);
Auth::routes();

Route::get('/home2', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
