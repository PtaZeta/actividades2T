<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('vuelos', function (Blueprint $table) {
        $table->id();
        $table->string('codigo')->unique();
        $table->string('origen', 3);
        $table->string('destino', 3);
        $table->string('airline');
        $table->dateTime('fecha_salida');
        $table->dateTime('fecha_llegada');
        $table->integer('plazas_totales');
        $table->decimal('precio', 8, 2);
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vuelos');
    }
};
