<?php

namespace App\Http\Controllers;

use App\Models\Receta;
use Illuminate\Http\Request;

class RecetaController extends Controller
{

    public function index()
    {
        $recetas = Receta::all();
        return view('recetas.index', compact('recetas'));
    }

    public function create()
    {
        return view('recetas.create');
    }

    /**
     * Store seria el método que se encarga de almacenar una nueva receta en la base de datos.
     * Seria la validacion de los recibidos de la vista create.blade.php o HTTP POST
     */
    
    public function store(Request $request)
    {
        $valido = $request->validate([
            'nombre' => 'required|string|max:255|unique:recetas',
            'descripcion' => 'nullable|string',
            'instrucciones' => 'required|array',
            'tiempo_preparacion' => 'nullable|integer',
            'ingredientes' => 'nullable|array',
            'tiempo_coccion' => 'nullable|integer',
            'porciones' => 'nullable|integer|min:1',
            'dificultad' => 'nullable|string|in:fácil,media,difícil',
            'imagen' => 'nullable|image|max:2048',
        ]);

        $receta = Receta::create([
            'user_id' => auth()->id(), // Asignar el ID del usuario autenticado
            'nombre' => $valido['nombre'],
            'descripcion' => $valido['descripcion'],
            'instrucciones' => $valido['instrucciones'],
            'tiempo_preparacion' => $valido['tiempo_preparacion'],
            'ingredientes' => $valido['ingredientes'] ?? [],
            'tiempo_coccion' => $valido['tiempo_coccion'],
            'porciones' => $valido['porciones'] ?? 1,
            'dificultad' => $valido['dificultad'] ?? 'fácil',
            'imagen' => $valido['imagen'] ? $request->file('imagen')->store('imagenes', 'public') : null,
        ]);

        return redirect()->route('recetas.index')->with('Success', 'Receta creada exitosamente.');  
    }

    /**
     * Display the specified resource.
     */
    public function show(Receta $receta)
    {
        return view('recetas.show', compact('receta'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Receta $receta)
    {
        return view('recetas.edit', compact('receta'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Receta $receta)
    {
        $valido = $request->validate([
            'nombre' => 'required|string|max:255|unique:recetas,nombre,' . $receta->id,
            'descripcion' => 'nullable|string',
            'instrucciones' => 'required|array',
            'tiempo_preparacion' => 'nullable|integer',
            'ingredientes' => 'nullable|array',
            'tiempo_coccion' => 'nullable|integer',
            'porciones' => 'nullable|integer|min:1',
            'dificultad' => 'nullable|string|in:fácil,media,difícil',
            'imagen' => 'nullable|image|max:2048',
        ]);

        $receta->update([
            'nombre' => $valido['nombre'],
            'descripcion' => $valido['descripcion'],
            'instrucciones' => $valido['instrucciones'],
            'tiempo_preparacion' => $valido['tiempo_preparacion'],
            'ingredientes' => $valido['ingredientes'] ?? [],
            'tiempo_coccion' => $valido['tiempo_coccion'],
            'porciones' => $valido['porciones'] ?? 1,
            'dificultad' => $valido['dificultad'] ?? 'fácil',
            'imagen' => $valido['imagen'] ? $request->file('imagen')->store('imagenes', 'public') : $receta->imagen,
        ]);

        return redirect()->route('recetas.index')->with('success', 'Receta actualizada exitosamente.');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Receta $receta)
    {
        $receta->delete();
        return redirect()->route('recetas.index')->with('success', 'Receta eliminada exitosamente.');
    }
    public function search(Request $request)
    {
        $query = $request->input('query');
        $recetas = Receta::where('nombre', 'like', '%' . $query . '%')->get();
        return view('recetas.index', compact('recetas'));
    }
    
}
