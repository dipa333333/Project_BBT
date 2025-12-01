<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SensorController;
use App\Http\Controllers\NotifikasiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\ProfileController;

// Default root → dashboard
Route::get('/', function () {
    return redirect('/dashboard');
});

// Auth routes (dari Breeze)
require __DIR__.'/auth.php';

// Semua halaman ini harus login dulu
Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // Monitoring
    Route::get('/monitoring', function () {
        return view('monitoring.index');
    })->name('monitoring');

    // Historis
    Route::get('/historis', function () {
        return view('historis.index');
    })->name('historis');

    // About
    Route::get('/about', function () {
        return view('about.index');
    })->name('about');

    // Sensor CRUD
    Route::resource('/sensor', SensorController::class);

    // Notifikasi CRUD
    Route::resource('/notifikasi', NotifikasiController::class);

    // User Management
    Route::resource('/users', UserController::class);

    // Settings
    Route::get('/settings', [SettingsController::class, 'index'])
        ->name('settings.index');

    Route::put('/settings', [SettingsController::class, 'update'])
        ->name('settings.update');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['role:admin'])->group(function () {
    Route::resource('/users', UserController::class);
});
