<?php

namespace App\Http\Controllers;

use App\Models\Perfil;
use Illuminate\Http\Request;

class PerfilController extends Controller
{
    public function index()
    {
        $contenido = Perfil::all();
        return view('perfil', compact('contenido'));
    }

    public function create()
    {
        return redirect()->route('perfil.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'imagen' => 'nullable|image',
            'titulo' => 'required|string|max:40',
            'contenido' => 'required|string|max:1000',
            'prioridad' => 'required|integer',
            'posicionimg' => 'required|boolean',
        ]);

        $contenido = new Perfil();
        $contenido->titulo = $request->titulo;
        $contenido->contenido = $request->contenido;
        $contenido->prioridad = $request->prioridad;
        $contenido->posicionimg = $request->posicionimg;

        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen');
            $nombreArchivo = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('imagenes/perfil'), $nombreArchivo);
            $contenido->imagen = 'imagenes/perfil/' . $nombreArchivo;
        }

        $contenido->save();

        return redirect()->route('perfil.index')->with('success', 'Contenido creado correctamente');
    }

    public function edit($id)
    {
        $contenido = Perfil::findOrFail($id);
        return view('perfil.editar', compact('contenido'));
    }

    public function update(Request $request, $id)
    {
        $contenido = Perfil::findOrFail($id);

        $request->validate([
            'imagen' => 'nullable|image',
            'titulo' => 'required|string|max:40',
            'contenido' => 'required|string|max:1000',
            'prioridad' => 'required|integer',
            'posicionimg' => 'required|boolean',
        ]);

        $contenido->titulo = $request->titulo;
        $contenido->contenido = $request->contenido;
        $contenido->prioridad = $request->prioridad;
        $contenido->posicionimg = $request->posicionimg;

        if ($request->hasFile('imagen')) {
            if ($contenido->imagen && file_exists(public_path($contenido->imagen))) {
                unlink(public_path($contenido->imagen));
            }

            $file = $request->file('imagen');
            $nombreArchivo = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('imagenes/perfil'), $nombreArchivo);
            $contenido->imagen = 'imagenes/perfil/' . $nombreArchivo;
        }

        $contenido->save();

        return redirect()->route('perfil.index')->with('success', 'Contenido actualizado correctamente');
    }

    public function destroy($id)
    {
        $contenido = Perfil::findOrFail($id);

        if ($contenido->imagen && file_exists(public_path($contenido->imagen))) {
            unlink(public_path($contenido->imagen));
        }

        $contenido->delete();

        return redirect()->route('perfil.index')->with('success', 'Contenido eliminado correctamente');
    }
}
