<?php


use App\Livewire\Alumnos;
use App\Models\Alumno;
use App\Livewire\Asignaturas;
use App\Livewire\Notas;
use App\Models\Asignatura;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('finales/index', 'finales.index')->name('finales.index');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::get('/alumnos', Alumnos::class)->name('alumnos.index');

Route::get('/alumnos/{id}', function ($id) {
    $alumno = Alumno::findOrFail($id);
    return view('livewire.alumnos.show', compact('alumno'));
})->name('alumnos.show');

Route::get('/asignaturas', Asignaturas::class)->name('asignaturas.index');

Route::get('/asignaturas/{id}', function ($id) {
    $asignatura = Asignatura::findOrFail($id);
    return view('livewire.asignaturas.show', compact('asignatura'));
})->name('asignaturas.show');

Route::get('/notas', Notas::class)->name('notas.index');


require __DIR__.'/auth.php';
