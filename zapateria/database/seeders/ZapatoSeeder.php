<?php

namespace Database\Seeders;

use App\Models\Zapato;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ZapatoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Zapato::factory()->count(5)->create();
    }
}
