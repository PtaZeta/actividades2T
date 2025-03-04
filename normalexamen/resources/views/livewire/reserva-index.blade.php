<div>
    <select wire:model.live='pista_id' name="pista_id">
        <option value=''>Selecciona una pista...</option>
        @foreach ($pistas as $pista)
            <option value="{{$pista->id}}">{{$pista->nombre}}</option>
        @endforeach
    </select>

    <table>
        <th>Horario</th>
        <th>Lunes</th>
        <th>Martes</th>
        <th>Miércoles</th>
        <th>Jueves</th>
        <th>Viernes</th>

        @foreach ($tabla as $hora => $fila)
            <tr>
                <td>{{$hora}}:00</td>
                @foreach ($fila as $celda)
                    @if ($celda::class == \App\Models\Reserva::class)
                        @if ($celda->id == \Illuminate\Support\Facades\Auth::id())
                            <td>
                                <form action="{{ route('reservas.destroy', $celda->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta reserva?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">
                                        Eliminar
                                    </button>
                                </form>
                            </td>
                        @endif
                    @else
                            <td>
                                <form action="{{ route('reservas.store', ['pista_id' => $pista_id, 'fecha_hora' => $celda]) }}" method="POST">
                                    @csrf
                                    <button type="submit">Reservar</button>
                                </form>
                            </td>
                    @endif
                @endforeach
            </tr>
        @endforeach
    </table>
</div>
