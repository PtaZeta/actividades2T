<x-app-layout>
    <div class="container mx-auto p-6">
        <h1 class="text-white text-3xl font-semibold mb-6">Caja Amiga</h1>
        <div class="space-y-4">
            @if (session('error'))
                <div class="bg-red-500 text-white p-2 rounded">
                    {{ session('error') }}
                </div>
            @endif

            <form method="POST" action="{{ route('carrito.meter') }}" class="flex items-center space-x-4">
                @csrf
                <label for="codigo_producto" class="text-lg text-white">Código del Producto:</label>
                <input type="text" name="codigo_producto" id="codigo_producto" class="rounded-lg input input-bordered w-80 text-gray-800" placeholder="Ingrese el código del producto" required>
                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-900">
                    Agregar
                </button>
            </form>

            @if (!$carrito->vacio())
            <h3 class="text-white">Total: {{ $carrito->getTotal() }} €</h3>
                <aside class="flex flex-col items-center w-1/4">
                    <div class="mx-auto overflow-y-auto py-4 px-3 bg-gray-50 rounded dark:bg-gray-800">
                        <table class="mx-auto text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="py-3 px-6">Descripción</th>
                                    <th scope="col" class="py-3 px-6">Código</th>
                                    <th scope="col" class="py-3 px-6">Precio</th>
                                    <th scope="col" class="py-3 px-6">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($carrito->getLineas() as $id => $linea)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <td class="py-4 px-6">{{ $linea->getProducto()->denominacion }}</td>
                                        <td class="py-4 px-6">{{ $linea->getProducto()->codigo }}</td>
                                        <td class="py-4 px-6">{{ $linea->getProducto()->precio }}</td>
                                        <td class="py-4 px-6">
                                            <a href="{{ route('carrito.sacar', $linea->getProducto()) }}" class="inline-flex items-center py-1 px-2.5 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                                Sacar
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="flex mt-4">
                        <a href="{{ route('carrito.vaciar') }}" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                            Anular compra
                        </a>
                        <form method="GET" action="{{ route('pago') }}" class="ml-2">
                            <button type="submit" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-900">
                                Finalizar compra
                            </button>
                        </form>
                    </div>
                </aside>
            @endif
        </div>
    </div>
</x-app-layout>
