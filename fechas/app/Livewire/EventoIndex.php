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

    public function updated($propertyName)
    {
        if ($propertyName === 'fechaInicio' || $propertyName === 'fechaFin') {
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

        $this->eventos = $query->get();
    }

    public function mount()
    {
        $this->eventos = Evento::all();
    }


    public function render()
    {
        return view('livewire.evento-index');
    }
}
