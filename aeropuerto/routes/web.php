<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\VueloController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/vuelos');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/vuelos/create', function () {
    return view('vuelos.create');
})->name('vuelos.create');

Route::resource('vuelos', VueloController::class);

Route::get('/vuelos', [VueloController::class, 'index'])->name('vuelos.index');

Route::middleware(['auth'])->group(function () {
    Route::get('/reservas', [ReservaController::class, 'index'])->name('reservas.index');
    Route::get('/reservas/create/{vuelo}', [ReservaController::class, 'create'])->name('reservas.create');
    Route::post('/reservas/store/{vuelo}', [ReservaController::class, 'store'])->name('reservas.store');
    Route::get('/reservas/show/{reserva}', [ReservaController::class, 'show'])->name('reservas.show');
});

require __DIR__.'/auth.php';
