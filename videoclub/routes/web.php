<?php

use App\Http\Controllers\PeliculaController;
use App\Http\Controllers\PrestamoController;
use App\Http\Controllers\VideojuegoController;
use App\Livewire\PeliculaIndex;
use App\Livewire\PrestamoIndex;
use App\Livewire\VideojuegoIndex;
use App\Models\Videojuego;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::resource('peliculas', PeliculaController::class);

Route::get('/videojuegos/{id}', function ($id) {
    $videojuego = Videojuego::findOrFail($id);
    return view('livewire.videojuegos.show', compact('videojuego'));
})->name('videojuegos.show');

Route::resource('prestamos', PrestamoController::class)->middleware('auth');
Route::resource('videojuegos', VideojuegoController::class);
require __DIR__.'/auth.php';
