<?php

namespace App\Livewire;

use App\Models\Pista;
use App\Models\Reserva;
use Livewire\Component;

class ReservaIndex extends Component
{
    public $tabla = [];

    public $pista_id = '';

    public function actualizarTabla()
    {
        if($this->pista_id != '') {
            for($i = 10; $i < 20; $i++) {
                $this->tabla[$i] = [];
                for($j = 1; $j <= 5; $j++) {
                    $dow = today()->dayOfWeek($j)->addHour($i);
                    $reserva = Reserva::where('pista_id', $this->pista_id)->where('fecha_hora', $dow)->first();
                    $this->tabla[$i][] = $reserva ?? $dow;
                }
            }
        }
    }


    public function render()
    {
        $this->actualizarTabla();
        return view('livewire.reserva-index', [
            'pistas' => Pista::all(),
            'tabla' => $this->tabla,
        ]);
    }
}
