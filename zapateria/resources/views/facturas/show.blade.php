<x-app-layout>
    <div class="container mx-auto p-6">
        <!-- Tarjeta de Factura -->
        <div class="bg-white shadow rounded-lg p-6">
            <h1 class="text-2xl font-bold mb-4">Factura #{{ $factura->id }}</h1>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
                <div>
                    <p class="text-gray-600"><span class="font-semibold">Fecha:</span> {{ $factura->created_at->format('d/m/Y H:i') }}</p>
                    <!-- Si tienes cliente -->
                    @if($factura->cliente)
                        <p class="text-gray-600"><span class="font-semibold">Cliente:</span> {{ $factura->user->name }}</p>
                    @endif
                </div>
            </div>

            <!-- Tabla de líneas -->
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                        <tr>
                            <th scope="col" class="px-6 py-3">Zapato</th>
                            <th scope="col" class="px-6 py-3">Cantidad</th>
                            <th scope="col" class="px-6 py-3">Precio Unitario</th>
                            <th scope="col" class="px-6 py-3">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($factura->zapatos as $zapato)
                        <tr class="bg-white border-b hover:bg-gray-50">
                            <td class="px-6 py-4">
                                {{ $zapato->denominacion }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $zapato->pivot->cantidad }}
                            </td>
                            <td class="px-6 py-4">
                                {{ number_format($zapato->precio, 2) }} € {{-- Precio unitario desde lineas --}}
                            </td>
                            <td class="px-6 py-4">
                                {{ number_format($zapato->pivot->cantidad * $zapato->precio, 2) }} €
                            </td>
                        </tr>

                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="bg-gray-200 font-bold">
                            <td colspan="3" class="px-6 py-4 text-right">Total:</td>
                            <td class="px-6 py-4">{{ number_format($totalFactura, 2) }} €</td>
                        </tr>
                    </tfoot>

                </table>
            </div>

            <!-- Botón para regresar o imprimir -->
            <div class="mt-6 flex justify-end space-x-4">
                <a href="{{ route('facturas.index') }}" class="text-white bg-gray-500 hover:bg-gray-600 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                    Volver
                </a>
                {{-- <button onclick="window.print()" class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                    Imprimir
                </button> --}}
            </div>
        </div>
    </div>
</x-app-layout>
