<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asignatura extends Model
{
    /** @use HasFactory<\Database\Factories\AsignaturaFactory> */
    use HasFactory;

    protected $fillable = ['denominacion', 'numero_trimestres'];

    public function notas()
    {
        return $this->belongsToMany(Alumno::class, 'notas')
            ->withPivot('trimestre', 'nota');
    }
}
