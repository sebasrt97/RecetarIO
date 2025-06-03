<?php

namespace App\Http\Controllers;

use App\Models\Receta;
use App\Models\Ingrediente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


use Barryvdh\DomPDF\Facade\Pdf;



class RecetaController extends Controller
{

    public function index()
    {
        $recetas = Receta::where('user_id', Auth::id())->paginate(10); // Con esto se controla que solo se muestren las recetas del usuario autenticado
        return view('recetas.index', compact('recetas'));
    }

    public function create()
    {
        $ingredientesDisponibles = Ingrediente::orderBy('nombre')->get(); // Obtener todos los ingredientes disponibles
        return view('recetas.create', compact('ingredientesDisponibles'));
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
            'instrucciones' => 'required|string',
            'tiempo_preparacion' => 'nullable|integer',
            'tiempo_coccion' => 'nullable|integer',
            'porciones' => 'nullable|integer|min:1',
            'dificultad' => 'nullable|string|in:fácil,media,difícil',
            'margen_beneficio' => 'nullable|numeric|min:0',
            'imagen' => 'nullable|image|max:2048',

            
            'ingredientes' => 'nullable|array', // El campo principal debe ser un array
            'ingredientes.*.id' => 'required|integer|exists:ingredientes,id', //Cada ingrediente debe tener un ID válido
            'ingredientes.*.cantidad_bruta' => 'required|numeric|min:0.01',
            'ingredientes.*.unidad_receta_medida' => 'required|string|max:50',
        ]);

        // Transformar las cadenas de instrucciones e ingredientes en arrays antes de JSON
        $instruccionesArray = array_map('trim', explode("\n", $valido['instrucciones']));
        // Eliminar posibles líneas vacías si el usuario deja saltos de línea al final
        $instruccionesArray = array_filter($instruccionesArray);
        $instruccionesArray = array_values($instruccionesArray);

        
        $imageRuta = null; 
             if ($request->hasFile('imagen') && $request->file('imagen')->isValid()) {
                  // Solo intentamos guardar la imagen si se ha subido un archivo válido
                $imageRuta = $request->file('imagen')->store('imagenes', 'public');
            }

        $receta = Receta::create([
            'user_id' => auth()->id(), // Asignar el ID del usuario autenticado
            'nombre' => $valido['nombre'],
            'descripcion' => $valido['descripcion'],
            'instrucciones' =>json_encode($instruccionesArray),
            'tiempo_preparacion' => $valido['tiempo_preparacion'],
            'tiempo_coccion' => $valido['tiempo_coccion'],
            'porciones' => $valido['porciones'] ?? 1,
            'dificultad' => $valido['dificultad'] ?? 'fácil',
            'margen_beneficio' => $valido['margen_beneficio'] ?? 0,
            'imagen' => $imageRuta
        ]);

        //sincoronizar los ingredientes con la receta

        if(!empty($valido['ingredientes'])) {
            $ingredientesArray = [];
            foreach ($valido['ingredientes'] as $ingrediente) {
                $ingredientesArray[$ingrediente['id']] = [
                    'cantidad_bruta' => $ingrediente['cantidad_bruta'],
                    'unidad_receta_medida' => $ingrediente['unidad_receta_medida'],
                ];
            }
            $receta->ingredientes()->sync($ingredientesArray);
        }

        return redirect()->route('recetas.index')->with('Success', 'Receta creada exitosamente.');  
    }

    /**
     * Display the specified resource.
     */
    public function show(Receta $receta)
    {
        $receta->load('ingredientes.alergenos'); // Cargar los ingredientes relacionados si es necesario
        return view('recetas.show', compact('receta'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Receta $receta)
    {
        $receta->load('ingredientes.alergenos'); // Cargar los ingredientes y alergenos relacionados si es necesario

        $ingredientesDisponibles= Ingrediente::orderBy('nombre')->get(); // Obtener todos los ingredientes disponibles para el formulario de edición
        return view('recetas.edit', compact('receta', 'ingredientesDisponibles'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Receta $receta)
    {
        // Validar los datos de la solicitud
        $valido = $request->validate([
            'nombre' => 'required|string|max:255|unique:recetas,nombre,' . $receta->id, //excluye la receta actual de la validación de unicidad
            'descripcion' => 'nullable|string',
            'instrucciones' => 'required|string',
            'tiempo_preparacion' => 'nullable|integer',
            'tiempo_coccion' => 'nullable|integer',
            'porciones' => 'nullable|integer|min:1',
            'dificultad' => 'nullable|string|in:fácil,media,difícil',
            'margen_beneficio' => 'nullable|numeric|min:0',
            'imagen' => 'nullable|image|max:2048',

            'ingredientes' => 'nullable|array', // El campo principal debe ser un array
            'ingredientes.*.id' => 'required|integer|exists:ingredientes,id', //Cada ingrediente debe tener un ID válido
            'ingredientes.*.cantidad_bruta' => 'required|numeric|min:0.01',
            'ingredientes.*.unidad_receta_medida' => 'required|string|max:50',

        ]);
        // Transformar las cadenas de instrucciones en arrays antes de JSON
        $instruccionesArray = array_map('trim', explode("\n", $valido['instrucciones']));
        $instruccionesArray = array_filter($instruccionesArray);
        $instruccionesArray = array_values($instruccionesArray); 

        $receta->update([
            'nombre' => $valido['nombre'],
            'descripcion' => $valido['descripcion'],
            'instrucciones' => json_encode($instruccionesArray),
            'tiempo_preparacion' => $valido['tiempo_preparacion'],
            'tiempo_coccion' => $valido['tiempo_coccion'],
            'porciones' => $valido['porciones'] ?? 1,
            'dificultad' => $valido['dificultad'] ?? 'fácil',
            'margen_beneficio' => $valido['margen_beneficio'] ?? 0,
            'imagen' => $valido['imagen'] ? $request->file('imagen')->store('imagenes', 'public') : $receta->imagen,
        ]);

         if(!empty($valido['ingredientes'])) {
            $ingredientesArray = [];
            foreach ($valido['ingredientes'] as $ingrediente) {
                $ingredientesArray[$ingrediente['id']] = [
                    'cantidad_bruta' => $ingrediente['cantidad_bruta'],
                    'unidad_receta_medida' => $ingrediente['unidad_receta_medida'],
                ];
            }
            $receta->ingredientes()->sync($ingredientesArray);
            //toma un array asociativo donde las claves son los IDs de los ingredientes y los valores son un array con 
            //los datos de la tabla pivote (cantidad_bruta, unidad_receta_medida).
        }

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

    ///////////////////// DOMPDF
    
    public function generarPDF(Receta $receta){
        $receta->load('ingredientes.alergenos');

        $pdf = Pdf::loadView('pdfs.receta', compact('receta'));

        $pdf->setPaper('A4');

        return $pdf->download('receta_' . $receta->nombre .'.pdf');

    }

    
}
