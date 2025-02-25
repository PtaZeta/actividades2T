<?php

use App\Generico\Carrito;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TicketController;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;


Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/caja', function () {
    return view('caja', ['carrito' => Carrito::carrito()]);
})->name('caja');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::resource('productos', ProductoController::class)->except('show');

Route::post('/carrito/meter', function (Request $request) {
    $codigo = $request->input('codigo_producto');
    $producto = Producto::where('codigo', $codigo)->first();

    if ($producto) {
        $carrito = Carrito::carrito();
        $carrito->meter($producto->id);
        session()->put('carrito', $carrito);
    } else {
        return redirect()->route('caja')->with('error', 'Producto no encontrado');
    }

    return redirect()->route('caja');
})->name('carrito.meter');

Route::get('/carrito/vaciar', function () {
    session()->forget('carrito');
    return redirect()->route('home');
})->name('carrito.vaciar');

Route::get('/carrito/sacar/{producto}', function (Producto $producto) {
    $carrito = Carrito::carrito();
    $carrito->sacar($producto->id);
    session()->put('carrito', $carrito);
    return redirect()->route('caja');
})->name('carrito.sacar');

// Route::post('/comprar', function (Request $request) {
//     $request->validate([
//         'tarjeta' => 'required|digits:16'
//     ]);

//     return redirect()->route('home')->with('success', 'Compra realizada con éxito.');
//     session()->put('carrito', new Carrito());
// })->middleware('auth')->name('comprar');

Route::post('/comprar', function (Request $request) {
    $request->validate([
        'tarjeta' => 'required|numeric:16'
    ]);

    DB::beginTransaction();

    try {
        $ticketId = DB::table('tickets')->insertGetId([
            'tarjeta'   => $request->input('tarjeta'),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $carrito = Carrito::carrito();

        foreach ($carrito->getLineas() as $linea) {
            DB::table('lineas')->insert([
                'ticket_id'   => $ticketId,
                'producto_id' => $linea->getProducto()->id,
                'created_at'  => now(),
                'updated_at'  => now()
            ]);
        }

        session()->put('carrito', new Carrito());

        DB::commit();
        return redirect()->route('tickets.show', $ticketId)->with('error', 'Error en la compra.');

    } catch (\Exception $e) {
        DB::rollback();
        Log::error('Error en la compra: ' . $e->getMessage());
        return redirect()->route('tickets.show', [
            'ticket' => $ticketId,
        ])->with('error', 'Error en la compra.');
    }

})->middleware('auth')->name('comprar');

Route::resource('tickets', TicketController::class);

Route::get('/pago', function (Request $request) {
    return view('pago', ['carrito' => Carrito::carrito()]);
})->middleware('auth')->name('pago');


require __DIR__.'/auth.php';
