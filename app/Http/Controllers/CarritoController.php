<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Carrito;

/**
 * Controlador para manejar el carrito de compras.
 */

class CarritoController extends Controller
{
   public function agregar(Request $request) {
        $productoId = $request->producto_id;
        $cantidad = $request->cantidad ?? 1;
        $actualizar = $request->input('actualizar', false);

        $producto = Producto::find($productoId);
        if (!$producto) {
            return response()->json(['error' => 'Producto no encontrado'], 404);
        }

        $carrito = session('carrito', []);

        if (isset($carrito[$productoId])) {
            if ($actualizar) {
                // Reemplazar cantidad (cuando actualizamos desde modal)
                $carrito[$productoId]['cantidad'] = $cantidad;
            } else {
                // Sumar cantidad (cuando agregamos producto nuevo)
                $carrito[$productoId]['cantidad'] += $cantidad;
            }
        } else {
            $carrito[$productoId] = [
                'id' => $producto->id,
                'nombre' => $producto->nombre,
                'imagen' => $producto->imagen,
                'precio' => (float) $producto->precio,
                'cantidad' => $cantidad
            ];
        }

        session(['carrito' => $carrito]);

        return response()->json([
            'mensaje' => 'Producto agregado correctamente',
            'producto' => $carrito[$productoId]
        ]);
    }

    public function eliminar($id)
    {
        $carrito = session('carrito', []);
        
        if (isset($carrito[$id])) {
            unset($carrito[$id]);
            session(['carrito' => $carrito]);
            return response()->json(['mensaje' => 'Producto eliminado del carrito']);
        }

        return response()->json(['mensaje' => 'Producto no encontrado en el carrito'], 404);
    }


    public function contador()
    {
        $carrito = session('carrito', []);
        $total = collect($carrito)->sum(fn($item) => (int)$item['cantidad']);
        return response()->json(['total' => $total]);
    }

    public function mostrar()
    {
        $carrito = session('carrito', []);

        // Validar que todos los productos tengan formato correcto
        foreach ($carrito as $id => &$item) { // ← ¡Aquí está el cambio!
            if (!isset($item['nombre'], $item['precio'], $item['cantidad'],$item['imagen'])) {
                unset($carrito[$id]); // Eliminar entradas corruptas
            } else {
                $item['precio'] = (float) $item['precio'];
                $item['cantidad'] = (int) $item['cantidad'];
            }
            if (isset($item['imagen'])) {
            $item['imagen'] = asset($item['imagen']);
        }
        }

        return response()->json($carrito);
    }


    public function vaciar() {
    try {
         session()->forget('carrito');
        
        return response()->json([
    'success' => true,
    'message' => 'Carrito vaciado'
], 200);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => $e->getMessage()
        ], 500);
    }
}


}
