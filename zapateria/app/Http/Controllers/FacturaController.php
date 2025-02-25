<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFacturaRequest;
use App\Http\Requests\UpdateFacturaRequest;
use App\Models\Factura;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

class FacturaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    use AuthorizesRequests;

    public function index()
    {
        $facturas = Factura::where('user_id', auth()->id())->with('zapatos')->get();
        // $facturas = Factura::all();
        foreach ($facturas as $factura) {
            // $this->authorize('ver-factura', $factura);
            $factura->total = $factura->zapatos->sum(function ($zapato) {
                return $zapato->pivot->cantidad * $zapato->precio;
            });
        };


        return view('facturas.index', compact('facturas'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFacturaRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Factura $factura)
    {
        $this->authorize('ver-factura', $factura);

        $totalFactura = $factura->zapatos->sum(function ($zapato) {
            return $zapato->pivot->cantidad * $zapato->precio;
        });

        return view('facturas.show', compact('factura', 'totalFactura'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Factura $factura)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFacturaRequest $request, Factura $factura)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Factura $factura)
    {
        $factura->delete();
        return redirect('facturas');
    }
}
