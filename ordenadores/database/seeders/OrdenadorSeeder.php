<?php

namespace Database\Seeders;

use App\Models\Ordenador;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrdenadorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Ordenador::factory(10)->create();
    }
}
