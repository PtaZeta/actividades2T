<x-app-layout>
    <div class="max-w-4xl mx-auto p-6 bg-gray-800 rounded-lg shadow-lg">
        <h1 class="text-3xl font-semibold text-white mb-6 text-center">Confirmación de Compra</h1>

        <h2 class="text-xl font-semibold text-white mb-4">Productos en tu carrito:</h2>

        <table class="min-w-full bg-gray-700 text-white rounded-lg shadow-md">
            <thead>
                <tr class="border-b border-gray-600">
                    <th class="py-3 px-6 text-left">Descripción</th>
                    <th class="py-3 px-6 text-left">Código</th>
                    <th class="py-3 px-6 text-left">Precio</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($carrito->getLineas() as $linea)
                    <tr class="border-b border-gray-600">
                        <td class="py-4 px-6">{{ $linea->getProducto()->denominacion }}</td>
                        <td class="py-4 px-6">{{ $linea->getProducto()->codigo }}</td>
                        <td class="py-4 px-6">{{ $linea->getProducto()->precio }} €</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <h3 class="text-2xl font-semibold text-white mt-6">Total: <span class="text-green-400">{{ $carrito->getTotal() }} €</span></h3>

        <form method="POST" action="{{ route('comprar') }}" class="mt-8">
            @csrf
            <div class="mb-4">
                <label for="tarjeta" class="block text-sm font-medium text-white mb-2">Número de tarjeta</label>
                <input type="text" name="tarjeta" id="tarjeta" class="w-full px-4 py-3 border border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 text-gray-800" required>
            </div>

            <button type="submit" class="w-full py-3 bg-green-700 hover:bg-green-800 text-white font-semibold rounded-lg focus:ring-4 focus:ring-green-300">
                Comprar
            </button>
        </form>
    </div>
</x-app-layout>
