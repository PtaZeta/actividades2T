<?php

namespace App\Models;

use Carbon\Carbon;
use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Evento extends Model
{
    /** @use HasFactory<\Database\Factories\EventoFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = ['nombre', 'fecha_inicio', 'fecha_fin'];

    public function formatearFecha($fecha)
    {
        return Carbon::parse($fecha)->setTimeZone('Europe/Madrid')->format('d/m/Y H:i:s');
    }

    public function eventoTerminado()
    {
        $fechaActual = new DateTime();

        $fechaInicio = new Datetime($this->fecha_inicio);
        $fechaFin = new Datetime($this->fecha_fin);

        if($fechaActual < $fechaInicio) {
            return 'Proximo evento';
        }
        elseif ($fechaActual > $fechaFin) {
            return 'Evento pasado';
        } else {
            return 'En curso';
        }
    }
}
