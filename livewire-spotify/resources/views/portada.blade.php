<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spotify</title>
    @livewireStyles
</head>
<body class="bg-gray-100">
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Álbumes') }}
            </h2>
        </x-slot>
        <div class="flex">
            <div class="container mx-auto p-6">
                <livewire:busqueda />
            </div>
        </div>


    </x-app-layout>

    @livewireScripts
</body>
</html>
