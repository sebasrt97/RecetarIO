<?php

namespace App\Http\Controllers;

use App\Models\Receta;
use App\Models\Ingrediente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;



class RecetaController extends Controller
{

    public function index()
    {
        $recetas = Receta::where('user_id', Auth::id())->paginate(10); // Con esto se controla que solo se muestren las recetas del usuario autenticado
        return view('recetas.index', compact('recetas'));
    }

    public function create()
    {
        // NO HAY $receta AQUÍ, ya que es para crear una nueva.
        // Se cargan los ingredientes disponibles para el SELECT en el formulario.
        $ingredientesDisponibles = Ingrediente::orderBy('nombre')->get(); 
        
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
            'imagen' => 'nullable|image|max:2048', // 2MB max

            
            'ingredientes' => 'nullable|array', // El campo principal debe ser un array
            'ingredientes.*.id' => 'required|integer|exists:ingredientes,id', //Cada ingrediente debe tener un ID válido
            'ingredientes.*.cantidad_bruta' => 'required|numeric|min:0.01',
            'ingredientes.*.unidad_receta_medida' => 'required|string|max:50',
        ]);

        // Transformar las cadenas de instrucciones en arrays antes de JSON
        $instruccionesArray = array_map('trim', explode("\n", $valido['instrucciones']));
        $instruccionesArray = array_filter($instruccionesArray); // Eliminar posibles líneas vacías
        $instruccionesArray = array_values($instruccionesArray); // Reindexar el array

        
        $imageRuta = null; 
        if ($request->hasFile('imagen') && $request->file('imagen')->isValid()) {
            $imageRuta = $request->file('imagen')->store('imagenes', 'public');
        }

        $receta = Receta::create([
            'user_id' => auth()->id(), // Asignar el ID del usuario autenticado
            'nombre' => $valido['nombre'],
            'descripcion' => $valido['descripcion'],
            'instrucciones' => json_encode($instruccionesArray), // Almacenar como JSON
            'tiempo_preparacion' => $valido['tiempo_preparacion'],
            'tiempo_coccion' => $valido['tiempo_coccion'],
            'porciones' => $valido['porciones'] ?? 1, // Default si es null
            'dificultad' => $valido['dificultad'] ?? 'fácil', // Default si es null
            'margen_beneficio' => $valido['margen_beneficio'] ?? 0, // Default si es null
            'imagen' => $imageRuta
        ]);

        // Sincronizar los ingredientes con la receta
        if (!empty($valido['ingredientes'])) {
            $ingredientesArray = [];
            foreach ($valido['ingredientes'] as $ingrediente) {
                $ingredientesArray[$ingrediente['id']] = [
                    'cantidad_bruta' => $ingrediente['cantidad_bruta'],
                    'unidad_receta_medida' => $ingrediente['unidad_receta_medida'],
                ];
            }
            $receta->ingredientes()->sync($ingredientesArray);
        } else {
            // Si no se enviaron ingredientes, desvincular todos los existentes (si los hubiera)
            $receta->ingredientes()->sync([]);
        }

        return redirect()->route('recetas.index')->with('success', 'Receta creada exitosamente.'); 
    }

    /**
     * Display the specified resource.
     */
    public function show(Receta $receta)
    {
        $receta->load('ingredientes.alergenos'); 
        return view('recetas.show', compact('receta'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Receta $receta)
    {
        // Asegúrate de que solo el propietario puede editar la receta
        if (Auth::id() !== $receta->user_id) {
            abort(403, 'No tienes permiso para editar esta receta.');
        }

        $receta->load('ingredientes.alergenos'); 
        $ingredientesDisponibles = Ingrediente::orderBy('nombre')->get(); 
        return view('recetas.edit', compact('receta', 'ingredientesDisponibles'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Receta $receta)
    {
        // Asegúrate de que solo el propietario puede actualizar la receta
        if (Auth::id() !== $receta->user_id) {
            abort(403, 'No tienes permiso para actualizar esta receta.');
        }

        // Validar los datos de la solicitud
        $valido = $request->validate([
            'nombre' => 'required|string|max:255|unique:recetas,nombre,' . $receta->id, 
            'descripcion' => 'nullable|string',
            'instrucciones' => 'required|string',
            'tiempo_preparacion' => 'nullable|integer',
            'tiempo_coccion' => 'nullable|integer',
            'porciones' => 'nullable|integer|min:1',
            'dificultad' => 'nullable|string|in:fácil,media,difícil',
            'margen_beneficio' => 'nullable|numeric|min:0',
            'imagen' => 'nullable|image|max:2048', // 2MB max

            'ingredientes' => 'nullable|array', 
            'ingredientes.*.id' => 'required|integer|exists:ingredientes,id', 
            'ingredientes.*.cantidad_bruta' => 'required|numeric|min:0.01',
            'ingredientes.*.unidad_receta_medida' => 'required|string|max:50',
        ]);

        // Transformar las cadenas de instrucciones en arrays antes de JSON
        $instruccionesArray = array_map('trim', explode("\n", $valido['instrucciones']));
        $instruccionesArray = array_filter($instruccionesArray);
        $instruccionesArray = array_values($instruccionesArray); 

        // Manejo de la imagen: borra la antigua si se sube una nueva
        $imageRuta = $receta->imagen; // Mantener la imagen existente por defecto
        if ($request->hasFile('imagen') && $request->file('imagen')->isValid()) {
            // Si hay una imagen antigua, borrarla
            if ($receta->imagen) {
                Storage::disk('public')->delete($receta->imagen);
            }
            $imageRuta = $request->file('imagen')->store('imagenes', 'public');
        } else if (isset($valido['imagen']) && is_null($valido['imagen'])) {
            // Si el campo 'imagen' se envió como nulo (ej. checkbox "eliminar imagen" marcado)
            if ($receta->imagen) {
                Storage::disk('public')->delete($receta->imagen);
            }
            $imageRuta = null; // Marcar como sin imagen
        }

        $receta->update([
            'nombre' => $valido['nombre'],
            'descripcion' => $valido['descripcion'],
            'instrucciones' => json_encode($instruccionesArray),
            'tiempo_preparacion' => $valido['tiempo_preparacion'],
            'tiempo_coccion' => $valido['tiempo_coccion'],
            'porciones' => $valido['porciones'] ?? 1,
            'dificultad' => $valido['dificultad'] ?? 'fácil',
            'margen_beneficio' => $valido['margen_beneficio'] ?? 0,
            'imagen' => $imageRuta // Usar la ruta determinada
        ]);

        if (!empty($valido['ingredientes'])) {
            $ingredientesArray = [];
            foreach ($valido['ingredientes'] as $ingrediente) {
                $ingredientesArray[$ingrediente['id']] = [
                    'cantidad_bruta' => $ingrediente['cantidad_bruta'],
                    'unidad_receta_medida' => $ingrediente['unidad_receta_medida'],
                ];
            }
            $receta->ingredientes()->sync($ingredientesArray);
        } else {
            // Si el array de ingredientes está vacío o es null, desvincular todos los ingredientes existentes
            $receta->ingredientes()->sync([]);
        }

        return redirect()->route('recetas.index')->with('success', 'Receta actualizada exitosamente.');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Receta $receta)
    {
        // Asegúrate de que solo el propietario puede eliminar la receta
        if (Auth::id() !== $receta->user_id) {
            abort(403, 'No tienes permiso para eliminar esta receta.');
        }
        
        // Eliminar la imagen asociada antes de eliminar la receta
        if ($receta->imagen) {
            Storage::disk('public')->delete($receta->imagen);
        }

        $receta->delete();
        return redirect()->route('recetas.index')->with('success', 'Receta eliminada exitosamente.');
    }

    public function search(Request $request)
    {
        // Asumiendo que esta búsqueda es para las recetas del usuario logueado
        $query = $request->input('query');
        $recetas = Receta::where('user_id', Auth::id())
                        ->where('nombre', 'like', '%' . $query . '%')
                        ->get();
        return view('recetas.index', compact('recetas'));
    }
    
}