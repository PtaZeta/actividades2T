<div x-data="{ open: false }" class="p-6 bg-gray-900 min-h-screen text-white">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            Asignaturas
        </h2>
    </x-slot>

    <!-- Formulario de CREAR -->
    @if (!$estaEditando)
        <div class="max-w-lg mx-auto bg-gray-800 p-6 rounded-lg shadow-lg">
            <form wire:submit.prevent="crear">
                <div class="mb-4">
                    <label for="denominacion" class="block text-sm font-medium text-gray-300">Denominacion:</label>
                    <input wire:model="denominacion" type="text" id="denominacion" name="denominacion"
                        class="mt-1 block w-full rounded-md text-black border-gray-600 bg-gray-700  shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                </div>
                <div class="mb-4">
                    <label for="numero_trimestres" class="block text-sm font-medium text-gray-300">Número de trimestres:</label>
                    <input wire:model="numero_trimestres" type="text" id="numero_trimestres" name="numero_trimestres"
                        class="mt-1 block w-full rounded-md text-black border-gray-600 bg-gray-700  shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                </div>
                <div class="flex justify-between">
                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition duration-200">
                        Crear
                    </button>
                </div>
            </form>
        </div>
    @endif

    <!-- Formulario de EDITAR -->
    @if ($estaEditando)
        <div class="max-w-lg mx-auto bg-gray-800 p-6 rounded-lg shadow-lg">
            <form wire:submit.prevent="actualizar">
                <div class="mb-4">
                    <label for="denominacion" class="block text-sm font-medium text-gray-300">Editar denominacion:</label>
                    <input wire:model="denominacion" type="text" id="denominacion" name="denominacion"
                        class="mt-1 block w-full rounded-md text-black border-gray-600 bg-gray- shadow-sm focus:border-yellow-500 focus:ring focus:ring-yellow-500 focus:ring-opacity-50">
                </div>
                <div class="mb-4">
                    <label for="numero_trimestres" class="block text-sm font-medium text-gray-300">Editar numero de trimestres:</label>
                    <input wire:model="numero_trimestres" type="text" id="numero_trimestres" name="numero_trimestres"
                        class="mt-1 block w-full rounded-md text-black border-gray-600 bg-gray- shadow-sm focus:border-yellow-500 focus:ring focus:ring-yellow-500 focus:ring-opacity-50">
                </div>
                <div class="flex justify-between">
                    <button type="submit"
                        class="px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white font-semibold rounded-lg transition duration-200">
                        Guardar cambios
                    </button>
                    <button wire:click.prevent="cancelar"
                        class="px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white font-semibold rounded-lg transition duration-200">
                        Cancelar
                    </button>
                </div>
            </form>
        </div>
    @endif

    <!-- Tabla -->
    <div class="mt-6 max-w-3xl mx-auto bg-gray-800 p-4 rounded-lg shadow-lg">
        <table class="w-full text-left text-gray-300">
            <thead class="bg-gray-700 text-gray-200 uppercase">
                <tr>
                    <th class="px-4 py-2">Denominación</th>
                    <th class="px-4 py-2">Número de trimestres</th>
                    <th class="px-4 py-2 text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($asignaturas as $asignatura)
                <tr class="border-b border-gray-700 hover:bg-gray-700">
                    <td class="px-4 py-2">
                        <a href="#" wire:click="ver({{ $asignatura->id }})" class="bg-green-500 text-white px-2 py-1 rounded cursor-pointer">
                            {{ $asignatura->denominacion}}
                        </a>
                    </td>
                    <td class="px-4 py-2 text-center">{{ $asignatura->numero_trimestres}}</td>
                    <td class="px-4 py-2 flex justify-center space-x-2">
                        <button wire:click="editar({{ $asignatura->id }})"
                            class="px-3 py-1 bg-yellow-500 hover:bg-yellow-600 text-white font-medium rounded transition">
                            Editar
                        </button>
                        @if (!$estaEditando)
                        <button wire:click="eliminar({{ $asignatura->id }})"
                            class="px-3 py-1 bg-red-500 hover:bg-red-600 text-white font-medium rounded transition">
                            Eliminar
                        </button>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
