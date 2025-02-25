<x-app-layout>
    <div class="py-6">
        <form method="POST" action="{{ route('productos.store') }}" class="max-w-sm mx-auto" enctype="multipart/form-data">
            @csrf

            <div class="mb-5">
                <x-input-label for="codigo" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    Código
                </x-input-label>
                <x-text-input name="codigo" type="number" id="codigo"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    {{-- :value="old('codigo')" --}} />
                <x-input-error :messages="$errors->get('codigo')" class="mt-2" />
            </div>


            <div class="mb-5">
                <x-input-label for="denominacion" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    Denominación
                </x-input-label>
                <x-text-input name="denominacion" type="text" id="denominacion"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    {{-- :value="old('denominacion')" --}} />
                <x-input-error :messages="$errors->get('denominacion')" class="mt-2" />
            </div>

            <div class="mb-5">
                <x-input-label for="precio" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    Precio
                </x-input-label>
                <x-text-input name="precio" type="text" id="precio"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    {{-- :value="old('precio')" --}} />
                <x-input-error :messages="$errors->get('precio')" class="mt-2" />
            </div>

            <!-- Botón de envío -->
            <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Crear
            </button>
        </form>
        <div class="mt-5 max-w-2xl mx-auto sm:px-6 lg:px-8">
            @foreach($productos as $producto)
                <x-producto :producto="$producto" />
            @endforeach
        </div>
    </div>
</x-app-layout>
