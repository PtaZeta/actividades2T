<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Zapato>
 */
class ZapatoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'codigo' => $this->faker->unique()->ean13(),
            'denominacion' => $this->faker->words(3, true),
            'precio' => $this->faker->randomFloat(2, 10, 500),
        ];
    }
}
