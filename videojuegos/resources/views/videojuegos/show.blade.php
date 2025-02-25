<x-app-layout>
    <div x-data="{ open: false }" class="p-6 bg-gray-900 min-h-screen text-white">
        <h3 class="text-2xl font-bold mb-4">Titulo: {{ $videojuego->titulo }}</h3>
        <p class="text-gray-700">Año: {{ $videojuego->anyo }}</p>
        <p class="text-gray-700">Desarroladora: {{ $videojuego->desarrolladora->nombre }}</p>
        <p class="text-gray-700">Distribuidora: {{ $videojuego->desarrolladora->distribuidora->nombre }}</p>
        <a href="{{ route('videojuegos.index') }}" class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded">Volver</a>
    </div>
</x-app-layout>
