<x-app-layout>
    <x-slot name="header">
        <h2 class="text-lg font-medium text-gray-800 dark:text-gray-100">Editar Receta: {{ $receta->nombre }}</h2>
    </x-slot>

    <div class="py-4">
        <div class="max-w-xl mx-auto px-4">
            <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded p-4">
                <form class="receta-form" method="POST" action="{{ route('recetas.update', $receta) }}" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <label for="nombre" class="block text-sm text-gray-700 dark:text-gray-300">Nombre de la Receta</label>
                        <input type="text" id="nombre" name="nombre" value="{{ old('nombre', $receta->nombre) }}" required
                               class="w-full border border-gray-300 dark:border-gray-600 px-2 py-1 rounded text-sm dark:bg-gray-800 dark:text-white">
                        @error('nombre') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="descripcion" class="block text-sm text-gray-700 dark:text-gray-300">Descripción</label>
                        <textarea id="descripcion" name="descripcion" rows="3"
                                  class="w-full border border-gray-300 dark:border-gray-600 px-2 py-1 rounded text-sm dark:bg-gray-800 dark:text-white">{{ old('descripcion', $receta->descripcion) }}</textarea>
                        @error('descripcion') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                    </div>
                    
                     <div>
                        <label for="instrucciones" class="block text-sm text-gray-700 dark:text-gray-300">Instrucciones (una por línea)</label>
                        <textarea id="instrucciones" name="instrucciones" rows="5" required
                                  class="w-full border border-gray-300 dark:border-gray-600 px-2 py-1 rounded text-sm dark:bg-gray-800 dark:text-white"
                                  >{{ old('instrucciones', is_array($receta->instrucciones) ? implode("\n", $receta->instrucciones) : '') }}</textarea>
                        @error('instrucciones') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm text-gray-700 dark:text-gray-300 mb-2">Ingredientes:</label>
                        <div id="ingredientes-contenedor">
                            </div>
                        <button type="button" id="ingrediente-agregar-btn"
                                class="mt-2 px-4 py-2 text-sm bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-white rounded">
                        Añadir Ingrediente
                        </button>
                        @error('ingredientes') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                    </div>
                    <template id="ingrediente-filas">
                        <div class="ingrediente-fila flex items-center space-x-2 mb-2 p-2 border border-gray-300 dark:border-gray-700 rounded">
                            <select name="ingredientes[INDEX][id]" required
                                    class="w-1/3 border border-gray-300 dark:border-gray-600 px-2 py-1 rounded text-sm dark:bg-gray-800 dark:text-white">
                                <option value="">-- Selecciona un Ingrediente --</option>
                                </select>
                            <input type="number" name="ingredientes[INDEX][cantidad_bruta]" step="0.01" min="0.01" placeholder="Cantidad" required
                                        class="w-1/4 border border-gray-300 dark:border-gray-600 px-2 py-1 rounded text-sm dark:bg-gray-800 dark:text-white">
                            <select name="ingredientes[INDEX][unidad_receta_medida]" required class="w-1/4 border border-gray-300 dark:border-gray-600 px-2 py-1 rounded text-sm dark:bg-gray-800 dark:text-white">
                                <option value="">Medida:</option>
                                <option value="kg">Kilo</option>
                                <option value="l">Litros</option>
                                <option value="unidad">Unidad</option>
                            </select>
                            <button type="button" class="ingrediente-eliminar-btn w-1/4 ml-1 px-2 py-1 bg-red-500 text-white rounded text-xs">
                                Eliminar
                            </button>
                        </div>
                    </template>
                    
                    <div>
                        <label for="tiempo_preparacion" class="block text-sm text-gray-700 dark:text-gray-300">Tiempo de Preparación (minutos)</label>
                        <input type="number" id="tiempo_preparacion" name="tiempo_preparacion" value="{{ old('tiempo_preparacion', $receta->tiempo_preparacion) }}"
                               class="w-full border border-gray-300 dark:border-gray-600 px-2 py-1 rounded text-sm dark:bg-gray-800 dark:text-white">
                        @error('tiempo_preparacion') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="tiempo_coccion" class="block text-sm text-gray-700 dark:text-gray-300">Tiempo de Cocción (minutos)</label>
                        <input type="number" id="tiempo_coccion" name="tiempo_coccion" value="{{ old('tiempo_coccion', $receta->tiempo_coccion) }}"
                               class="w-full border border-gray-300 dark:border-gray-600 px-2 py-1 rounded text-sm dark:bg-gray-800 dark:text-white">
                        @error('tiempo_coccion') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="porciones" class="block text-sm text-gray-700 dark:text-gray-300">Porciones</label>
                        <input type="number" id="porciones" name="porciones" value="{{ old('porciones', $receta->porciones) }}"
                               class="w-full border border-gray-300 dark:border-gray-600 px-2 py-1 rounded text-sm dark:bg-gray-800 dark:text-white">
                        @error('porciones') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="dificultad" class="block text-sm text-gray-700 dark:text-gray-300">Dificultad</label>
                        <select id="dificultad" name="dificultad"
                                class="w-full border border-gray-300 dark:border-gray-600 px-2 py-1 rounded text-sm dark:bg-gray-800 dark:text-white">
                            <option value="fácil" {{ old('dificultad', $receta->dificultad) == 'fácil' ? 'selected' : '' }}>Fácil</option>
                            <option value="media" {{ old('dificultad', $receta->dificultad) == 'media' ? 'selected' : '' }}>Media</option>
                            <option value="difícil" {{ old('dificultad', $receta->dificultad) == 'difícil' ? 'selected' : '' }}>Difícil</option>
                        </select>
                        @error('dificultad') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="margen_beneficio" class="block text-sm text-gray-700 dark:text-gray-300">Margen de Beneficio (%)</label>
                        <input type="number" id="margen_beneficio" name="margen_beneficio" value="{{ old('margen_beneficio', $receta->margen_beneficio) }}"
                               step="0.01" min="0"
                               class="w-full border border-gray-300 dark:border-gray-600 px-2 py-1 rounded text-sm dark:bg-gray-800 dark:text-white">
                        @error('margen_beneficio') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                    </div>                       

                    <div>
                        <label for="imagen" class="block text-sm text-gray-700 dark:text-gray-300">Imagen de la Receta</label>
                        @if ($receta->imagen)
                            <img src="{{ asset('storage/imagenes/' . $receta->imagen) }}" alt="Imagen actual de la receta" class="w-48 mb-2 rounded">
                            <p class="text-sm text-gray-600 dark:text-gray-400">Cambiar imagen:</p>
                        @endif
                        <input type="file" id="imagen" name="imagen" accept="image/*"
                            class="text-sm text-gray-700 dark:text-gray-300">
                        @error('imagen') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="pt-2">
                        <button type="submit"
                                class="px-4 py-2 text-sm bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-white rounded">
                            Actualizar Receta
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

 {{-- Script para la lógica de ingredientes dinámicos --}}
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const ingredienteContenedor = document.getElementById('ingredientes-contenedor');
        const ingredienteAgregar = document.getElementById('ingrediente-agregar-btn');
        const ingredienteFilas = document.getElementById('ingrediente-filas');
        let ingrediente = 0;

        const ingredienteAntiguo = @json(old('ingredientes', []));
        const ingredienteExiste = @json($receta->ingredientes->map(function($relacion) {return ['ingrediente_id' => $relacion->id,'cantidad_bruta' => $relacion->pivot->cantidad_bruta,'unidad_receta_medida' => $relacion->pivot->unidad_receta_medida];}));
        const ingredientesDisponiblesJs = @json($ingredientesDisponibles); // ¡Aquí está!

        function añadirIngrediente(ingredienteDato = null) {
            const fila = ingredienteFilas.content.cloneNode(true);
            const filaDiv = fila.querySelector('.ingrediente-fila');

            // Actualizar los atributos 'name' con el índice correcto
            filaDiv.querySelectorAll('[name*="ingredientes[INDEX]"]').forEach(input => {
                input.name = input.name.replace('INDEX', ingrediente);
            });

            // Generar las opciones del select de ingredientes
            const selectId = filaDiv.querySelector('select[name*="[id]"]');
            if (selectId) {
                // Iterar sobre los ingredientes disponibles en JS y crear las <option>
                ingredientesDisponiblesJs.forEach(ing => {
                    const option = document.createElement('option');
                    option.value = ing.id;
                    option.textContent = ing.nombre;
                    selectId.appendChild(option);
                });

                // Seleccionar el ingrediente correcto si se proporciona data
                if (ingredienteDato && (ingredienteDato.ingrediente_id || ingredienteDato.id)) {
                     selectId.value = ingredienteDato.ingrediente_id || ingredienteDato.id;
                }
            }


            // Rellenar la fila si se proporciona data (para old() values o ingredientes existentes)
            if (ingredienteDato) {
                const inputCantidad = filaDiv.querySelector('input[name*="[cantidad_bruta]"]');
                const inputUnidad = filaDiv.querySelector('input[name*="[unidad_receta_medida]"]');

                if (inputCantidad) inputCantidad.value = ingredienteDato.cantidad_bruta || '';
                if (inputUnidad) inputUnidad.value = ingredienteDato.unidad_receta_medida || '';
            }

            if(ingredienteDato){
                const selectMedida = filaDiv.querySelector('select[name*="[unidad_receta_medida]"]');
                if (selectMedida && ingredienteDato.unidad_receta_medida) {
                    selectMedida.value = ingredienteDato.unidad_receta_medida;
                }   
            }

            // Añadir el listener para el botón de eliminar
            filaDiv.querySelector('.ingrediente-eliminar-btn').addEventListener('click', function() {
                filaDiv.remove();
            });

            ingredienteContenedor.appendChild(filaDiv);
            ingrediente++;
        }

        let ingredienteArray = [];
        if (ingredienteAntiguo.length > 0) {
            ingredienteArray = ingredienteAntiguo;
        } else if (ingredienteExiste.length > 0) {
            ingredienteArray = ingredienteExiste;
        }

        if (ingredienteArray.length > 0) {
            ingredienteArray.forEach(ingrediente => añadirIngrediente(ingrediente));
        } else {
            añadirIngrediente(); // Si no hay ninguno, añadir una fila vacía para empezar
        }

        ingredienteAgregar.addEventListener('click', function() {
            añadirIngrediente();
	});
	});
</script>
</x-app-layout>