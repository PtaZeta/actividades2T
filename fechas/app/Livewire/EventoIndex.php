<?php
namespace App\Livewire;

use App\Models\Evento;
use Carbon\Carbon;
use Livewire\Component;

class EventoIndex extends Component
{
    public $fechaInicio;
    public $fechaFin;
    public $eventos = [];

    public $campoOrdenar = 'nombre';
    public $direccionOrdenar = 'asc';

    public function ordenar($campo)
    {
        if ($this->campoOrdenar === $campo) {
            $this->direccionOrdenar = $this->direccionOrdenar === 'asc' ? 'desc' : 'asc';
        } else {
            $this->campoOrdenar = $campo;
            $this->direccionOrdenar = 'asc';
        }

        $this->filtrar();
    }

    public function updated($variable)
    {
        if ($variable === 'fechaInicio' || $variable === 'fechaFin') {
            $this->filtrar();
        }
    }

    public function filtrar()
    {
        $query = Evento::query();

        if ($this->fechaInicio) {
            $query->whereDate('fecha_inicio', '>=', Carbon::createFromFormat('Y-m-d', $this->fechaInicio));
        }

        if ($this->fechaFin) {
            $query->whereDate('fecha_fin', '<=', Carbon::createFromFormat('Y-m-d', $this->fechaFin));
        }

        $query->orderBy($this->campoOrdenar, $this->direccionOrdenar);

        $this->eventos = $query->get();
    }

    public function mount()
    {
        $this->eventos = Evento::all();
    }

    public function render()
    {
        return view('livewire.evento-index', [
            'eventos' => $this->eventos,
        ]);
    }
}
