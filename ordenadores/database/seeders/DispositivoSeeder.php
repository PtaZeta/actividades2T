<?php

namespace Database\Seeders;

use App\Models\Dispositivo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DispositivoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Dispositivo::factory(10)->create();
    }
}
