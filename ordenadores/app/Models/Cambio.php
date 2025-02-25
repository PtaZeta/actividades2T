<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cambio extends Model
{
    /** @use HasFactory<\Database\Factories\CambioFactory> */
    use HasFactory;

    protected $fillable = ['ordenador_id', 'origen_id', 'destino_id'];


    public function origen()
    {
        return $this->belongsTo(Aula::class, 'origen_id');
    }

    public function destino()
    {
        return $this->belongsTo(Aula::class, 'destino_id');
    }

}
