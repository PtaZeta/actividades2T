<div>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <input type="date" wire:model.live="fechaInicio" id="fecha_inicio" class="border rounded p-2">
                        <input type="date" wire:model.live="fechaFin" id="fecha_fin" class="border rounded p-2">

                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 mt-4">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th wire:click="ordenar('nombre')" scope="col" class="px-6 py-3">
                                        Nombre {{ $campoOrdenar === 'nombre' ? ($direccionOrdenar === 'asc' ? '↑' : '↓') : '' }}
                                    </th>
                                    <th wire:click="ordenar('fecha_inicio')" scope="col" class="px-6 py-3">
                                        Fecha inicio {{ $campoOrdenar === 'fecha_inicio' ? ($direccionOrdenar === 'asc' ? '↑' : '↓') : '' }}
                                    </th>
                                    <th wire:click="ordenar('fecha_fin')" scope="col" class="px-6 py-3">
                                        Fecha fin {{ $campoOrdenar === 'fecha_fin' ? ($direccionOrdenar === 'asc' ? '↑' : '↓') : '' }}
                                    </th>
                                    <th scope="col" class="px-6 py-3">Estado</th>
                                    <th scope="col" class="px-6 py-3">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($eventos as $evento)
                                    <tr>
                                        <td class="px-6 py-4"><a href="{{route('eventos.show', $evento)}}">{{ $evento->nombre }}</a></td>
                                        <td class="px-6 py-4">{{ $evento->formatearFecha($evento->fecha_inicio) }}</td>
                                        <td class="px-6 py-4">{{ $evento->formatearFecha($evento->fecha_fin) }}</td>
                                        <td class="px-6 py-4">{{ $evento->eventoTerminado() }}</td>
                                        <td class="px-6 py-4 flex items-center">
                                            <a href="{{ route('eventos.edit', $evento) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Editar</a>
                                            <form method="POST" action="{{ route('eventos.destroy', $evento) }}">
                                                @method('DELETE')
                                                @csrf
                                                <a href="{{ route('eventos.destroy', $evento) }}"
                                                    class="font-medium text-red-600 dark:text-red-500 hover:underline ms-3"
                                                    onclick="event.preventDefault(); if (confirm('¿Está seguro?')) this.closest('form').submit();">
                                                    Eliminar
                                                </a>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-6 text-center">
                        <a href="{{ route('eventos.create') }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                            Crear un nuevo evento
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
