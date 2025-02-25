<x-app-layout>
    <div class="container mx-auto p-6">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold text-white">Vuelos</h1>
            @can('create', $vuelo)
            <a href="{{ route('vuelos.create') }}" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">Crear Vuelo</a>
            @endcan
        </div>
        <div class="mt-5 relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-white dark:text-gray-400">
                <thead class="text-xs uppercase bg-blue-700 text-white">
                    <tr>
                        <th scope="col" class="px-6 py-3">Código</th>
                        <th scope="col" class="px-6 py-3">Origen</th>
                        <th scope="col" class="px-6 py-3">Destino</th>
                        <th scope="col" class="px-6 py-3">Compañía</th>
                        <th scope="col" class="px-6 py-3">Salida</th>
                        <th scope="col" class="px-6 py-3">Llegada</th>
                        <th scope="col" class="px-6 py-3">Plazas Disponibles</th>
                        <th scope="col" class="px-6 py-3">Precio</th>
                        <th scope="col" class="px-6 py-3">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($vuelos as $vuelo)
                        @if($vuelo->total($vuelo) > 0)
                        <tr class="bg-gray-800 border-b border-gray-700">
                            <td class="px-6 py-4">{{ $vuelo->codigo }}</td>
                            <td class="px-6 py-4">{{ $vuelo->origen }}</td>
                            <td class="px-6 py-4">{{ $vuelo->destino }}</td>
                            <td class="px-6 py-4">{{ $vuelo->airline }}</td>
                            {{-- @php
                                dd($vuelo->formatearFecha($vuelo->fecha_salida));
                            @endphp --}}
                            <td class="px-6 py-4">{{ $vuelo->formatearFecha($vuelo->fecha_salida) }}</td>
                            <td class="px-6 py-4">{{ $vuelo->formatearFecha($vuelo->fecha_llegada)}}</td>
                            <td class="px-6 py-4 text-center">{{ $vuelo->plazas_totales - $vuelo->users_count }}</td>
                            <td class="px-6 py-4">${{ $vuelo->precio }}</td>
                            <td class="px-6 py-4">
                                <form action="{{ route('reservas.create', $vuelo) }}" method="GET">
                                    <input type="number" name="cantidad_asientos" min="1" max="{{ $vuelo->plazas_totales - $vuelo->users_count }}" required
                                        class="w-16 p-1 rounded bg-gray-700 text-white">
                                    <button type="submit" class="text-blue-400 hover:underline">Reservar</button>
                                </form>
                            </td>
                        </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $vuelos->links() }}
        </div>
    </div>
</x-app-layout>
