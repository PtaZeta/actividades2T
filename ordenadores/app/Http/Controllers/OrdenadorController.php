<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrdenadorRequest;
use App\Http\Requests\UpdateOrdenadorRequest;
use App\Models\Aula;
use App\Models\Cambio;
use App\Models\Ordenador;
use Illuminate\Support\Facades\DB;

class OrdenadorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('ordenadores.index', [
            'ordenadores' => Ordenador::with('aula')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ordenadores.create', [
            'aulas' => Aula::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrdenadorRequest $request)
    {
        $ordenador = new Ordenador();
        $ordenador->modelo = $request->input('modelo');
        $ordenador->marca = $request->input('marca');
        $ordenador->aula_id = $request->input('aula_id');

        $ordenador->save();


        return redirect()->route('ordenadores.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ordenador $ordenador)
    {
        return view('ordenadores.show', [
            'ordenador' => $ordenador,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ordenador $ordenador)
    {
        return view('ordenadores.edit', [
            'ordenador' => $ordenador,
            'aulas' => Aula::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrdenadorRequest $request, Ordenador $ordenador)
    {
        if ($ordenador->aula_id != $request->aula_id) {
            Cambio::create([
                'ordenador_id' => $ordenador->id,
                'origen_id' => $ordenador->aula_id,
                'destino_id' => $request->aula_id,
                'created_at' => now(),
            ]);
        }

        $ordenador->update($request->all());

        return redirect()->route('ordenadores.show', $ordenador);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ordenador $ordenador)
    {
        $ordenador->delete();

        return redirect()->route('ordenadores.index');
    }
}
