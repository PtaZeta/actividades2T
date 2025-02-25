<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Factura extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['user_id', 'created_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function zapatos()
    {
        return $this->belongsToMany(Zapato::class, 'lineas')
            ->withPivot('cantidad')
            ->withTimestamps();
    }
}
