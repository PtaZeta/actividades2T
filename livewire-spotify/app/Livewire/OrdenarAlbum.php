<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Album;

class OrdenarAlbum extends Component
{
    use WithPagination;

    public $album;
    public $campoOrdenar = 'titulo';
    public $direccionOrdenar = 'asc';

    public function ordenar($campo)
    {
        if ($this->campoOrdenar === $campo) {
            $this->direccionOrdenar = $this->direccionOrdenar === 'asc' ? 'desc' : 'asc';
        } else {
            $this->campoOrdenar = $campo;
            $this->direccionOrdenar = 'asc';
        }
    }

    public function render()
    {
        $canciones = $this->album->canciones()
            ->orderBy($this->campoOrdenar, $this->direccionOrdenar)
            ->paginate(5);

        return view('livewire.ordenar-album', compact('canciones'));
    }
}
