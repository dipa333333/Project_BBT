<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SensorController;
use App\Http\Controllers\NotifikasiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SettingsController;



Route::get('/', function () {
    return redirect('/dashboard');
});

Route::get('/monitoring', function () {
    return view('monitoring.index');
});

Route::get('/historis', function () {
    return view('historis.index');
});

Route::get('/settings', function () {
    return view('settings.index');
});

Route::get('/about', function () {
    return view('about.index');
});



Route::resource('/sensor', SensorController::class);
Route::resource('/notifikasi', NotifikasiController::class);
Route::resource('/users', UserController::class);
Route::get('/dashboard', [DashboardController::class, 'index']);
Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
Route::put('/settings', [SettingsController::class, 'update'])->name('settings.update');





