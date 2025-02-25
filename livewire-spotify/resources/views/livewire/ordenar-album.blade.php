<div>
    <h4 class="text-lg font-semibold text-gray-900">Ordenar canciones:</h4>
    <div class="flex space-x-2 mb-4">
        <button wire:click="ordenar('titulo')" class="bg-gray-200 px-2 py-1 rounded">
            Nombre {{ $campoOrdenar === 'titulo' ? ($direccionOrdenar === 'asc' ? '↑' : '↓') : '' }}
        </button>
        <button wire:click="ordenar('duracion')" class="bg-gray-200 px-2 py-1 rounded">
            Duración {{ $campoOrdenar === 'duracion' ? ($direccionOrdenar === 'asc' ? '↑' : '↓') : '' }}
        </button>
    </div>

    <ul>
        @foreach ($canciones as $cancion)
            <li class="mt-4">
                <div class="text-gray-800 font-semibold">{{ $cancion->titulo }}</div>
                <div class="text-gray-600">Duración: {{ $cancion->duracion }}</div>
            </li>
        @endforeach
    </ul>

    <div class="mt-4">
        {{ $canciones->links() }}
    </div>
</div>
