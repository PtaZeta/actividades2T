<?php

use App\Http\Controllers\PeliculaController;
use App\Http\Controllers\VideojuegoController;
use App\Livewire\PeliculaIndex;
use App\Livewire\VideojuegoIndex;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::resource('peliculas', PeliculaController::class);

Route::resource('videojuegos', VideojuegoController::class);
require __DIR__.'/auth.php';
