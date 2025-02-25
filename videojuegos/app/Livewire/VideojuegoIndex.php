<?php

namespace App\Livewire;

use App\Http\Requests\StoreVideojuegoRequest;
use App\Http\Requests\UpdateVideojuegoRequest;
use App\Models\Desarrolladora;
use App\Models\Distribuidora;
use App\Models\Videojuego;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class VideojuegoIndex extends Component
{
    use WithPagination;

    public $videojuegoid;

    public $titulo;
    public $anyo;
    public $desarrolladora_id;
    public $distribuidora_id = '';

    public $estaEditando = false;

    public $campoOrdenar = 'titulo';
    public $direccionOrdenar = 'asc';

    public $desarrolladorasFiltradas = [];

    public $videojuego_editar;

    public function updatedDistribuidoraId($distribuidora_id)
    {
        if (!$distribuidora_id == '') {
            $distribuidora = Distribuidora::find($distribuidora_id);
            $this->desarrolladorasFiltradas = $distribuidora->desarrolladoras;
        } else {
            $this->desarrolladorasFiltradas = [];
        }

    }

    public function ordenar($campo)
    {
        if ($this->campoOrdenar === $campo) {
            $this->direccionOrdenar = $this->direccionOrdenar === 'asc' ? 'desc' : 'asc';
        } else {
            $this->campoOrdenar = $campo;
            $this->direccionOrdenar = 'asc';
        }
    }

    public function ver($videojuegoid)
    {
        // $videojuego = Videojuego::findOrFail($videojuegoid);
        return redirect()->route('videojuegos.show', $videojuegoid);
    }


    public function crear(StoreVideojuegoRequest $request)
    {
        Videojuego::create($request->validated());

        // Auth::user()->videojuegos()->attach($videojuego);
        $this->cancelar();

    }

    public function editar($videojuegoid)
    {
        $this->cancelar();
        $this->videojuegoid = $videojuegoid;
        $this->videojuego_editar = Videojuego::findOrFail($videojuegoid);
        $this->titulo = $this->videojuego_editar->titulo;
        $this->anyo = $this->videojuego_editar->anyo;
        $this->distribuidora_id = $this->videojuego_editar->desarrolladora->distribuidora->id;
        $distribuidora = Distribuidora::find($this->distribuidora_id);
        $this->desarrolladorasFiltradas = $distribuidora->desarrolladoras;
        $this->estaEditando = true;
    }


    public function actualizar()
    {
        $videojuego = Videojuego::findOrFail($this->videojuegoid);
        $validated = $this->validate((new UpdateVideojuegoRequest())->rules());
        $videojuego->update($validated);
        $this->reset();
    }

    public function eliminar($videojuegoid)
    {
        $videojuego = Videojuego::findOrFail($videojuegoid);
        $videojuego->delete();
    }

    public function cancelar()
    {
        $this->reset();
    }

    public function render()
    {
        $query = Auth::user()->videojuegos()->with(['desarrolladora.distribuidora']);

        // Desarrolladoras
        // if ($this->campoOrdenar === 'desarrolladora') {
        //     $query->select('videojuegos.*')
        //         ->join('desarrolladoras', 'desarrolladoras.id', '=', 'videojuegos.desarrolladora_id')
        //         ->orderBy('desarrolladoras.nombre', $this->direccionOrdenar);

        // // Distribuidoras
        // } elseif ($this->campoOrdenar === 'distribuidora') {
        //     $query->select('videojuegos.*')
        //         ->join('desarrolladoras', 'desarrolladoras.id', '=', 'videojuegos.desarrolladora_id')
        //         ->join('distribuidoras', 'distribuidoras.id', '=', 'desarrolladoras.distribuidora_id')
        //         ->orderBy('distribuidoras.nombre', $this->direccionOrdenar);
        // } else {
        //     $query->orderBy($this->campoOrdenar, $this->direccionOrdenar);
        // }

        $query->select('videojuegos.*', 'desarrolladoras.nombre', 'distribuidoras.nombre')
                ->join('desarrolladoras', 'desarrolladoras.id', '=', 'videojuegos.desarrolladora_id')
                ->join('distribuidoras', 'distribuidoras.id', '=', 'desarrolladoras.distribuidora_id')
                ->orderBy($this->campoOrdenar, $this->direccionOrdenar);

        $videojuegos = $query->paginate(5);



        return view('livewire.videojuego-index', [
            'videojuegos' => $videojuegos,
            'videojuego' => $this->videojuego_editar,
            'estaEditando' => $this->estaEditando,
            'desarrolladorasFiltradas' => $this->desarrolladorasFiltradas,
            'distribuidoras' => Distribuidora::all(),
        ]);
    }
}
