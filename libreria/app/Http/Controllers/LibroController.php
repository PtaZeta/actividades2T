<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLibroRequest;
use App\Http\Requests\UpdateLibroRequest;
use App\Models\Ejemplar;
use App\Models\Libro;

class LibroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('libros.index', [
            'libros' => Libro::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('libros.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLibroRequest $request)
    {
        $libro = Libro::create($request->input());

        return redirect()->route('libros.show', $libro);
    }

    /**
     * Display the specified resource.
     */
    public function show(Libro $libro)
    {
        $libro = Libro::with('ejemplares')->findOrFail($libro->id);

        return view('libros.show', [
            'libro' => $libro,
            'ejemplares' => $libro->ejemplares,
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Libro $libro)
    {

        return view('libros.show', [
            'libro' => $libro,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLibroRequest $request, Libro $libro)
    {
        $libro->fill($request->input());

        $libro->save();

        return redirect()->route('libros.show', $libro);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Libro $libro)
    {
        $libro->delete();

        return redirect()->route('libros.index');
    }
}
