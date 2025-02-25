<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aula extends Model
{
    /** @use HasFactory<\Database\Factories\AulaFactory> */
    use HasFactory;

    protected $fillable = ['nombre'];

    public function dispositivos()
    {
        return $this->morphToMany(Dispositivo::class, 'colocable');
    }

    public function cambios_origen()
    {
        return $this->hasMany(Cambio::class, 'origen_id');
    }

    public function cambios_destino()
    {
        return $this->hasMany(Cambio::class, 'destino_id');
    }

    public function ordenadores()
    {
        return $this->hasMany(Ordenador::class);
    }

}
