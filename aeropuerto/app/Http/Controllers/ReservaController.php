<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use App\Models\User;
use App\Models\Vuelo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservaController extends Controller
{
    public function index()
    {
        $vuelos = Auth::user()->vuelos;


        return view('reservas.index', compact('vuelos'));
    }


    public function show(Reserva $reserva)
    {
        return view('reservas.show', compact('reserva'));
    }

    public function create(Vuelo $vuelo)
    {
        $asientosReservados = $vuelo->users()->pluck('user_vuelo.numero_asientos')->toArray();

        $asientosLibres = array_diff(range(1, $vuelo->plazas_totales), $asientosReservados);

        return view('reservas.create', compact('vuelo', 'asientosLibres'));
    }

    public function store(Request $request, Vuelo $vuelo)
    {
        $request->validate([
            'asientos' => 'required|array|min:1',
            'asientos.*' => 'integer|min:1|max:' . $vuelo->plazas_totales,
        ]);

        $asientosReservados = $vuelo->users()->pluck('user_vuelo.numero_asientos')->toArray();
        // dd($asientosReservados);
        // dd(array_unique($request->asientos));
        if (count($request->asientos) !== count(array_unique($request->asientos))) {
            return back()->withErrors(['asientos' => 'No se pueden reservar asientos duplicados.'])->withInput();
        }

        foreach ($request->asientos as $asiento) {
            if (in_array($asiento, $asientosReservados)) {
                return back()->withErrors(['asientos' => 'Uno o más asientos ya están reservados.'])->withInput();
            }
        }

        foreach ($request->asientos as $asiento) {
            Auth::user()->vuelos()->attach($vuelo->id, [
                'numero_asientos' => $asiento,
            ]);
        }

        return redirect()->route('reservas.index')->with('success', 'Reserva creada con éxito.');
    }

}

