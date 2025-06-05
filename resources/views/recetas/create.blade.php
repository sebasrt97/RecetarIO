<x-app-layout>
    <x-slot name="header">
        <h2 class="text-lg font-medium text-gray-800 dark:text-gray-100">Crear Nueva Receta</h2>
    </x-slot>

    <div class="py-4">
        <div class="max-w-xl mx-auto px-4">
            <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded p-4">
                <form class="receta-form" method="POST" action="{{ route('recetas.store') }}" enctype="multipart/form-data" class="space-y-4">
                    @csrf

                    <div>
                        <label for="nombre" class="block text-sm text-gray-700 dark:text-gray-300">Nombre de la Receta</label>
                        <input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}" required class="w-full border border-gray-300 dark:border-gray-600 px-2 py-1 rounded text-sm dark:bg-gray-800 dark:text-white">
                        @error('nombre') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="descripcion" class="block text-sm text-gray-700 dark:text-gray-300">Descripción</label>
                        <textarea id="descripcion" name="descripcion" rows="3" class="w-full border border-gray-300 dark:border-gray-600 px-2 py-1 rounded text-sm dark:bg-gray-800 dark:text-white">{{ old('descripcion') }}</textarea>
                        @error('descripcion') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="instrucciones" class="block text-sm text-gray-700 dark:text-gray-300">Instrucciones (una por línea)</label>
                        <textarea id="instrucciones" name="instrucciones" rows="5" required class="w-full border border-gray-300 dark:border-gray-600 px-2 py-1 rounded text-sm dark:bg-gray-800 dark:text-white">{{ old('instrucciones') }}</textarea>
                        @error('instrucciones') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm text-gray-700 dark:text-gray-300 mb-2">Ingredientes:</label>
                        <div id="ingredientes-contenedor"></div>
                        <button type="button" id="ingrediente-agregar-btn" class="mt-2 px-4 py-2 text-sm border border-gray-300 dark:border-gray-600 px-2 py-1 rounded text-sm dark:bg-gray-800 dark:text-white rounded">Añadir Ingrediente</button>
                        @error('ingredientes') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <template id="ingrediente-filas">
                        <div class="ingrediente-fila flex items-center space-x-2 mb-2 p-2 border border-gray-300 dark:border-gray-700 rounded">
                            <select name="ingredientes[INDEX][id]" required class="w-1/4 border border-gray-300 dark:border-gray-600 px-2 py-1 rounded text-sm dark:bg-gray-800 dark:text-white">
                                <option value="">-- Selecciona un Ingrediente --</option>
                                @isset($ingredientesDisponibles)
                                    @foreach($ingredientesDisponibles as $ingrediente)
                                        <option value="{{ $ingrediente->id }}">{{ $ingrediente->nombre }}</option>
                                    @endforeach
                                @endisset
                            </select>
                            <input type="number" name="ingredientes[INDEX][cantidad_bruta]" step="0.05" min="0.01" placeholder="Cantidad" required class="w-1/4 border border-gray-300 dark:border-gray-600 px-1 py-1 rounded text-sm dark:bg-gray-800 dark:text-white">
                            <select name="ingredientes[INDEX][unidad_receta_medida]" required class="w-1/4 border border-gray-300 dark:border-gray-600 px-2 py-1 rounded text-sm dark:bg-gray-800 dark:text-white">
                                <option value="">Medida:</option>
                                <option value="kg">Kilo</option>
                                <option value="l">Litros</option>
                                <option value="unidad">Unidad</option>
                            </select>
                            <button type="button" class="ingrediente-eliminar-btn w-1/4 ml-1 px-2 py-1 bg-red-500 dark:bg-red-700 text-white rounded text-xs">Eliminar</button>
                        </div>
                    </template>

                    <div>
                        <label for="tiempo_preparacion" class="block text-sm text-gray-700 dark:text-gray-300">Tiempo de Preparación (minutos)</label>
                        <input type="number" id="tiempo_preparacion" name="tiempo_preparacion" value="{{ old('tiempo_preparacion') }}" class="w-full border border-gray-300 dark:border-gray-600 px-2 py-1 rounded text-sm dark:bg-gray-800 dark:text-white">
                        @error('tiempo_preparacion') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="tiempo_coccion" class="block text-sm text-gray-700 dark:text-gray-300">Tiempo de Cocción (minutos)</label>
                        <input type="number" id="tiempo_coccion" name="tiempo_coccion" value="{{ old('tiempo_coccion') }}" class="w-full border border-gray-300 dark:border-gray-600 px-2 py-1 rounded text-sm dark:bg-gray-800 dark:text-white">
                        @error('tiempo_coccion') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="porciones" class="block text-sm text-gray-700 dark:text-gray-300">Porciones</label>
                        <input type="number" id="porciones" name="porciones" value="{{ old('porciones') }}" class="w-full border border-gray-300 dark:border-gray-600 px-2 py-1 rounded text-sm dark:bg-gray-800 dark:text-white">
                        @error('porciones') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="dificultad" class="block text-sm text-gray-700 dark:text-gray-300">Dificultad</label>
                        <select id="dificultad" name="dificultad" class="w-full border border-gray-300 dark:border-gray-600 px-2 py-1 rounded text-sm dark:bg-gray-800 dark:text-white">
                            <option value="fácil" {{ old('dificultad') == 'fácil' ? 'selected' : '' }}>Fácil</option>
                            <option value="media" {{ old('dificultad') == 'media' ? 'selected' : '' }}>Media</option>
                            <option value="difícil" {{ old('dificultad') == 'difícil' ? 'selected' : '' }}>Difícil</option>
                        </select>
                        @error('dificultad') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="margen_beneficio" class="block text-sm text-gray-700 dark:text-gray-300">Margen de Beneficio (%)</label>
                        <input type="number" id="margen_beneficio" name="margen_beneficio" value="{{ old('margen_beneficio') }}" step="0.01" min="0" class="w-full border border-gray-300 dark:border-gray-600 px-2 py-1 rounded text-sm dark:bg-gray-800 dark:text-white">
                        @error('margen_beneficio') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="imagen" class="block text-sm text-gray-700 dark:text-gray-300">Imagen de la Receta</label>
                        <input type="file" id="imagen" name="imagen" accept="image/*" class="text-sm text-gray-700 dark:text-gray-300">
                        @error('imagen') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="pt-2">
                        <button type="submit" class="px-4 py-2 text-sm bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-white rounded">Crear Receta</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const ingredienteContenedor = document.getElementById('ingredientes-contenedor');
            const botonAgregar = document.getElementById('ingrediente-agregar-btn');
            const plantilla = document.getElementById('ingrediente-filas');
            let index = 0;

            function agregarFila(ingredienteDato = null) {
                const nodo = plantilla.content.cloneNode(true);
                const fila = nodo.querySelector('.ingrediente-fila');

                fila.querySelectorAll('[name*="ingredientes[INDEX]"]').forEach(el => {
                    el.name = el.name.replace('INDEX', index);
                });

                if (ingredienteDato) {
                    fila.querySelector('[name$="[id]"]').value = ingredienteDato.id || '';
                    fila.querySelector('[name$="[cantidad_bruta]"]').value = ingredienteDato.cantidad_bruta || '';
                    fila.querySelector('[name$="[unidad_receta_medida]"]').value = ingredienteDato.unidad_receta_medida || '';
                }

                fila.querySelector('.ingrediente-eliminar-btn').addEventListener('click', () => fila.remove());
                ingredienteContenedor.appendChild(fila);
                index++;
            }

            const antiguos = @json(old('ingredientes', []));
            if (antiguos.length > 0) {
                antiguos.forEach(dato => agregarFila(dato));
            } else {
                agregarFila();
            }

            botonAgregar.addEventListener('click', () => agregarFila());
        });
    </script>
</x-app-layout>
