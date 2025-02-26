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
        $fecha_salida = fake()->dateTimeBetween('+1 days', '+1 month');
        return [
            'codigo' => strtoupper(fake()->randomLetter()) . strtoupper(fake()->randomLetter()) . fake()->randomNumber(4, true),
            'origen' => strtoupper(fake()->lexify('???')),
            'destino' => strtoupper(fake()->lexify('???')),
            'airline' => fake()->company(),
            'fecha_salida' => $fecha_salida,
            'fecha_llegada' => fake()->dateTimeBetween($fecha_salida, (clone $fecha_salida)->modify('+5 month')),
            'plazas_totales' => fake()->numberBetween(50, 300),
            'precio' => fake()->randomFloat(2, 50, 1000),
        ];
    }
}
