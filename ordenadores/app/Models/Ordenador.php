<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ordenador extends Model
{
    /** @use HasFactory<\Database\Factories\OrdenadorFactory> */
    use HasFactory, SoftDeletes;

    protected $table = 'ordenadores';

    protected $fillable = ['marca', 'modelo', 'aula_id'];

    public function dispositivos()
    {
        return $this->morphMany(Dispositivo::class, 'colocable');
    }

    public function cambios()
    {
        return $this->hasMany(Cambio::class);
    }

    public function aula()
    {
        return $this->belongsTo(Aula::class);
    }

    public function formatearFecha($fecha)
    {
        return Carbon::parse($fecha)->setTimeZone('Europe/Madrid')->format('H:i d/m/Y');
    }
}
