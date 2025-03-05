<?php

namespace App\Livewire;

use App\Models\Producto;
use App\Models\Ticket;
use Livewire\Component;

class Carrito extends Component
{
    public $codigo = null;
    public $lineas = [];
    public $total = 0;
    public $tarjeta = null;
    public $comprando = true;
    public $compraTerminada = false;

    public function mount(){
        $this->lineas = session()->get('lineas', []);
        $this->total = session()->get('total', 0);
    }

    public function guardarEnSesion()
    {
        session()->put('lineas', $this->lineas);
        session()->put('total', $this->total);
    }

    public function anyadirProducto($producto_id = null){

        if($producto_id == null){

            $producto = Producto::where('codigo', $this->codigo)->first();
        } else{
            $producto = Producto::find($producto_id);
        }


        if($producto){

            if (isset($this->lineas[$producto->id])) {
                // Si está, sumamos 1 a la cantidad
                $this->lineas[$producto->id] += 1;
            } else {
                // Si no está, lo añadimos con cantidad 1
                $this->lineas[$producto->id] = 1;
            }

            $this->total += $producto->precio;
        }


        $this->guardarEnSesion();
    }

    public function eliminarProducto($producto_id){

        if (isset($this->lineas[$producto_id])) {
            // Si la cantidad es 1, eliminamos el producto del array
            if ($this->lineas[$producto_id] == 1) {
                unset($this->lineas[$producto_id]);
            }
            // Si la cantidad es mayor que 1, restamos 1
            elseif ($this->lineas[$producto_id] > 1) {
                $this->lineas[$producto_id] -= 1;
            }
        }

        $this->total -= Producto::find($producto_id)->precio;

        $this->guardarEnSesion();
    }

    public function reiniciarCompra(){

        $this->lineas = [];

        session()->forget('lineas');
        session()->forget('total');

        return redirect()->route('cajaAmiga');

    }

    public function finalizarCompra(){

        $this->comprando = false;
    }

    public function comprar(){


        $validated = $this->validate([
            'tarjeta' => 'required|string|size:16',
        ]);

        $ticket = Ticket::create($validated);

        if ($ticket) {
            foreach ($this->lineas as $producto_id => $cantidad) {
                $producto = Producto::find($producto_id); // Obtener el producto por ID

                if ($producto) {
                    // Crear la línea asociada al ticket y producto
                    $ticket->productos()->attach($producto->id, ['cantidad' => $cantidad]);
                    // Linea::create([
                    //     'ticket_id' => $ticket->id,
                    //     'producto_id' => $producto->id,
                    //     'cantidad' => $cantidad,
                    // ]);
                }
            }
        }

        $this->lineas = [];
        $this->total = 0;
        session()->forget('lineas');
        session()->forget('total');

        $this->compraTerminada = true;
    }

    public function render()
    {

        $productos = Producto::whereIn('id', array_keys($this->lineas))->get();

        $this->guardarEnSesion();

        return view('livewire.carrito', [

            'productos' => $productos,
            'lineas' => $this->lineas,
            'total' => $this->total,
            'comprando' => $this->comprando,

        ])
        ->layout('layouts.app');
    }
}


// <?php

// namespace App\Livewire;

// use App\Models\Producto;
// use App\Models\Ticket;
// use Livewire\Component;

// class Carrito extends Component
// {
//     public $codigo = null;
//     public $lineas = []; // Guardará una lista de IDs en orden de escaneo
//     public $total = 0;
//     public $tarjeta = null;
//     public $comprando = true;
//     public $compraTerminada = false;

//     public function mount()
//     {
//         $this->lineas = session()->get('lineas', []);
//         $this->total = session()->get('total', 0);
//     }

//     public function guardarEnSesion()
//     {
//         session()->put('lineas', $this->lineas);
//         session()->put('total', $this->total);
//     }

//     public function anyadirProducto($producto_id = null)
//     {
//         if ($producto_id == null) {
//             $producto = Producto::where('codigo', $this->codigo)->first();
//         } else {
//             $producto = Producto::find($producto_id);
//         }

//         if ($producto) {
//             // En lugar de incrementar cantidad, agregamos una nueva línea
//             $this->lineas[] = $producto->id;
//             $this->total += $producto->precio;
//         }

//         $this->guardarEnSesion();
//     }

//     public function eliminarProducto($producto_id)
//     {
//         $index = array_search($producto_id, $this->lineas);

//         if ($index !== false) {
//             unset($this->lineas[$index]); // Eliminamos solo una ocurrencia
//             $this->lineas = array_values($this->lineas); // Reindexamos el array
//             $this->total -= Producto::find($producto_id)->precio;
//         }

//         $this->guardarEnSesion();
//     }

//     public function reiniciarCompra()
//     {
//         $this->lineas = [];
//         session()->forget('lineas');
//         session()->forget('total');

//         return redirect()->route('cajaAmiga');
//     }

//     public function finalizarCompra()
//     {
//         $this->comprando = false;
//     }

//     public function comprar()
//     {
//         $validated = $this->validate([
//             'tarjeta' => 'required|string|size:16',
//         ]);

//         $ticket = Ticket::create($validated);

//         if ($ticket) {
//             foreach ($this->lineas as $producto_id) {
//                 $ticket->productos()->attach($producto_id); // No pasamos cantidad
//             }
//         }

//         $this->lineas = [];
//         $this->total = 0;
//         session()->forget('lineas');
//         session()->forget('total');

//         $this->compraTerminada = true;
//     }

//     public function render()
//     {
//         $productos = Producto::whereIn('id', $this->lineas)->get();

//         $this->guardarEnSesion();

//         return view('livewire.carrito', [
//             'productos' => $productos,
//             'lineas' => $this->lineas,
//             'total' => $this->total,
//             '
