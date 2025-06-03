<x-app-layout>
    <x-slot name="header">
        <h2 class="text-lg font-medium text-gray-800 dark:text-gray-100">Editar Receta: {{ $receta->nombre }}</h2>
    </x-slot>

    <div class="py-4">
        <div class="max-w-xl mx-auto px-4">
            <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded p-4">
                <form method="POST" action="{{ route('recetas.update', $receta) }}" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    @method('PUT')

                    @php
                        function input($label, $id, $type, $name, $value, $required = false) {
                            $req = $required ? 'required' : '';
                            return <<<HTML
                            <div>
                                <label for="$id" class="block text-sm text-gray-700 dark:text-gray-300">$label</label>
                                <input type="$type" id="$id" name="$name" value="$value" $req
                                       class="w-full border border-gray-300 dark:border-gray-600 px-2 py-1 rounded text-sm dark:bg-gray-800 dark:text-white">
                                @error('$name') <span class="text-red-600 text-sm">{{ \$message }}</span> @enderror
                            </div>
                            HTML;
                        }

                        function textarea($label, $id, $name, $content, $required = false) {
                            $req = $required ? 'required' : '';
                            return <<<HTML
                            <div>
                                <label for="$id" class="block text-sm text-gray-700 dark:text-gray-300">$label</label>
                                <textarea id="$id" name="$name" $req
                                          class="w-full border border-gray-300 dark:border-gray-600 px-2 py-1 rounded text-sm dark:bg-gray-800 dark:text-white">$content</textarea>
                                @error('$name') <span class="text-red-600 text-sm">{{ \$message }}</span> @enderror
                            </div>
                            HTML;
                        }

                        function select($label, $id, $name, $selected) {
                            $opts = ['fácil', 'media', 'difícil'];
                            $options = "<option value=\"\">Selecciona una dificultad</option>";
                            foreach ($opts as $opt) {
                                $sel = $selected === $opt ? 'selected' : '';
                                $options .= "<option value=\"$opt\" $sel>" . ucfirst($opt) . "</option>";
                            }
                            return <<<HTML
                            <div>
                                <label for="$id" class="block text-sm text-gray-700 dark:text-gray-300">$label</label>
                                <select id="$id" name="$name"
                                        class="w-full border border-gray-300 dark:border-gray-600 px-2 py-1 rounded text-sm dark:bg-gray-800 dark:text-white">
                                    $options
                                </select>
                                @error('$name') <span class="text-red-600 text-sm">{{ \$message }}</span> @enderror
                            </div>
                            HTML;
                        }
                    @endphp

                    {!! input('Nombre de la Receta', 'nombre', 'text', 'nombre', old('nombre', $receta->nombre), true) !!}
                    {!! textarea('Descripción', 'descripcion', 'descripcion', old('descripcion', $receta->descripcion)) !!}
                    {!! textarea('Instrucciones', 'instrucciones', 'instrucciones', old('instrucciones', implode("\n", $receta->instrucciones ?? [])), true) !!}
                    {!! input('Tiempo de Preparación (minutos)', 'tiempo_preparacion', 'number', 'tiempo_preparacion', old('tiempo_preparacion', $receta->tiempo_preparacion)) !!}
                    {!! input('Tiempo de Cocción (minutos)', 'tiempo_coccion', 'number', 'tiempo_coccion', old('tiempo_coccion', $receta->tiempo_coccion)) !!}
                    {!! input('Porciones', 'porciones', 'number', 'porciones', old('porciones', $receta->porciones)) !!}
                    {!! select('Dificultad', 'dificultad', 'dificultad', old('dificultad', $receta->dificultad)) !!}
                    {!! textarea('Ingredientes', 'ingredientes', 'ingredientes', old('ingredientes', implode("\n", $receta->ingredientes ?? []))) !!}

                    <div>
                        <label for="imagen" class="block text-sm text-gray-700 dark:text-gray-300">Imagen de la Receta</label>
                        @if ($receta->imagen)
                            <img src="{{ asset('storage/' . $receta->imagen) }}" alt="Imagen actual de la receta" class="w-48 mb-2 rounded">
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
</x-app-layout>
