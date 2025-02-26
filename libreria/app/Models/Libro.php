<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Libro extends Model
{
    /** @use HasFactory<\Database\Factories\LibroFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable =['titulo','autor'];

    public function ejemplares(){
        return $this->hasMany(Ejemplar::class);
    }
}
