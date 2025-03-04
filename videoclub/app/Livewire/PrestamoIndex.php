<?php

namespace App\Livewire;

use App\Http\Requests\StorePrestamoRequest;
use App\Models\Ejemplar;
use App\Models\Prestamo;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PrestamoIndex extends Component
{
    public $ejemplable_type;
    public $ejemplar_id;
    public $user_id;
    public $fecha_devolucion = null;

    public function crear()
    {
        if($this->ejemplar_id != '')
        {
            $validated = $this->validate((new StorePrestamoRequest())->rules());

            $prestamo = new Prestamo;

            $prestamo->user_id = Auth::id();
            $prestamo->ejemplar_id = $validated['ejemplar_id'];

            $prestamo->save();

            $this->reset();
        }
    }

    public function render()
    {
        if ($this->ejemplable_type != '')
        {
            $ejemplares = Ejemplar::when($this->ejemplable_type, function ($query) {
                return $query->where('ejemplable_type', $this->ejemplable_type);
            })->get();
        } else {
            $ejemplares = Ejemplar::all();
        }

        return view('livewire.prestamo-index', [
            'ejemplares' => $ejemplares,
        ])->layout('layouts.app');
    }
}
