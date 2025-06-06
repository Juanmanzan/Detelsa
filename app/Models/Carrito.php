<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Carrito extends Model
{
    protected $fillable = ['id', 'cantidad'];

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
}
