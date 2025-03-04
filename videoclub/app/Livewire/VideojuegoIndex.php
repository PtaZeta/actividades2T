<?php

namespace App\Livewire;

use App\Http\Requests\StoreVideojuegoRequest;
use App\Http\Requests\UpdateVideojuegoRequest;
use App\Models\Videojuego;
use Livewire\Component;
use Livewire\WithFileUploads;

class VideojuegoIndex extends Component
{
    use WithFileUploads;

    public $estaEditando = false;
    public $videojuego_id;
    public $titulo;
    public $portada;

    public function ver($videojuego_id)
    {
        $videojuego = Videojuego::findOrFail($videojuego_id);
        return redirect()->route('videojuegos.show', $videojuego->id);
    }

    public function crear()
    {
        $validated = $this->validate((new StoreVideojuegoRequest())->rules());

        $videojuego = new Videojuego();
        $videojuego->titulo = $validated['titulo'];

        if ($this->portada) {
            $nombreFoto = now() . $videojuego->titulo . '.png';
            $this->portada->storeAs('imagenes', $nombreFoto, 'public');
            $videojuego->portada = "storage/imagenes/{$nombreFoto}";
        }

        $videojuego->save();

        $this->reset();
    }

    public function editar($videojuego_id)
    {
        $this->videojuego_id = $videojuego_id;
        $videojuego = Videojuego::findOrFail($videojuego_id);
        $this->titulo = $videojuego->titulo;
        $this->portada = $videojuego->portada;
        $this->estaEditando = true;
    }

    public function actualizar()
    {
        $videojuego = Videojuego::findOrFail($this->videojuego_id);

        $validated = $this->validate([
            'titulo' => 'required|string|max:255',
        ]);

        if (!is_string($this->portada)) {
            $this->validate([
                'portada' => 'image',
            ]);

            $nombreFoto = now() . $videojuego->titulo . '.png';
            $this->portada->storeAs('imagenes', $nombreFoto, 'public');
            $videojuego->portada = "storage/imagenes/{$nombreFoto}";
        }

        $videojuego->titulo = $validated['titulo'];
        $videojuego->save();

        $this->reset();
        $this->estaEditando = false;
    }



    public function cancelar()
    {
        $this->reset();
    }

    public function eliminar($videojuego_id)
    {
        $videojuego = Videojuego::findOrFail($videojuego_id);
        $videojuego->delete();
    }

    public function render()
    {
        return view('livewire.videojuego-index', [
            'videojuegos' => Videojuego::all(),
        ]);
    }
}
