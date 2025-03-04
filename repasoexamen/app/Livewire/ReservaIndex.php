<?php

namespace App\Livewire;

use App\Models\Pista;
use App\Models\Reserva;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ReservaIndex extends Component
{
    public $tabla = [];

    public $pista_id = '';

    public function actualizarTabla()
    {
        if ($this->pista_id !== '')
        {
            for ($i = 10; $i < 20; $i++) {
                $this->tabla[$i] = [];

                for ($j = 1; $j <= 5; $j++) {
                    $dow = today()->dayOfWeek($j)->addHour($i);
                    $reserva = Reserva::where('pista_id', $this->pista_id)->where('fecha_hora', $dow)->first();
                    $this->tabla[$i][] = $reserva ?? $dow;
                }
            }
        }
    }

    public function reservar($fecha_hora)
    {
        $fechaReserva = Carbon::parse($fecha_hora)->startOfDay();
        if ($fechaReserva > today() && $fechaReserva <= today()->dayOfWeek(5))
        {
            Reserva::create([
                'fecha_hora' => $fecha_hora,
                'pista_id' => $this->pista_id,
                'user_id' => Auth::id(),
            ]);
        }

        $this->actualizarTabla();
    }

    public function eliminar($reserva_id)
    {
        $reserva = Reserva::where('id', $reserva_id)->where('user_id', Auth::id())->firstOrFail();

        $reserva->delete();
        $this->actualizarTabla();
    }

    public function render()
    {
        $this->actualizarTabla();

        return view('livewire.reserva-index', [
            'tabla' => $this->tabla,
            'pistas' => Pista::all(),
        ])->layout('layouts.app');
    }
}
