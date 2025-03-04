<div>
    <table>
        <tr>
            <th>Titulo</th>
            <th>Duracion</th>
            <th>Acciones</th>
        </tr>
        @foreach ($peliculas as $pelicula)
            <tr>
                <td>{{$pelicula->titulo}}</td>
                <td>{{$this->formatearDuracion($pelicula->duracion)}}</td>
                <td>
                    <button wire:click="editar({{$pelicula->id}})"> Editar </button>
                    @if (!$estaEditando)
                        <button wire:click="eliminar({{$pelicula->id}})"> Eliminar </button>
                    @endif
                </td>
            </tr>
        @endforeach
    </table>
    @if(!$estaEditando)
    <form wire:submit.prevent="crear">
        <p>Crear pelicula: </p>
        <label for="titulo">Titulo:</label>
        <input wire:model="titulo" type="text" name="titulo">

        <label for="duracion">Duracion (minutos):</label>
        <input wire:model="duracion" type="number" name="duracion">
        <button type="submit">Crear pelicula</button>
    </form>
    @else
    <form wire:submit.prevent="actualizar">
        <p>Editar pelicula: </p>
        <label for="titulo">Titulo:</label>
        <input wire:model="titulo" type="text" name="titulo">

        <label for="duracion">Duracion (minutos):</label>
        <input wire:model="duracion" type="number" name="duracion">
        <button type="submit">Editar pelicula</button>
        <button wire:click.prevent="cancelar">Cancelar</button>
    </form>
    @endif
</div>
