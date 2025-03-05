<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    /** @use HasFactory<\Database\Factories\TicketFactory> */
    use HasFactory;

    protected $fillable = ['tarjeta'];

    public function productos(){
        return $this->belongsToMany(Producto::class, 'lineas')
                    ->withPivot('cantidad');
    }

    public function getTotal()
    {
        $total = 0;

        foreach ($this->productos as $producto) {
            $precio = $producto->precio * $producto->pivot->cantidad;
            $total += $precio;
        }

        return $total;
    }

}
