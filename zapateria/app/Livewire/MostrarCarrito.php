<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Session;
use App\Models\Factura;
use App\Models\Linea;
use App\Models\Zapato;

class MostrarCarrito extends Component
{
    public $carrito = [];
    public $total = 0;

    public function mount()
    {
        $this->carrito = Session::get('carrito', []);
        $this->calcularTotal();
    }

    public function calcularTotal()
    {
        $this->total = 0;
        foreach ($this->carrito as $item) {
            $this->total += $item['precio'] * $item['cantidad'];
        }
    }

    public function incrementarCantidad($id)
    {
        if(isset($this->carrito[$id])){
            $this->carrito[$id]['cantidad']++;
            Session::put('carrito', $this->carrito);
            $this->calcularTotal();
        }
    }

    public function decrementarCantidad($id)
{
    if (isset($this->carrito[$id])) {
        $this->carrito[$id]['cantidad']--;

        if ($this->carrito[$id]['cantidad'] <= 0) {
            unset($this->carrito[$id]);
        }

        Session::put('carrito', $this->carrito);
        $this->calcularTotal();
    }
}

    public function vaciarCarrito()
    {
        $this->carrito = [];
        Session::forget('carrito');
        $this->calcularTotal();
    }

    public function realizarPedido()
    {
        if (empty($this->carrito)) {
            return;
        }

        $factura = Factura::create([
            'created_at' => now(),
            'user_id' => auth()->id(),
        ]);

        foreach ($this->carrito as $item) {
            Linea::create([
                'factura_id' => $factura->id,
                'zapato_id' => $item['id'],
                'cantidad' => $item['cantidad'],
                'precio' => $item['precio'],
            ]);
        }

        $this->vaciarCarrito();

        return redirect()->route('facturas.show', $factura->id);
    }

    public function render()
    {
        return view('livewire.mostrar-carrito', [
            'carrito' => $this->carrito,
            'total'   => $this->total
        ]);
    }
}
