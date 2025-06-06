<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria; 
use Illuminate\Http\Request;

class InformacionController extends Controller
{
    public function inicio() {
        $categorias = Categoria::all();
        $productos = Producto::all();
        return view('welcome', compact('categorias', 'productos'));
    }

     public function productos(){
        $productos = Producto::all();
        return view('productos', compact('productos'));
    }

    public function productoinfo($id) {
        $producto = Producto::findOrFail($id);
        $categorias = Categoria::all(); // si quieres mostrar categorías también aquí
        return view('productoinfo', compact('producto', 'categorias'));
    }
}