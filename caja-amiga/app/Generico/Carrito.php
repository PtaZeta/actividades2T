<?php

namespace App\Generico;

use App\Models\Producto;
use ValueError;

class Carrito
{
    private array $lineas;

    public function __construct()
    {
        $this->lineas = [];
    }

    public function meter($id)
    {
        if (!($producto = Producto::find($id))) {
            throw new ValueError('El artículo no existe.');
        }
        $this->lineas[] = new Linea($producto);
    }

    public function sacar($id)
    {
        $lineaEncontrada = null;

        foreach ($this->lineas as $index => $linea) {
            if ($linea->getProducto()->id == $id) {
                $lineaEncontrada = $index;
                break;
            }
        }

        if ($lineaEncontrada === null) {
            throw new ValueError('El artículo no está en el carrito.');
        }

        unset($this->lineas[$lineaEncontrada]);
    }


    public function getLineas(): array
    {
        return $this->lineas;
    }

    public function getTotal(): float
    {
        $total = 0;
        foreach ($this->lineas as $linea) {
            $total += $linea->getProducto()->precio;
        }
        return $total;
    }


    public function vacio(): bool
    {
        return count($this->lineas) === 0;
    }

    public static function carrito(): static
    {
        if (!session()->has('carrito')) {
            session()->put('carrito', new static());
        }
        return session()->get('carrito');
    }
}
