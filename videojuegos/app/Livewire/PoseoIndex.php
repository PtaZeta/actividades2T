<?php

namespace App\Livewire;

use App\Models\Videojuego;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PoseoIndex extends Component
{
    public $videojuegoId = '';

    public $videojuego;

    public function updatedVideojuegoId($videojuegoId)
    {
        if (!$videojuegoId == '') {
            $this->videojuego = Videojuego::find($videojuegoId);
        }
    }

    public function lotengo()
    {
        if (!$this->videojuegoId == '') {
            if($this->videojuego->users()->where('user_id', Auth::id())->count() == 0) {
                Auth::user()->videojuegos()->attach($this->videojuego);
            }
        }
        return redirect()->route('videojuegos.index');

        // Auth::user()->videojuegos()->attach($this->videojuego);
    }

    public function nolotengo()
    {
        if (!$this->videojuegoId == '') {
            if(!$this->videojuego->users()->where('user_id', Auth::id())->count() == 0) {
                Auth::user()->videojuegos()->detach($this->videojuego);
            }
        }

        // return redirect('videojuegos');
        return redirect()->route('videojuegos.index');

        // Auth::user()->videojuegos()->attach($this->videojuego);
    }

    public function render()
    {
        return view('livewire.poseo-index', [
            'videojuegos' => Videojuego::all(),
        ]);
    }
}
