<?php

use App\Models\User;
use App\Models\Vuelo;

test('Crear vuelo', function() {
    $usuario = User::factory()->create([
        'name' => 'admin',
    ]);

    $vueloData = Vuelo::factory()->make()->toArray();

    $response = $this->actingAs($usuario)
                     ->from('/vuelos/create')
                     ->post('/vuelos',
                        // 'codigo' => 'MD3212',
                        // 'origen' => 'JXR',
                        // 'destino' => 'BCN',
                        // 'airline' => 'Maricones Army',
                        // 'fecha_salida' => '2025-02-28 04:47',
                        // 'fecha_llegada' => '2025-03-1 02:47',
                        // 'plazas_totales' => 23,
                        // 'precio' => 200,
                        $vueloData,
                     );

    $this->assertAuthenticated();
    $response->assertSessionHasNoErrors();

});
