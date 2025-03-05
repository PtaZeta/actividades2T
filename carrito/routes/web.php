<?php

use App\Http\Controllers\TicketController;
use App\Livewire\Carrito;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::get('/cajaAmiga', function (){

    return view('cajaAmiga');

})->name('cajaAmiga');

Route::resource('tickets', TicketController::class);

Route::get('/compra/carrito', Carrito::class)->name('carrito');

require __DIR__.'/auth.php';
