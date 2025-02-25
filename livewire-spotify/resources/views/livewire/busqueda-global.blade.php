<div class="p-4">
    <input type="text" wire:model.live="buscar"
           placeholder="Buscar álbumes, canciones o artistas..."
           class="w-full p-2 border rounded">

    <div class="mt-4">
        @if (!empty($buscar))
            <h3 class="font-semibold text-xl text-gray-800 dark:text-gray-200">
                Resultados para: "{{ $buscar }}"
            </h3>
        @endif

        @if ($albumes->isNotEmpty())
            <h4 class="mt-4 font-semibold text-lg text-gray-800 dark:text-gray-200">Álbumes:</h4>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-6 mt-2">
                @foreach ($albumes as $album)
                    <x-album :album="$album" />
                @endforeach
            </div>
        @endif

        @if ($canciones->isNotEmpty())
            <h4 class="mt-4 font-semibold text-lg text-gray-800 dark:text-gray-200">Canciones:</h4>
            <div class="flex flex-col space-y-4 mt-2">
                @foreach ($canciones as $cancion)
                    <x-cancion :cancion="$cancion" />
                @endforeach
            </div>
        @endif


        @if ($artistas->isNotEmpty())
            <h4 class="mt-4 font-semibold text-lg text-gray-800 dark:text-gray-200">Artistas:</h4>
            <div class="grid grid-cols-5 gap-6 mt-2">
                @foreach ($artistas as $artista)
                    <x-artista :artista="$artista" />
                @endforeach
            </div>
        @endif


        @if ($albumes->isEmpty() && $canciones->isEmpty() && $artistas->isEmpty() && !empty($buscar))
            <p class="text-gray-500 mt-4">No se encontraron resultados.</p>
        @endif
    </div>
</div>
