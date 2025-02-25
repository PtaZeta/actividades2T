<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Session;

class CarritoMenu extends Component
{
    public $cantidadTotal = 0;

    protected $listeners = ['carritoActualizado' => 'actualizarCantidad'];

    public function mount()
    {
        $this->actualizarCantidad();
    }

    public function actualizarCantidad()
    {
        $carrito = Session::get('carrito', []);
        $this->cantidadTotal = array_sum(array_column($carrito, 'cantidad'));
    }

    public function render()
    {
        return view('livewire.carrito-menu');
    }
}
