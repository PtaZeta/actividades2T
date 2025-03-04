<?php

namespace App\Livewire;

use App\Http\Requests\StorePeliculaRequest;
use App\Http\Requests\UpdatePeliculaRequest;
use App\Models\Pelicula;
use Livewire\Component;

use function Livewire\Volt\layout;

class PeliculaIndex extends Component
{
    public $pelicula_id;
    public $estaEditando = false;
    public $titulo;
    public $duracion;

    public function formatearDuracion($duracion)
    {
        $segundos = $duracion * 60;
        return gmdate('H:i', $segundos);
    }

    public function crear()
    {
        $validated = $this->validate((new StorePeliculaRequest())->rules());
        Pelicula::create($validated);
    }

    public function editar($pelicula_id)
    {
        $this->pelicula_id = $pelicula_id;
        $pelicula = Pelicula::findOrFail($pelicula_id);
        $this->titulo = $pelicula->titulo;
        $this->duracion = $pelicula->duracion;
        $this->estaEditando = true;
    }

    public function actualizar()
    {
        $pelicula = Pelicula::findOrFail($this->pelicula_id);
        $validated = $this->validate((new UpdatePeliculaRequest())->rules());
        $pelicula->update($validated);
        $this->reset();

    }

    public function cancelar()
    {
        $this->reset();
    }

    public function eliminar($pelicula_id)
    {
        $pelicula = Pelicula::findOrFail($pelicula_id);
        $pelicula->delete();
    }

    public function render()
    {
        return view('livewire.pelicula-index', [
            'peliculas' => Pelicula::all(),
        ]);
    }
}
