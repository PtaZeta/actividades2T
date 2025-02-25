<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Album;

class Busqueda extends Component
{
    use WithPagination;

    public $buscar = '';

    public $campoOrdenar = 'nombre';
    public $direccionOrdenar = 'asc';

    public $campoBusqueda = 'nombre';

    protected $queryString = ['search', 'campoBusqueda'];

    public function render()
    {
        $albumes = Album::query()
            ->when($this->buscar, function ($query) {
                if ($this->campoBusqueda === 'nombre') {
                    return $query->where('nombre', 'ilike', "%{$this->buscar}%");
                } elseif ($this->campoBusqueda === 'cancion') {
                    return $query->whereHas('canciones', function ($q) {
                        $q->where('titulo', 'ilike', "%{$this->buscar}%");
                    });
                } elseif ($this->campoBusqueda === 'users') {
                    return $query->whereHas('users', function ($q) {
                        $q->where('name', 'ilike', "%{$this->buscar}%");
                    });
                }
            })
            ->orderBy($this->campoOrdenar, $this->direccionOrdenar)
            ->paginate(6);

        return view('livewire.busqueda', ['albumes' => $albumes]);
    }
}
