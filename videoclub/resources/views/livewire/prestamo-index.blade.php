<div>
    <select wire:model.live='ejemplable_type' name="ejemplable_type">
        <option value="">Selecciona un articulo...</option>
        <option value="App\Models\Videojuego">Videojuegos</option>
        <option value="App\Models\Pelicula">Películas</option>
    </select>
    @if ($ejemplable_type != '')
    <form wire:submit.prevent="crear">
        <select wire:model='ejemplar_id' name="ejemplar_id">
            <option value="">Seleciona un ejemplar...</option>
            @foreach ($ejemplares as $ejemplar)
                <option value="{{$ejemplar->id}}">Ejemplar Nº: {{$ejemplar->id}}</option>
            @endforeach
        </select>
        <button type="submit">Crear</button>
    </form>
    @endif
</div>
