<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zapato extends Model
{
    use HasFactory;

    protected $fillable = ['codigo', 'denominacion', 'precio'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'carritos')
            ->withPivot('cantidad')
            ->withTimestamps();
    }

    public function facturas()
    {
        return $this->belongsToMany(Factura::class, 'lineas')
            ->withPivot('cantidad')
            ->withTimestamps();
    }
}
