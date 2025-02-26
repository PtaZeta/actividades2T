<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ejemplar extends Model
{
    /** @use HasFactory<\Database\Factories\EjemplarFactory> */
    use HasFactory;

    protected $table = 'ejemplares';


    public function libro(){
        return $this->belongsTo(Libro::class);
    }

    public function clientes()
    {
        return $this->belongsToMany(Cliente::class, 'prestamos')
                            ->withPivot('fecha_hora', 'fecha_hora_devolucion');
    }
}
