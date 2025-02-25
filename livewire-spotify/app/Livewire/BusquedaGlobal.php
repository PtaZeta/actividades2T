<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Album;
use App\Models\Cancion;
use App\Models\Artista;

class BusquedaGlobal extends Component
{

    public $buscar = '';

    public function render()
    {
        if (!empty($this->buscar)) {
            $albumes = Album::where('nombre', 'ilike', '%' . $this->buscar . '%')->get();
            $canciones = Cancion::where('titulo', 'ilike', '%' . $this->buscar . '%')->get();
            $artistas = Artista::where('nombre', 'ilike', '%' . $this->buscar . '%')->get();
        } else {
            $albumes = Album::all();
            $canciones = Cancion::all();
            $artistas = Artista::all();
        }

        return view('livewire.busqueda-global', compact('albumes', 'canciones', 'artistas'));
    }
}
