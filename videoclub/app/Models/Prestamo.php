<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestamo extends Model
{
    /** @use HasFactory<\Database\Factories\PrestamoFactory> */
    use HasFactory;

    protected $fillable = ['user_id', 'ejemplar_id', 'fecha_devolucion'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function ejemplar()
    {
        return $this->belongsTo(Ejemplar::class, 'ejemplares');
    }
}
