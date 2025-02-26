<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editar evento
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('eventos.update', $evento) }}" class="max-w-sm mx-auto">
                @method('PUT')
                @csrf
                <div class="mb-5">
                    <x-input-label for="nombre" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Nombre
                    </x-input-label>
                    <x-text-input name="nombre" type="text" id="nombre" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        :value="old('nombre', $evento->nombre)" />
                    <x-input-error :messages="$errors->get('nombre')" class="mt-2" />
                </div>
                <div class="mb-5">
                    <x-input-label for="fecha_inicio" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Fecha inicio
                    </x-input-label>
                    <x-text-input name="fecha_inicio" type="text" id="fecha_inicio" placeholder='Formato: Y-m-d H:i:s' class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        :value="old('fecha_inicio', $evento->fecha_inicio)" />
                    <x-input-error :messages="$errors->get('fecha_inicio')" class="mt-2" />
                </div>
                <div class="mb-5">
                    <x-input-label for="fecha_fin" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Fecha fin
                    </x-input-label>
                    <x-text-input name="fecha_fin" type="text" id="fecha_fin" placeholder='Formato: Y-m-d H:i:s' class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        :value="old('fecha_fin', $evento->fecha_fin)" />
                    <x-input-error :messages="$errors->get('fecha_fin')" class="mt-2" />
                </div>
                <div class="mb-5">
                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Editar
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
