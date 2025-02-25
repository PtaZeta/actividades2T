<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detalles de la asignatura
        </h2>
    </x-slot>

    <div class="max-w-lg mx-auto bg-white p-6 shadow-lg rounded-lg">
        <h3 class="text-2xl font-bold mb-4">{{ $asignatura->denominacion }}</h3>
        <p class="text-gray-700">Número de trimestres: {{ $asignatura->numero_trimestres }}</p>
        <p class="text-gray-700">Fecha de creación: {{ $asignatura->created_at }}</p>
        <a href="{{ route('asignaturas.index') }}" class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded">Volver</a>
    </div>
</x-app-layout>
