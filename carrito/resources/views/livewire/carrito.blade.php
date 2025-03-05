<div>
    @if ($comprando)
        <input wire:model="codigo" type="text">
        <button wire:click="anyadirProducto()">Añadir producto a la compra</button>

        <div class="container mx-auto p-6">
            <h1 class="text-black text-3xl font-semibold mb-6">Caja Amiga</h1>
            <div class="space-y-4">
                @if (!empty($productos))
                    <h3 class="text-black">Total: {{ $total }} €</h3>
                    <aside class="flex flex-col items-center w-1/4">
                        <div class="mx-auto overflow-y-auto py-4 px-3 bg-gray-50 rounded dark:bg-gray-800">
                            <table class="mx-auto text-sm text-left text-gray-500 dark:text-gray-400">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="py-3 px-6">Descripción</th>
                                        <th scope="col" class="py-3 px-6">Código</th>
                                        <th scope="col" class="py-3 px-6">Precio</th>
                                        <th scope="col" class="py-3 px-6">Cantidad</th>
                                        <th scope="col" colspan="2" class="py-3 px-6">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($productos as $producto)
                                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                            <td class="py-4 px-6">{{ $producto->denominacion }}</td>
                                            <td class="py-4 px-6">{{ $producto->codigo }}</td>
                                            <td class="py-4 px-6">{{ $producto->precio }}</td>
                                            <td class="py-4 px-6">{{ $lineas[$producto->id] }}</td>
                                            <td class="py-4 px-6">
                                                <button wire:click="eliminarProducto({{ $producto->id }})">Eliminar</button>
                                            </td>
                                            <td class="py-4 px-6">
                                                <button wire:click="anyadirProducto({{ $producto->id }})">Añadir</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="flex mt-4">
                            <button wire:click="reiniciarCompra()">Anular compra</button>
                            <button wire:click="finalizarCompra()">Finalizar compra</button>
                        </div>
                    </aside>
                @endif
            </div>
        </div>
    @elseif (!$comprando && !$compraTerminada)
        <h2>Total a pagar: {{ $total }} €</h2>
        <input wire:model="tarjeta" type="text">
        <button wire:click="comprar">Comprar</button>
    @elseif (!$comprando && $compraTerminada)
    <button wire:click="reiniciarCompra()">Volver al inicio</button>
    @endif
</div>
