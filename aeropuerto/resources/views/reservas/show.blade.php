<x-app-layout>
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold text-white">Detalles de la Reserva</h1>
        <div class="bg-gray-800 p-6 rounded-lg shadow-md text-white">
            <p><strong>Vuelo:</strong> {{ $reserva->vuelo->codigo }}</p>
            <p><strong>Origen:</strong> {{ $reserva->vuelo->origen }}</p>
            <p><strong>Destino:</strong> {{ $reserva->vuelo->destino }}</p>
            <p><strong>Fecha de Salida:</strong> {{ $reserva->vuelo->fecha_salida }}</p>
            <p><strong>Fecha de Llegada:</strong> {{ $reserva->vuelo->fecha_llegada }}</p>
            <p><strong>Asientos Reservados:</strong> {{ $reserva->numero_asientos }}</p>
            <p><strong>Precio Total:</strong> ${{ $reserva->precio_total }}</p>

            <a href="{{ route('reservas.index') }}" class="text-blue-400 hover:underline">Volver</a>
        </div>
    </div>
</x-app-layout>
