<div class="p-6 bg-gray-800 text-white rounded-lg shadow-lg">
    <h2 class="text-lg font-semibold mb-4">Gestión de Notas</h2>
    @if (!$nota_id)
    <!-- Formulario de Creación -->
    <form wire:submit.prevent="guardar" class="space-y-4">
        <!-- Input para buscar alumnos -->
        <div>
            <label class="block text-sm font-medium mb-1">Buscar Alumno:</label>
            <input type="text" list="alumnos" wire:model="alumno_nombre" placeholder="Escribe el nombre del alumno"
                class="w-full p-2 bg-gray-700 border border-gray-600 text-black rounded focus:ring focus:ring-green-400">

            {{--MUESTRA UN REGISTRO DE LOS USUARIOS PUESTOS EN EL INPUT
            <datalist id="alumnos">
                @foreach($alumnos as $nombre)
                    <option value="{{ $nombre }}"></option>
                @endforeach
            </datalist> --}}
        </div>

        <!-- Seleccionar Asignatura -->
        <div>
            <label class="block text-sm font-medium mb-1">Asignatura:</label>
            <select wire:model.live="asignatura_id"
                class="w-full p-2 bg-gray-700 border border-gray-600 text-black rounded focus:ring focus:ring-green-400">
                <option value="">Seleccione una asignatura</option>
                @foreach($asignaturas as $asignatura)
                    <option value="{{ $asignatura->id }}">{{ $asignatura->denominacion }}</option>
                @endforeach
            </select>
        </div>

        <!-- Seleccionar Trimestre -->
        <div>
            <label class="block text-sm font-medium mb-1">Trimestre:</label>
            <select wire:model="trimestre"
                class="w-full p-2 bg-gray-700 border border-gray-600 text-black rounded focus:ring focus:ring-green-400">
                <option value="">Seleccione un trimestre</option>
                @foreach($trimestres as $tri)
                    <option value="{{ $tri }}">{{ $tri }}</option>
                @endforeach
            </select>
        </div>


        <!-- Seleccionar Nota -->
        <div>
            <label class="block text-sm font-medium mb-1">Nota:</label>
            <select wire:model="nota"
                class="w-full p-2 bg-gray-700 border border-gray-600 text-black rounded focus:ring focus:ring-green-400">
                <option value="">Seleccione una nota</option>
                @for ($i = 0; $i <= 10; $i++)
                    <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>
        </div>

        <!-- Botón de Guardar -->
        <button type="submit"
            class="w-full bg-green-500 hover:bg-green-600 text-white font-semibold py-2 rounded-lg shadow-md transition">
            Guardar
        </button>
    </form>
    @endif

    <!-- Formulario de Edición (solo se muestra si hay una nota seleccionada) -->
    @if ($nota_id)
    <div class="mt-6 p-4 bg-gray-700 rounded-lg shadow-lg">
        <h3 class="text-md font-semibold mb-2">Editar Nota</h3>
        <form wire:submit.prevent="actualizarNota">
            <div class="space-y-4">
                @if(!empty($trimestres))
                <div>
                    <label class="block text-sm font-medium mb-1">Trimestre:</label>
                    <select wire:model="trimestre"
                        class="w-full p-2 bg-white border border-gray-600 text-black rounded focus:ring focus:ring-green-400">
                        <option value="">Seleccione un trimestre</option>
                        @foreach($trimestres as $tri)
                            <option value="{{ $tri }}">{{ $tri }}</option>
                        @endforeach
                    </select>
                </div>
                @endif

                <div>
                    <label class="block text-sm font-medium mb-1">Nota:</label>
                    <select wire:model="nota"
                        class="w-full p-2 bg-white border border-gray-600 text-black rounded focus:ring focus:ring-green-400">
                        <option value="">Seleccione una nota</option>
                        @for ($i = 0; $i <= 10; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
                </div>

                <button type="submit"
                    class="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 rounded-lg shadow-md transition">
                    Actualizar
                </button>
            </div>
        </form>
    </div>
    @endif

    <table class="w-full mt-6 border border-gray-700 shadow-lg">
        <thead class="bg-gray-700 text-white">
            <tr>
                <th class="p-2">Asignatura</th>
                <th class="p-2">Alumno</th>
                <th class="p-2">Trimestre</th>
                <th class="p-2">Nota</th>
                <th class="p-2">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($notas as $nota)
            <tr class="border-t border-gray-700 bg-gray-900 hover:bg-gray-700 transition">
                <td class="p-2">{{ $nota->asignatura->denominacion }}</td>
                <td class="text-center p-2">{{ $nota->alumno->nombre }}</td>
                <td class="text-center p-2">{{ $nota->trimestre }}</td>
                <td class="text-center p-2">{{ $nota->nota }}</td>
                <td class="text-center p-2">
                    <button wire:click="editarNota({{ $nota->id }})"
                        class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded-lg shadow-md transition">
                        Editar
                    </button>
                    <button wire:click="eliminar({{ $nota->id }})"
                        class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg shadow-md transition">
                        Eliminar
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
