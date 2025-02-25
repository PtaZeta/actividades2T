<div class="container mx-auto mt-10 p-5 bg-white shadow-md rounded-lg">
    <h1 class="text-2xl font-bold mb-4">🛒 Tu Carrito</h1>

    @if(empty($carrito))
        <p class="text-gray-500">Tu carrito está vacío.</p>
    @else
        <table class="w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border p-2">Producto</th>
                    <th class="border p-2">Precio</th>
                    <th class="border p-2">Cantidad</th>
                    <th class="border p-2">Total</th>
                    <th class="border p-2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($carrito as $id => $item)
                    <tr class="border">
                        <td class="border p-2">{{ $item['denominacion'] }}</td>
                        <td class="border p-2">{{ $item['precio'] }} €</td>
                        <td class="border p-2">{{ $item['cantidad'] }}</td>
                        <td class="border p-2">{{ number_format($item['precio'] * $item['cantidad'], 2) }} €</td>
                        <td class="border p-2">
                            <button wire:click="incrementarCantidad({{ $id }})"
                                class="px-3 py-2 bg-green-600 text-white font-bold rounded-lg shadow-md
                                    hover:bg-green-700 transition-all duration-200 ease-in-out
                                    active:scale-95">
                                +
                            </button>

                            <button wire:click="decrementarCantidad({{ $id }})"
                                class="px-3 py-2 bg-red-600 text-white font-bold rounded-lg shadow-md
                                    hover:bg-red-700 transition-all duration-200 ease-in-out
                                    active:scale-95">
                                -
                            </button>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <p class="text-xl font-bold mt-4">Total: {{ number_format($total, 2) }} €</p>

        <button wire:click="vaciarCarrito" class="mt-4 px-4 py-2 bg-gray-700 text-white rounded">
            Vaciar carrito
        </button>

        <button wire:click="realizarPedido" class="mt-4 px-4 py-2 bg-green-700 text-white rounded">
            Realizar pedido
        </button>
    @endif
</div>
