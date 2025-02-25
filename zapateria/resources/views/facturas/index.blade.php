<x-app-layout>
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Lista de Facturas</h1>

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500 border">
                <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                    <tr>
                        <th class="px-6 py-3 border">ID</th>
                        <th class="px-6 py-3 border">Fecha</th>
                        <th class="px-6 py-3 border">Total</th>
                        <th class="px-6 py-3 border">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($facturas as $factura)
                        <tr class="bg-white border-b hover:bg-gray-50">
                            <td class="px-6 py-4 border">{{ $factura->id }}</td>
                            <td class="px-6 py-4 border">{{ $factura->created_at->format('d/m/Y') }}</td>
                            <td class="px-6 py-4 border font-bold">
                                {{ number_format($factura->total, 2) }} €
                            </td>
                            <td class="px-6 py-4 flex whitespace-nowrap border">
                                <a href="{{ route('facturas.show', $factura) }}"
                                   class="text-blue-600 hover:underline">
                                    Ver factura
                                </a>

                                <form method="POST" action="{{ route('facturas.destroy', $factura) }}">
                                    @method('DELETE')
                                    @csrf
                                    <a href="{{ route('facturas.destroy', $factura) }}"
                                        class="font-medium text-red-600 dark:text-red-500 hover:underline ms-3"
                                        onclick="event.preventDefault(); if (confirm('¿Está seguro?')) this.closest('form').submit();">
                                        Eliminar
                                    </a>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
