<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Videojuego extends Model
{
    /** @use HasFactory<\Database\Factories\VideojuegoFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = ['titulo', 'anyo', 'desarrolladora_id'];

    public function desarrolladora()
    {
        return $this->belongsTo(Desarrolladora::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'posesiones');
    }
}
