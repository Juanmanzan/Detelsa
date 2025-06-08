<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Orden;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class EstadisticasController extends Controller
{
    public function estadisticas()
    {
        $hoy = Carbon::today();
        $hace7Dias = Carbon::today()->subDays(7);

        // Optimización: Todas las consultas en un solo bloque
        $stats = DB::transaction(function () use ($hoy, $hace7Dias) {
            // Órdenes de hoy
            $ordenesHoy = Orden::whereDate('fecha', $hoy)->count();
            
            // Ventas totales
            $ventasTotales = Orden::sum('total');
            
            // Producto más vendido con solo 1 consulta
            $productoMasVendido = DB::table('detalle_ordenes')
                ->join('productos', 'detalle_ordenes.producto_id', '=', 'productos.id')
                ->select(
                    'productos.id as producto_id',
                    'productos.nombre as producto_nombre',
                    DB::raw('SUM(detalle_ordenes.cantidad) as total_vendido')
                )
                ->groupBy('productos.id', 'productos.nombre')
                ->orderByDesc('total_vendido')
                ->first();
            
            // Promociones activas
            $promocionesActivas = Producto::where('promocion', true)->count();
            
            // Ventas por categoría (optimizada)
            $ventasPorCategoria = DB::table('detalle_ordenes')
                ->join('productos', 'detalle_ordenes.producto_id', '=', 'productos.id')
                ->join('categorias', 'productos.categoria_id', '=', 'categorias.id')
                ->select(
                    'categorias.nombre',
                    DB::raw('SUM(detalle_ordenes.cantidad * detalle_ordenes.precio_unitario) as total')
                )
                ->groupBy('categorias.nombre')
                ->get();
            
            // Tendencia de órdenes (últimos 7 días)
            $tendenciaOrdenes = Orden::selectRaw(
                    'DATE(created_at) as fecha, COUNT(*) as total'
                )
                ->whereDate('created_at', '>=', $hace7Dias)
                ->groupBy(DB::raw('DATE(created_at)'))
                ->orderBy('fecha')
                ->get();

            return compact(
                'ordenesHoy',
                'ventasTotales',
                'productoMasVendido',
                'promocionesActivas',
                'ventasPorCategoria',
                'tendenciaOrdenes'
            );
        });

        // Preparar datos para la vista
        $productoNombre = $stats['productoMasVendido'] 
            ? "{$stats['productoMasVendido']->producto_nombre} ({$stats['productoMasVendido']->total_vendido} vendidos)"
            : 'No hay ventas';

        return view('admin', array_merge($stats, [
            'productoNombre' => $productoNombre,
            'productoId' => $stats['productoMasVendido']->producto_id ?? null
        ]));
    }
}