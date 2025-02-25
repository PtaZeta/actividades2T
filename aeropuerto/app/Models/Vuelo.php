<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vuelo extends Model
{
    use HasFactory;

    protected $fillable = [
        'codigo', 'origen', 'destino', 'airline',
        'fecha_salida', 'fecha_llegada', 'plazas_totales', 'precio'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_vuelo')
            ->withPivot('numero_asientos')
            ->withTimestamps();
    }

    public function formatearFecha($fecha)
    {
        return Carbon::parse($fecha)->format('H:i d/m/Y');
    }

    public function total($vuelo)
    {
        return $vuelo->plazas_totales - $vuelo->users_count;
    }
}
