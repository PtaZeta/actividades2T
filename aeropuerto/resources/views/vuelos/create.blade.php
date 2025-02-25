<x-app-layout>
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold text-white mb-4">Crear Vuelo</h1>
        <form action="{{ route('vuelos.store') }}" method="POST" class="bg-gray-800 p-6 rounded-lg shadow-md">
            @csrf
            <div class="mb-4">
                <label class="block text-white">Código:</label>
                <input type="text" name="codigo" required maxlength="6" class="w-full p-2 rounded bg-gray-700 text-white">
            </div>
            <div class="mb-4">
                <label class="block text-white">Origen:</label>
                <input type="text" name="origen" required maxlength="3" class="w-full p-2 rounded bg-gray-700 text-white">
            </div>
            <div class="mb-4">
                <label class="block text-white">Destino:</label>
                <input type="text" name="destino" required maxlength="3" class="w-full p-2 rounded bg-gray-700 text-white">
            </div>
            <div class="mb-4">
                <label class="block text-white">Aerolínea:</label>
                <input type="text" name="airline" required class="w-full p-2 rounded bg-gray-700 text-white">
            </div>
            <div class="mb-4">
                <label class="block text-white">Hora de salida:</label>
                <input type="datetime-local" name="fecha_salida" required class="w-full p-2 rounded bg-gray-700 text-white">
            </div>
            <div class="mb-4">
                <label class="block text-white">Hora de llegada:</label>
                <input type="datetime-local" name="fecha_llegada" required class="w-full p-2 rounded bg-gray-700 text-white">
            </div>
            <div class="mb-4">
                <label class="block text-white">Plazas Totales:</label>
                <input type="number" name="plazas_totales" required min="1" class="w-full p-2 rounded bg-gray-700 text-white">
            </div>
            <div class="mb-4">
                <label class="block text-white">Precio:</label>
                <input type="number" step="0.01" name="precio" required min="0" class="w-full p-2 rounded bg-gray-700 text-white">
            </div>
            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">Crear Vuelo</button>
        </form>
    </div>
</x-app-layout>
