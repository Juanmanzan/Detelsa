<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class ProductosController extends Controller
{
    public function index()
    {
        return view('crearproductos'); 
    }

    public function store(Request $request)
    {
        // Validar datos
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        // Crear nueva categoría
        Categoria::create([
            'nombre' => $request->nombre,
        ]);

       
    }
}
