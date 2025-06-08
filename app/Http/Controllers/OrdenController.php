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


    public function index(){
        $ordenes = Orden::all();

        return view('ordenes', compact('ordenes'));
    }

}