<div>
    <div class="mb-4">
        <label for="videojuegoId" class="block text-sm font-medium text-black">Videojuego:</label>
        <select wire:model.live="videojuegoId"
           class="w-50 p-2 bg-gray-700 border border-gray-600 text-white rounded focus:ring focus:ring-green-400">
           <option value="" disabled selected>Seleccione un trimestre</option>
           @foreach($videojuegos as $videojuego)
               <option value="{{ $videojuego->id }}">{{ $videojuego->titulo }}</option>
           @endforeach
        </select>
        <button wire:click='lotengo' class="mt-5 px-5 py-2 bg-yellow-500 hover:bg-yellow-600 text-white font-semibold rounded-lg transition duration-200">
            Lo tengo
        </button>
        <button wire:click='nolotengo' class="mt-5 px-5 py-2 bg-yellow-500 hover:bg-yellow-600 text-white font-semibold rounded-lg transition duration-200">
            No lo tengo
        </button>
   </div>
</div>
