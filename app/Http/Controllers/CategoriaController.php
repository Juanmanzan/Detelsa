<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    // Mostrar todas las categorías
    public function index()
    {
        $categorias = Categoria::all();
        return view('crearcategorias', compact('categorias'));
    }

    // Mostrar formulario para crear categoría (puede ser redirigir si usas modal)
    public function create()
    {
        return redirect()->route('categorias.index');
    }

    // Guardar nueva categoría
    public function store(Request $request)
    {
        // Validación
        $request->validate([
            'nombre' => 'required|string|max:40',
            'imagen' => 'required|image',
        ]);

        // Verificar si ya existe categoría con ese nombre (ignorando mayúsculas/minúsculas)
         $existe = Categoria::whereRaw('LOWER(nombre) = ?', [strtolower($request->nombre)])->exists();
        if ($existe) {
            if ($request->ajax()) {
                return response()->json(['errors' => ['nombre' => ['La categoría ya existe.']]], 422);
            }
            return redirect()->back()->withErrors(['nombre' => 'La categoría ya existe.'])->withInput();
        }

        // Guardar categoría
        $categoria = new Categoria();
        $categoria->nombre = $request->nombre;

        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen');
            $nombreArchivo = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('imagenes'), $nombreArchivo);
            $categoria->imagen = 'imagenes/' . $nombreArchivo;
        }

        $categoria->save();
        
        if ($request->ajax()) {
            return response()->json(['success' => 'Categoría creada exitosamente'], 201);
        }

        return redirect()->route('categorias.index')->with('success', 'Categoría creada exitosamente');
    }
    

    // Mostrar formulario para editar categoría
    public function edit($id)
    {
        $categoria = Categoria::findOrFail($id);
        return view('editarcategoria', compact('categoria'));
    }

    // Actualizar categoría
    public function update(Request $request, $id)
    {
        $categoria = Categoria::findOrFail($id);

        $request->validate([
            'nombre' => 'required|string|max:40'. $categoria->id,
            'imagen' => 'nullable|image',
        ]);

        // Verificar si ya existe categoría con ese nombre (ignorando mayúsculas/minúsculas)
        $existe = Categoria::whereRaw('LOWER(nombre) = ?', [strtolower($request->nombre)])
                        ->where('id', '!=', $id)
                        ->exists();

        if ($existe) {
            if ($request->ajax()) {
                return response()->json(['errors' => ['nombre' => ['La categoría ya existe.']]], 422);
            }
            return redirect()->back()->withErrors(['nombre' => 'La categoría ya existe.'])->withInput();
        }

        // Actualizar campos
        $categoria->nombre = $request->nombre;

        if ($request->hasFile('imagen')) {
            // Eliminar imagen anterior
            if ($categoria->imagen && file_exists(public_path($categoria->imagen))) {
                unlink(public_path($categoria->imagen));
            }

            $file = $request->file('imagen');
            $nombreArchivo = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('imagenes'), $nombreArchivo);
            $categoria->imagen = 'imagenes/' . $nombreArchivo;
        }

        $categoria->save();

        // AJAX response
        if ($request->ajax()) {
            return response()->json(['mensaje' => 'Categoría actualizada correctamente']);
        }

        return redirect()->route('categorias.index')->with('success', 'Categoría actualizada correctamente');
    }

    // Eliminar categoría
    public function destroy($id)
    {
        $categoria = Categoria::findOrFail($id);

        if ($categoria->imagen && file_exists(public_path($categoria->imagen))) {
            unlink(public_path($categoria->imagen));
        }

        $categoria->delete();

        return redirect()->route('categorias.index')->with('success', 'Categoría eliminada correctamente');
    }
}
