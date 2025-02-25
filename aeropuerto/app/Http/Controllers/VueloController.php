<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVueloRequest;
use App\Http\Requests\UpdateVueloRequest;
use App\Models\Vuelo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VueloController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vuelo = Vuelo::class;
        $vuelos = Vuelo::withCount('users')->paginate(10);
        return view('vuelos.index', compact('vuelos', 'vuelo'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::check()) {
        return view('vuelos.create');
        } else {
            return redirect()->route('login');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'codigo' => 'required|string|unique:vuelos|max:6',
            'origen' => 'required|string|size:3',
            'destino' => 'required|string|size:3',
            'airline' => 'required|string',
            'fecha_salida' => 'required|date',
            'fecha_llegada' => 'required|date|after:fecha_salida',
            'plazas_totales' => 'required|integer|min:1',
            'precio' => 'required|numeric|min:0',
        ]);

        Vuelo::create($request->all());

        return redirect()->route('vuelos.index')->with('success', 'Vuelo creado correctamente.');
    }


    /**
     * Display the specified resource.
     */
    public function show(Vuelo $vuelo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vuelo $vuelo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVueloRequest $request, Vuelo $vuelo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vuelo $vuelo)
    {
        //
    }
}
