<div>
    <table>
        <tr>
            <th>Titulo</th>
            <th>Portada</th>
            <th>Acciones</th>
        </tr>
        @foreach ($videojuegos as $videojuego)
            <tr>
                <td>{{$videojuego->titulo}}</td>

                <td>
                    <a wire:click="ver({{ $videojuego->id }})">
                        <img width="100px" height="100px" src="{{$videojuego->portada}}" alt="{{$videojuego->titulo}}">
                    </a>
                </td>
                <td>
                    <button wire:click="editar({{$videojuego->id}})"> Editar </button>
                    @if (!$estaEditando)
                        <button wire:click="eliminar({{$videojuego->id}})"> Eliminar </button>
                    @endif
                </td>
            </tr>
        @endforeach
    </table>
    @if(!$estaEditando)
    <form wire:submit.prevent="crear">
        <p>Crear videojuego: </p>
        <label for="titulo">Titulo:</label>
        <input wire:model="titulo" type="text" name="titulo">
        <br>
        <label for="portada">Portada:</label>
        <input wire:model="portada" type="file" name="portada">
        <button type="submit">Crear videojuego</button>
    </form>
    @else
    <form wire:submit.prevent="actualizar">
        <p>Editar videojuego: </p>
        <label for="titulo">Titulo:</label>
        <input wire:model="titulo" type="text" name="titulo">
        <br>
        <label for="portada">Portada: <label>
        <img width="100px" height="100px" src="{{$videojuego->portada}}" alt="{{$videojuego->titulo}}">
        <input wire:model="portada" type="file" name="portada">
        <button type="submit">Editar videojuego</button>
        <button wire:click.prevent="cancelar">Cancelar</button>
    </form>
    @endif
</div>
