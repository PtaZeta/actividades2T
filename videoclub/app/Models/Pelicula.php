<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelicula extends Model
{
    /** @use HasFactory<\Database\Factories\PeliculaFactory> */
    use HasFactory;

    protected $fillable = ['titulo', 'duracion'];

    public function ejemplares()
    {
        return $this->morphMany(Ejemplar::class, 'ejemplares');
    }
}
