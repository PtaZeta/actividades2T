<?php
namespace App\Livewire;

use App\Http\Requests\StoreNotaRequest;
use Livewire\Component;
use App\Models\Nota;
use App\Models\Asignatura;
use App\Models\Alumno;

class Notas extends Component
{
    public $alumno_nombre = '';
    public $asignatura_id;
    public $nota;
    public $nota_id;
    public $trimestre;
    public $trimestres = [];

    public function updatedAsignaturaId($value)
    {
        $asignatura = Asignatura::find($value);

        if ($asignatura) {
            $this->trimestres = range(1, intval($asignatura->numero_trimestres));
        } else {
            $this->trimestres = [];
        }
    }


    public function guardar()
    {
        $alumno = Alumno::where('nombre', 'ILIKE', $this->alumno_nombre)->first();

        if (!$alumno) {
            return view('livewire.notas.notas');
        }

        $validated = $this->validate((new StoreNotaRequest())->rules());

        $validated['alumno_id'] = $alumno->id;


        $existeNota = Nota::where('alumno_id', $alumno->id)
        ->where('asignatura_id', $validated['asignatura_id'])
        ->where('trimestre', $validated['trimestre'])
        ->exists();

        if ($existeNota) {
            return;
        }

        Nota::create($validated);

        $this->reset(['asignatura_id', 'trimestres', 'trimestre', 'nota', 'alumno_nombre']);
    }


    public function eliminar($notaid)
    {
        $nota = Nota::findOrFail($notaid);
        $nota->delete();
    }

    public function editarNota($id)
    {
        $nota = Nota::find($id);
        if ($nota) {
            $this->nota_id = $nota->id;
            $this->trimestre = $nota->trimestre;
            $this->nota = $nota->nota;
            $this->asignatura_id = $nota->asignatura_id;

            $asignatura = Asignatura::find($nota->asignatura_id);

            if ($asignatura) {
                $this->trimestres = range(1, intval($asignatura->numero_trimestres));
            } else {
                $this->trimestres = [];
            }
        }
    }



    public function actualizarNota()
    {
        $this->validate([
            'trimestre' => 'required|integer|min:1|max:3',
            'nota' => 'required|integer|min:0|max:10',
        ]);

        if ($this->nota_id) {
            $nota = Nota::find($this->nota_id);
            if ($nota) {
                $nota->update([
                    'trimestre' => $this->trimestre,
                    'nota' => $this->nota,
                ]);
            }
        }

        session()->flash('message', 'Nota actualizada correctamente');
        $this->reset(['nota_id', 'trimestre', 'nota']);
    }

    public function render()
    {
        return view('livewire.notas.notas', [
            'alumnos' => Alumno::where('nombre', 'like', '%' . $this->alumno_nombre . '%')->pluck('nombre')->toArray(),
            'notas' => Nota::with(['asignatura', 'alumno'])->get(),
            'asignaturas' => Asignatura::all(),
        ])->layout('layouts.app');
    }
}

