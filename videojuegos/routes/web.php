<?php

use App\Http\Controllers\VideojuegoController;
use App\Models\Videojuego;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');


Route::view('videojuegos/poseo', 'videojuegos.poseo')->name('videojuegos.poseo');
Route::resource('videojuegos', VideojuegoController::class)->middleware('auth');

require __DIR__.'/auth.php';
