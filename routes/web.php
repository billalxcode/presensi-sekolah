<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('welcome');
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('present', [DashboardController::class, 'present'])->name('present');

    Route::get('history', function () {
        return Inertia::render('history');
    })->name('history');
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
