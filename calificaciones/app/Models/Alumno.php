<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    /** @use HasFactory<\Database\Factories\AlumnoFactory> */
    use HasFactory;

    protected $fillable = ['nombre'];

    public function notas()
    {
        return $this->belongsToMany(Asignatura::class, 'notas')
            ->withPivot('trimestre', 'nota');
    }

    public function notaTrimestre(int $asignatura, string $trimestre){

        $nota = Nota::where('alumno_id', $this->id)
        ->where('asignatura_id', $asignatura)
        ->where('trimestre', $trimestre);

        if($nota->first() == null){
            return "No procede";
        } else{
            return $nota->first()->nota;
        }
    }

    public function notaFinal(int $asignatura){

        $notaFinal = 0;


        $notas = Nota::where('alumno_id', $this->id)
        ->where('asignatura_id', $asignatura)->get();

        foreach($notas as $nota){

            $notaFinal += intval($nota->nota);
        }

        if($notas->count() == 0){
            return "No procede";
        }

        return $notaFinal/$notas->count();
    }

}
