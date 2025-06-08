<?php
namespace App\Http\Controllers;

use App\Models\Orden;
use Illuminate\Http\Request;
use App\Models\OrdenDetalle;

class OrdenController extends Controller
{


    public function crear(Request $request)
    {
        try {
            $carrito = $request->input('carrito');

            if (!$carrito || empty($carrito)) {
                return response()->json(['success' => false, 'message' => 'Carrito vacío'], 400);
            }

            // Calcular total
            $total = collect($carrito)->reduce(function ($carry, $item) {
                return $carry + ($item['precio'] * $item['cantidad']);
            }, 0);

            // Crear orden
            $orden = Orden::create([
                'fecha' => now(),
                'total' => $total,
            ]);

            // Insertar detalles
            foreach ($carrito as $productoId => $item) {
                OrdenDetalle::create([
                    'orden_id' => $orden->id,
                    'producto_id' => $productoId,
                    'cantidad' => $item['cantidad'],
                    'precio_unitario' => $item['precio'],
                    'subtotal' => $item['precio'] * $item['cantidad'],
                ]);
            }

            return response()->json(['success' => true]);

        } catch (\Exception $e) {
            // Devuelve el error para verlo en consola
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function guardar(Request $request)
{
    try {
        $productoId = $request->input('producto_id');
        $nombre = $request->input('nombre');
        $precio = floatval($request->input('precio'));

        if (!$productoId || !$nombre || !$precio) {
            return response()->json(['error' => 'Datos incompletos'], 400);
        }

        // Guarda la orden principal
        $orden = \App\Models\Orden::create([
            'fecha' => now(),
            'total' => $precio
        ]);

        // Guarda el detalle (1 producto por defecto)
        \App\Models\OrdenDetalle::create([
            'orden_id' => $orden->id,
            'producto_id' => $productoId,
            'cantidad' => 1,
            'precio_unitario' => $precio,
            'subtotal' => $precio
        ]);

        return response()->json(['success' => true]);

    } catch (\Throwable $e) {
        // Captura errores y devuelve mensaje útil
        return response()->json(['error' => $e->getMessage()], 500);
    }
}




    public function index(){
        $ordenes = Orden::all();

        return view('ordenes', compact('ordenes'));
    }

}