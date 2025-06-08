<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrdenDetalle extends Model
{
    use HasFactory;

    protected $table = 'detalle_ordenes';

    protected $fillable = [
        'orden_id',
        'producto_id',
        'cantidad',
        'precio_unitario',
        'subtotal',
    ];

    public $timestamps = false;

    // Relación inversa con Orden
    public function orden()
    {
        return $this->belongsTo(Orden::class);
    }

    // Relación con producto (si tienes modelo Producto)
    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
}
