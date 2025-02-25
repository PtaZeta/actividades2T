<div>
    <h1 class="text-2xl font-bold mb-4">Lista de Zapatos</h1>

    <table class="w-full border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-200">
                <th class="border p-2">Código</th>
                <th class="border p-2">Denominación</th>
                <th class="border p-2">Precio</th>
                <th class="border p-2">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($zapatos as $zapato)
                <tr class="border">
                    <td class="border p-2">{{ $zapato->codigo }}</td>
                    <td class="border p-2">{{ $zapato->denominacion }}</td>
                    <td class="border p-2">{{ $zapato->precio }} €</td>
                    <td class="border p-2">
                        <button wire:click="añadirAlCarrito({{ $zapato->id }})"
                            class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow-md transition duration-300 ease-in-out transform hover:scale-105">
                            🛒 Añadir al carrito
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
