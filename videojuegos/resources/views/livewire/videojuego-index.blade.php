<div>
    <div x-data="{ open: false }" class="p-6 bg-gray-900 min-h-screen text-white">
            <div class="max-w-lg mx-auto bg-gray-800 p-6 rounded-lg shadow-lg">
                <form wire:submit="{{ $estaEditando ? 'actualizar' : 'crear' }}"">
                    <h2>{{ $estaEditando ? 'Actualizar' : 'Crear'}} un videojuego</h2>
                    <div class="mb-4">
                        <label for="titulo" class="block text-sm font-medium text-gray-300">Titulo:</label>
                        <input wire:model="titulo" type="text" id="titulo" name="titulo"
                            class="mt-1 block w-full rounded-md text-white border-gray-600 bg-gray-700  shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                        @error('titulo') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-4">
                        <label for="anyo" class="block text-sm font-medium text-gray-300">Año:</label>
                        <input wire:model="anyo" type="text" id="anyo" name="anyo"
                            class="mt-1 block w-full rounded-md text-white border-gray-600 bg-gray-700  shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                    </div>
                    <div class="mb-4">
                         <label for="distribuidora_id" class="block text-sm font-medium text-gray-300">Distribuidora:</label>
                        <select wire:model.live="distribuidora_id"
                            class="w-full p-2 bg-gray-700 border border-gray-600 text-white rounded focus:ring focus:ring-green-400">
                            <option value="" >Seleccione una distribuidora</option>

                            @foreach($distribuidoras as $distribuidora)
                                <option value="{{ $distribuidora->id }}">{{ $distribuidora->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="desarrolladora_id" class="block text-sm font-medium text-gray-300">Desarrolladora:</label>
                        <select wire:model="desarrolladora_id"
                        class="w-full p-2 bg-gray-700 border border-gray-600 text-white rounded focus:ring focus:ring-green-400">
                            <option value="">Seleccione una Desarrolladora</option>
                            @foreach($desarrolladorasFiltradas as $desarrolladora)
                                <option value="{{ $desarrolladora->id }}"  {{ $estaEditando ? ($desarrolladora->id == $videojuego->desarrolladora->id ? 'selected' : '') : ''}}
                                    @if($desarrolladora->id == $desarrolladora_id) selected @endif>
                                    {{ $desarrolladora->nombre }}
                                </option>
                            @endforeach
                        </select>

                    </div>

                    <button type="submit"
                    class="mt-5 px-5 py-2 bg-yellow-500 hover:bg-yellow-600 text-white font-semibold rounded-lg transition duration-200">
                    Crear
                    </button>
                    @if ($estaEditando)
                        <button wire:click.prevent='cancelar'
                        class="mt-5 px-5 py-2 bg-gray-500 hover:bg-gray-600 text-white font-semibold rounded-lg transition duration-200">
                        Volver
                        </button>
                    @endif
                </form>
            </div>

        <!-- Tabla -->
        <div class="mt-6 max-w-3xl mx-auto bg-gray-800 p-4 rounded-lg shadow-lg">
            <table class="w-full text-left text-gray-300">
                <thead class="bg-gray-700 text-gray-200 uppercase">
                    <tr>
                        <th wire:click="ordenar('titulo')" class="cursor-pointer px-4 py-2">
                            Título {{ $campoOrdenar === 'titulo' ? ($direccionOrdenar === 'asc' ? '↑' : '↓') : '' }}
                        </th>
                        <th wire:click="ordenar('anyo')" class="cursor-pointer px-4 py-2">
                            Año {{ $campoOrdenar === 'anyo' ? ($direccionOrdenar === 'asc' ? '↑' : '↓') : '' }}
                        </th>
                        <th wire:click="ordenar('desarrolladoras.nombre')" class="cursor-pointer px-4 py-2">Desarrolladora {{ $campoOrdenar === 'desarrolladoras.nombre' ? ($direccionOrdenar === 'asc' ? '↑' : '↓') : '' }}</th>
                        <th wire:click="ordenar('distribuidoras.nombre')" class="cursor-pointer px-4 py-2">Distribuidora {{ $campoOrdenar === 'distribuidoras.nombre' ? ($direccionOrdenar === 'asc' ? '↑' : '↓') : '' }}</th>
                        <th class="px-4 py-2">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($videojuegos as $videojuego)
                        <tr class="border-b border-gray-700 hover:bg-gray-700">
                            <td class="px-4 py-2"><a class="cursor-pointer" wire:click='ver({{$videojuego->id}})'>{{ $videojuego->titulo}}</a></td>
                            <td class="px-4 py-2">{{ $videojuego->anyo}}</td>
                            <td class="px-4 py-2">{{ $videojuego->desarrolladora->nombre}}</td>
                            <td class="px-4 py-2">{{ $videojuego->desarrolladora->distribuidora->nombre}}</td>
                            <td class="px-4 py-2 flex gap-2">
                                <button wire:click='editar({{$videojuego->id}})' class="px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white font-medium rounded transition">
                                    Editar
                                </button>
                                <form wire:submit.prevent="eliminar">
                                    <button wire:click="eliminar({{ $videojuego->id }})"
                                        type="button"
                                        class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white font-medium rounded transition">
                                        Eliminar
                                    </button>
                                </form>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-4">
                {{ $videojuegos->links() }}
            </div>
    </div>
</div>
