<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vuelo>
 */
class VueloFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'codigo' => strtoupper(fake()->randomLetter()) . strtoupper(fake()->randomLetter()) . fake()->randomNumber(4, true),
            'origen' => strtoupper(fake()->lexify('???')), // Genera un código IATA de 3 letras aleatorias
            'destino' => strtoupper(fake()->lexify('???')),
            'airline' => fake()->company(),
            'fecha_salida' => fake()->dateTimeBetween('+1 days', '+1 month'),
            'fecha_llegada' => fake()->dateTimeBetween('+1 days', '+1 month'),
            'plazas_totales' => fake()->numberBetween(50, 300),
            'precio' => fake()->randomFloat(2, 50, 1000),
        ];
    }
}
