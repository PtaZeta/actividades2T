<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Reservas') }}
        </h2>
    </x-slot>

    <div class="container mx-auto p-6">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold text-white">Mis Reservas</h1>
        </div>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-white dark:text-gray-400">
                <thead class="text-xs uppercase bg-blue-700 text-white">
                    <tr>
                        <th scope="col" class="px-6 py-3">Vuelo</th>
                        <th scope="col" class="px-6 py-3">Origen</th>
                        <th scope="col" class="px-6 py-3">Destino</th>
                        <th scope="col" class="px-6 py-3">Salida</th>
                        <th scope="col" class="px-6 py-3">Llegada</th>
                        <th scope="col" class="px-6 py-3">Asiento</th>
                        <th scope="col" class="px-6 py-3">Precio</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($vuelos as $vuelo)
                        <tr class="bg-gray-800 border-b border-gray-700">
                            <td class="px-6 py-4">{{ $vuelo->codigo }}</td>
                            <td class="px-6 py-4">{{ $vuelo->origen }}</td>
                            <td class="px-6 py-4">{{ $vuelo->destino }}</td>
                            <td class="px-6 py-4">{{ $vuelo->fecha_salida }}</td>
                            <td class="px-6 py-4">{{ $vuelo->fecha_llegada }}</td>
                            <td class="px-6 py-4">{{ $vuelo->pivot->numero_asientos }}</td>
                            <td class="px-6 py-4">{{ $vuelo->precio }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
