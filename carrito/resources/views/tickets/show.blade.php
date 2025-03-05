<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Ver ticket
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <dl class="max-w-md text-gray-900 divide-y divide-gray-200 dark:text-white dark:divide-gray-700">
                        <div class="flex flex-col pb-3">
                            <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">
                                Tarjeta
                            </dt>
                            <dd class="text-lg font-semibold">
                                {{ $ticket->tarjeta }}
                            </dd>
                        </div>
                    </dl>
                </div>
            </div>

            <div class="relative overflow-x-auto mt-10">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Producto
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Cantidad
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Precio/Unidad
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ticket->productos as $producto)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $producto->denominacion }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $producto->pivot->cantidad }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $producto->precio }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <h2 class="mt-5 font-semibold text-xl text-gray-800 leading-tight">
                    Total: {{ $ticket->getTotal() }} €
                </h2>
            </div>

        </div>
    </div>
</x-app-layout>
