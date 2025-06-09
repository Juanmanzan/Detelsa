<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria; 
use Illuminate\Http\Request;

class ProductosController extends Controller
{
    public function index()
    {
        $productos = Producto::all();
        $categorias = Categoria::all(); 

        return view('crearproductos', compact('productos', 'categorias')); 
    }

    public function create()
    {
        return redirect()->route('productos.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'imagen' => 'required|image',
            'nombre' => 'required|string|max:40',
            'descripcion' => 'required|string|max:1000',
            'ingredientes' => 'required|string|max:1000',
            'modo_de_uso' => 'required|string|max:1000',
            'precio' => 'required|numeric',
            'categoria_id' => 'required|integer',
            'promocion' => 'nullable|boolean',
        ]);

        $producto = new Producto();
        $producto->nombre = $request->nombre;
        $producto->descripcion = $request->descripcion;
        $producto->ingredientes = $request->ingredientes;
        $producto->modo_de_uso = $request->modo_de_uso;
        $producto->precio = $request->precio;
        $producto->categoria_id = $request->categoria_id;
        $producto->promocion = $request->has('promocion'); // check if checkbox is checked

        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen');
            $nombreArchivo = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('imagenes'), $nombreArchivo);
            $producto->imagen = 'imagenes/' . $nombreArchivo;
        }

        $producto->save();

        return redirect()->route('productos.index')->with('success', 'Producto creado exitosamente');
    }

    public function edit($id)
    {
        $producto = Producto::findOrFail($id);
        $categorias = Categoria::all(); 
        return view('editarproducto', compact('producto', 'categorias'));
    }

    public function update(Request $request, $id)
    {
        $producto = Producto::findOrFail($id);

        $request->validate([
            'imagen' => 'nullable|image',
            'nombre' => 'required|string|max:40',
            'descripcion' => 'required|string|max:1000',
            'ingredientes' => 'required|string|max:1000',
            'modo_de_uso' => 'required|string|max:1000',
            'precio' => 'required|numeric',
            'categoria_id' => 'required|integer',
            'promocion' => 'nullable|boolean',
        ]);

        $producto->nombre = $request->nombre;
        $producto->descripcion = $request->descripcion;
        $producto->ingredientes = $request->ingredientes;
        $producto->modo_de_uso = $request->modo_de_uso;
        $producto->precio = $request->precio;
        $producto->categoria_id = $request->categoria_id;
        $producto->promocion = $request->has('promocion');

        if ($request->hasFile('imagen')) {
            if ($producto->imagen && file_exists(public_path($producto->imagen))) {
                unlink(public_path($producto->imagen));
            }

            $file = $request->file('imagen');
            $nombreArchivo = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('imagenes'), $nombreArchivo);
            $producto->imagen = 'imagenes/' . $nombreArchivo;
        }

        $producto->save();

        return redirect()->route('productos.index')->with('success', 'Producto actualizado correctamente');
    }

    public function destroy($id)
    {
        $producto = Producto::findOrFail($id);

        if ($producto->imagen && file_exists(public_path($producto->imagen))) {
            unlink(public_path($producto->imagen));
        }

        $producto->delete();

        return redirect()->route('productos.index')->with('success', 'Producto eliminado correctamente');
    }

    public function buscar(Request $request)
{
    $categorias = Categoria::all();
    $query = $request->input('q');

    $productos = Producto::where('nombre', 'LIKE', "%{$query}%")
        ->orWhere('descripcion', 'LIKE', "%{$query}%")
        ->orWhere('ingredientes', 'LIKE', "%{$query}%")
        ->orWhere('modo_de_uso', 'LIKE', "%{$query}%")
        ->get();

    return view('productos', compact('categorias', 'productos'));
}

}
