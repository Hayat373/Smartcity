<?php

use App\Http\Controllers\ResourceController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', fn () => view('dashboard'))->name('dashboard');
    Route::get('/resources', [ResourceController::class, 'index'])->name('resources.index');
    Route::post('/resources', [ResourceController::class, 'store'])->name('resources.store');
    Route::get('/predict', [ResourceController::class, 'predict'])->name('resources.predict');
});

require __DIR__.'/auth.php';
