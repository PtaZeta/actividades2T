<?php

namespace App\Livewire;

use App\Http\Requests\StoreAsignaturaRequest;
use App\Http\Requests\UpdateAsignaturaRequest;
use App\Models\Asignatura;
use Livewire\Component;

class Asignaturas extends Component
{
    public $denominacion;
    public $numero_trimestres;
    public $asignaturaid;
    public $estaEditando = false;

    public function ver($asignaturaid)
    {
        $asignatura = Asignatura::findOrFail($asignaturaid);
        return redirect()->route('asignaturas.show', $asignatura->id);
    }

    public function crear()
    {
        $validated = $this->validate((new StoreAsignaturaRequest())->rules());
        Asignatura::create($validated);
    }

    public function editar($asignaturaid)
    {
        $this->asignaturaid = $asignaturaid;
        $asignatura = Asignatura::findOrFail($asignaturaid);
        $this->denominacion = $asignatura->denominacion;
        $this->numero_trimestres = $asignatura->numero_trimestres;
        $this->estaEditando = true;
    }

    public function actualizar()
    {
        $asignatura = Asignatura::findOrFail($this->asignaturaid);
        $validated = $this->validate((new UpdateAsignaturaRequest())->rules());
        $asignatura->update($validated);
        $this->reset();
    }

    public function cancelar()
    {
        $this->reset();
        // $this->estaEditando = false;
    }

    public function eliminar($asignaturaid)
    {
        $asignatura = Asignatura::findOrFail($asignaturaid);
        $asignatura->delete();
    }

    public function render()
    {
        return view('livewire.asignaturas.asignaturas')->with([
            'asignaturas' => Asignatura::all(),
        ])->layout('layouts.app');
    }
}
