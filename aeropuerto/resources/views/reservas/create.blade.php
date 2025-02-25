<x-app-layout>
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold text-white">Reservar Vuelo {{ $vuelo->codigo }}</h1>
        <div class="bg-gray-800 p-6 rounded-lg shadow-md">
            <form method="POST" action="{{ route('reservas.store', $vuelo) }}">
                @csrf
                <p class="text-white">Seleccionaste {{ request('cantidad_asientos') }} asiento(s).</p>
                {{-- @php
                                dump($asientosLibres);
                            @endphp --}}
                @for ($i = 1; $i <= request('cantidad_asientos'); $i++)
                    <div class="mb-4">
                        <label class="block text-white">Asiento {{ $i }}:</label>
                        <select name="asientos[]" class="w-full p-2 rounded bg-gray-700 text-white">

                            @foreach ($asientosLibres as $asiento)
                                <option value="{{ $asiento }}">{{ $asiento }}</option>
                            @endforeach
                        </select>
                    </div>
                @endfor

                @error('asientos')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
                @if ($errors->has('asientos.*'))
                    @foreach ($errors->get('asientos.*') as $error)
                        <p class="text-red-500 text-sm mt-1">{{ $error[0] }}</p>
                    @endforeach
                @endif
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">Reservar</button>
            </form>
        </div>
    </div>
</x-app-layout>
