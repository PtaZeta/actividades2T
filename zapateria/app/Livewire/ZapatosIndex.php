<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Session;
use App\Models\Zapato;

class ZapatosIndex extends Component
{
    public $zapatos;

    public function mount()
    {
        $this->zapatos = Zapato::all();
    }

    public function añadirAlCarrito($zapatoId)
    {
        $carrito = Session::get('carrito', []);
        $zapato = Zapato::find($zapatoId);

        if (!$zapato) {
            return;
        }

        if (isset($carrito[$zapatoId])) {
            $carrito[$zapatoId]['cantidad'] += 1;
        } else {
            $carrito[$zapatoId] = [
                'id' => $zapato->id,
                'denominacion' => $zapato->denominacion,
                'precio' => $zapato->precio,
                'cantidad' => 1,
            ];
        }

        Session::put('carrito', $carrito);
        $this->dispatch('carritoActualizado');
    }

    public function incrementarCantidad($zapatoId)
    {
        if (isset($this->carrito[$zapatoId])) {
            $this->carrito[$zapatoId]['cantidad']++;
            Session::put('carrito', $this->carrito);
        }
    }

    public function decrementarCantidad($zapatoId)
    {
        if (isset($this->carrito[$zapatoId]) && $this->carrito[$zapatoId]['cantidad'] > 1) {
            $this->carrito[$zapatoId]['cantidad']--;
            Session::put('carrito', $this->carrito);
        }
    }

    public function vaciarCarrito()
    {
        Session::forget('carrito');
    }

    public function render()
    {
        return view('livewire.zapatos-index', ['zapatos' => $this->zapatos]);
    }
}
