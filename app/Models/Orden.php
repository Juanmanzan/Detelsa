<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Orden extends Model
{
    use HasFactory;

    protected $table = 'ordenes'; 

    protected $fillable = [
        'fecha',
        'total',
    ];

    public $timestamps = false;

    // Relación con los detalles
    public function detalles()
    {
        return $this->hasMany(OrdenDetalle::class);
    }
}
