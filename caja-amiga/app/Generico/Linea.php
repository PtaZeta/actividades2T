<?php

namespace App\Generico;

use App\Models\Producto;

class Linea
{
    private Producto $producto;

    public function __construct(Producto $producto)
    {
        $this->producto = $producto;
    }

    public function getProducto(): Producto
    {
        return $this->producto;
    }

    public function setProducto(Producto $producto): void
    {
        $this->producto = $producto;
    }
}
