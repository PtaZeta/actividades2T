<div>
    {{-- {{ dump($pista) }} --}}

    <select wire:model.live='pista_id' name="pista_id">
        <option value=''>Selecciona una pista...</option>
        @foreach ($pistas as $pista)
            <option value='{{ $pista->id }}'>{{ $pista->nombre }}</option>
        @endforeach
    </select>
    @if ($pista_id !== '')
        <table style="border: 1px solid black">
            <thead>
                <th>HORARIO</th>
                <th>LUNES</th>
                <th>MARTES</th>
                <th>MIERCOLES</th>
                <th>JUEVES</th>
                <th>VIERNES</th>
            </thead>
            <tbody>
                @foreach ($tabla as $hora => $fila)
                    <tr>
                        <td>{{ $hora }}:00</td>
                        @foreach ($fila as $celda)
                            <td>
                                @if ($celda::class == \Illuminate\Support\Carbon::class)
                                    <button wire:click="reservar('{{ $celda }}')">Reservar</button>
                                @else
                                    @if ($celda->user == Illuminate\Support\Facades\Auth::user())
                                        <button wire:click="eliminar({{ $celda->id }})">Eliminar</button>
                                    @else
                                        Reservado
                                    @endif
                                @endif
                            </td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
