<div class="bg-white dark:bg-gray-800 shadow overflow-hidden sm:rounded-lg mb-4 relative">
    <div class="px-4 py-5 sm:px-6 flex justify-between items-center">
        <div>
            <h3 class="text-lg font-medium text-gray-900 dark:text-white">{{ $producto->denominacion }}</h3>
            <p class="mt-1 max-w-2xl text-sm text-gray-500 dark:text-gray-400">
                Código: {{ $producto->codigo }}
            </p>
            <p class="mt-1 max-w-2xl text-sm text-gray-500 dark:text-gray-400">
                Precio: {{ $producto->precio }}
            </p>
        </div>

        <form action="{{ route('productos.destroy', $producto->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este producto?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg">
                Eliminar
            </button>
        </form>
    </div>
</div>
