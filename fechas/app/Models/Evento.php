<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    /** @use HasFactory<\Database\Factories\EventoFactory> */
    use HasFactory;

    protected $fillable = ['nombre', 'fecha_inicio', 'fecha_fin'];
}
