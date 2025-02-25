<div>
    <input type="text" wire:model.live="buscar" placeholder="Buscar álbumes por título" class="p-2 border rounded">
    <select wire:model.live="campoBusqueda" class="mb-4 px-4 py-2 border border-gray-300 rounded-lg">
        <option value="nombre">Nombre</option>
        <option value="cancion">Cancion</option>
        <option value="user">Usuario</option>
    </select>
    <a href="{{ route('albumes.create') }}" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">Crear álbum</a>
    <div class="mt-5 grid grid-cols-3 gap-6">
        @foreach($albumes as $album)
            <x-album :album="$album" :buscar="$buscar" />
        @endforeach
    </div>
    <div class="mt-4">
        {{ $albumes->links() }}
    </div>
</div>
