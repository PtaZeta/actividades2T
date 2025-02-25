<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    /** @use HasFactory<\Database\Factories\TicketFactory> */
    use HasFactory;

    public function productos()
    {
        return $this->belongsToMany(Producto::class, 'lineas');
    }

    public function precioTotal($productos)
    {
        return $productos->sum('precio');
    }
}
