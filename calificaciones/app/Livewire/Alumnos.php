<?php

namespace App\Livewire;

use App\Http\Requests\StoreAlumnoRequest;
use App\Http\Requests\UpdateAlumnoRequest;
use App\Models\Alumno;
use Livewire\Component;

class Alumnos extends Component
{
    public $nota_id;
    public $nombre;
    public $titulo;
    public $numpags;
    public $alumnoid;
    public $estaEditando = false;

    public function ver($alumnoid)
    {
        $alumno = Alumno::findOrFail($alumnoid);
        return redirect()->route('alumnos.show', $alumno->id);
    }

    public function crear()
    {
        $validated = $this->validate((new StoreAlumnoRequest())->rules());
        Alumno::create($validated);
    }

    public function editar($alumnoid)
    {
        $this->alumnoid = $alumnoid;
        $alumno = Alumno::findOrFail($alumnoid);
        $this->nombre = $alumno->nombre;
        $this->estaEditando = true;
    }

    public function actualizar()
    {
        $alumno = Alumno::findOrFail($this->alumnoid);
        $validated = $this->validate((new UpdateAlumnoRequest())->rules());
        $alumno->update($validated);
        $this->reset();
    }

    public function cancelar()
    {
        $this->reset();
        // $this->estaEditando = false;
    }

    public function eliminar($alumnoid)
    {
        $alumno = Alumno::findOrFail($alumnoid);
        $alumno->delete();
    }

    public function render()
    {
        return view('livewire.alumnos.alumnos')->with([
            'alumnos' => Alumno::all(),
        ])->layout('layouts.app');
    }
}
