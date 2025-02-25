<?php

namespace App\Livewire;

use App\Models\Alumno;
use App\Models\Asignatura;
use Livewire\Component;

class FinalesIndex extends Component
{

    public $alumnos;

    public $search = '';

    public $asignaturaId = "";

    public $asignaturas;

    public function mount(){

        $this->asignaturas = Asignatura::all();
        $this->alumnos = Alumno::all();

    }


    public function updatedAsignaturaId($asignaturaId)
    {
        // Cuando se actualiza la categoría seleccionada, obtenemos los productos de esa categoría

        $this->asignaturaId = $asignaturaId;

    }

    public function render()
    {

        return view('livewire.finales-index')->with([
            'asignaturas' => $this->asignaturas,
            'alumnos' => $this->alumnos,
        ]);
    }
}
