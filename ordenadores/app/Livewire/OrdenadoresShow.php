<?php

namespace App\Livewire;

use App\Models\Cambio;
use App\Models\Ordenador;
use Livewire\Component;

class OrdenadoresShow extends Component
{
    public $ordenador;

    public function mount(Ordenador $ordenador)
    {
        $this->ordenador = $ordenador;
    }

    public function limpiarCambios()
    {
        foreach($this->ordenador->cambios as $cambio)
        {
            $cambio->delete();
        }
        $this->ordenador->load('cambios');
    }

    public function render()
    {
        $cambios = Cambio::where('ordenador_id', $this->ordenador->id);

        return view('livewire.ordenadores-show', compact('cambios'));
    }
}
