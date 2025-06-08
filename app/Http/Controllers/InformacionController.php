<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria; 
use App\Models\Perfil; 
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
        $categorias = Categoria::all();
        return view('productos', compact('productos', 'categorias'));
    }

    public function productoinfo($id) {
        $producto = Producto::findOrFail($id);
        $productosRelacionados = Producto::where('categoria_id', $producto->categoria_id)
                                    ->where('id', '!=', $producto->id)
                                    ->take(4) // Limitar a 4 por ejemplo
                                    ->get();
        $categorias = Categoria::all();
        return view('productoinfo', compact('producto', 'productosRelacionados', 'categorias'));
    }

    public function acercadenosotros()
    {

        $contenido = Perfil::all();
        $categorias = Categoria::all();
        return view('acercadenosotros', compact('contenido','categorias'));

    }


    public function index(Request $request){
        $categoriaId = $request->input('categoria');

        $categorias = Categoria::all();

        $productos = Producto::when($categoriaId, function ($query, $categoriaId) {
            return $query->where('categoria_id', $categoriaId);
        })->get();

        return view('productos', compact('productos', 'categorias', 'categoriaId'));
    }


}