<?php

namespace Database\Factories;

use App\Models\Aula;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ordenador>
 */
class OrdenadorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'modelo' => fake()->name(),
            'marca' => fake()->name(),
            'aula_id' => Aula::inRandomOrder()->first()->id ?? Aula::factory(),
        ];
    }
}
