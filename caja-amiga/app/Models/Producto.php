<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Gate;


class Producto extends Model
{
    /** @use HasFactory<\Database\Factories\ProductoFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = ['codigo', 'denominacion', 'precio'];


    public function tickets()
    {
        return $this->belongsToMany(Ticket::class, 'lineas');
    }
}
