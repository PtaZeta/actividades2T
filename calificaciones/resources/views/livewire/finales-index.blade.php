<div>

    <select wire:model.live="asignaturaId" class="mb-4 px-4 py-2 border border-gray-300 rounded-lg">
        <option value="" selected>Selecciona una asignatura</option>
        @foreach ($asignaturas as $asignatura)
            <option value="{{ $asignatura->id }}">{{ $asignatura->denominacion }}</option>
        @endforeach
    </select>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3 cursor-pointer">
                        Nombre del alumno
                    </th>
                    <th scope="col" class="px-6 py-3 cursor-pointer">
                        Nota 1er trim.
                    </th>
                    <th scope="col" class="px-6 py-3 cursor-pointer" >
                        Nota 2er trim.
                    </th>
                    <th scope="col" class="px-6 py-3 cursor-pointer" >
                        Nota 3er trim.
                    </th>
                    <th scope="col" class="px-6 py-3 cursor-pointer">
                        Nota final
                    </th>
                </tr>
            </thead>

            @if (!$asignaturaId == "")
            <tbody>
                @foreach ($alumnos as $alumno)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="px-6 py-4">{{ $alumno->nombre }}</td>
                        {{-- @php
                            dd($asignatura);
                        @endphp --}}
                        <td class="px-6 py-4">{{ $alumno->notaTrimestre($asignaturaId, "1") }}</td>
                        <td class="px-6 py-4">{{ $alumno->notaTrimestre($asignaturaId, "2") }}</td>
                        <td class="px-6 py-4">{{ $alumno->notaTrimestre($asignaturaId, "3") }}</td>
                        <td class="px-6 py-4">{{ $alumno->notaFinal($asignaturaId)}}</td>
                    </tr>
                @endforeach
            </tbody>
            @endif
        </table>
    </div>

</div>
