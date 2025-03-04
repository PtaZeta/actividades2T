<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Videojuego extends Model
{
    /** @use HasFactory<\Database\Factories\VideojuegoFactory> */
    use HasFactory;

    protected $fillable = ['titulo', 'portada'];

    public function ejemplares()
    {
        return $this->morphMany(Ejemplar::class, 'ejemplable');
    }
}
