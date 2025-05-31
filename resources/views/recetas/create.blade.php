<x-app-layout>
    <x-slot name="header">
        <h2 class="text-lg font-medium text-gray-800 dark:text-gray-100">
            Crear Nueva Receta
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="max-w-4xl mx-auto px-4">
            <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded p-4">
                <form id="receta-form" method="POST" action="{{ route('recetas.store') }}" enctype="multipart/form-data" class="space-y-4">
                    @csrf

                    <div>
                        <label for="nombre" class="block text-sm text-gray-700 dark:text-gray-300">Nombre de la Receta</label>
                        <input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}"
                               required class="w-full border border-gray-300 dark:border-gray-600 px-2 py-1 rounded text-sm dark:bg-gray-800 dark:text-white">
                        @error('nombre') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="descripcion" class="block text-sm text-gray-700 dark:text-gray-300">Descripción</label>
                        <textarea id="descripcion" name="descripcion"
                                  class="w-full border border-gray-300 dark:border-gray-600 px-2 py-1 rounded text-sm dark:bg-gray-800 dark:text-white">{{ old('descripcion') }}</textarea>
                        @error('descripcion') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="instrucciones" class="block text-sm text-gray-700 dark:text-gray-300">Instrucciones</label>
                        <textarea id="instrucciones" name="instrucciones" required
                                  class="w-full border border-gray-300 dark:border-gray-600 px-2 py-1 rounded text-sm dark:bg-gray-800 dark:text-white">{{ old('instrucciones') }}</textarea>
                        @error('instrucciones') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="tiempo_preparacion" class="block text-sm text-gray-700 dark:text-gray-300">Tiempo de Preparación (minutos)</label>
                        <input type="number" id="tiempo_preparacion" name="tiempo_preparacion" value="{{ old('tiempo_preparacion') }}"
                               class="w-full border border-gray-300 dark:border-gray-600 px-2 py-1 rounded text-sm dark:bg-gray-800 dark:text-white">
                        @error('tiempo_preparacion') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="tiempo_coccion" class="block text-sm text-gray-700 dark:text-gray-300">Tiempo de Cocción (minutos)</label>
                        <input type="number" id="tiempo_coccion" name="tiempo_coccion" value="{{ old('tiempo_coccion') }}"
                               class="w-full border border-gray-300 dark:border-gray-600 px-2 py-1 rounded text-sm dark:bg-gray-800 dark:text-white">
                        @error('tiempo_coccion') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="porciones" class="block text-sm text-gray-700 dark:text-gray-300">Porciones</label>
                        <input type="number" id="porciones" name="porciones" value="{{ old('porciones') }}"
                               class="w-full border border-gray-300 dark:border-gray-600 px-2 py-1 rounded text-sm dark:bg-gray-800 dark:text-white">
                        @error('porciones') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="dificultad" class="block text-sm text-gray-700 dark:text-gray-300">Dificultad</label>
                        <select id="dificultad" name="dificultad"
                                class="w-full border border-gray-300 dark:border-gray-600 px-2 py-1 rounded text-sm dark:bg-gray-800 dark:text-white">
                            <option value="">Selecciona una dificultad</option>
                            <option value="fácil" {{ old('dificultad') == 'fácil' ? 'selected' : '' }}>Fácil</option>
                            <option value="media" {{ old('dificultad') == 'media' ? 'selected' : '' }}>Media</option>
                            <option value="difícil" {{ old('dificultad') == 'difícil' ? 'selected' : '' }}>Difícil</option>
                        </select>
                        @error('dificultad') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="ingredientes" class="block text-sm text-gray-700 dark:text-gray-300">Ingredientes</label>
                        <textarea id="ingredientes" name="ingredientes"
                                  class="w-full border border-gray-300 dark:border-gray-600 px-2 py-1 rounded text-sm dark:bg-gray-800 dark:text-white">{{ old('ingredientes') }}</textarea>
                        @error('ingredientes') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="imagen" class="block text-sm text-gray-700 dark:text-gray-300">Imagen de la Receta</label>
                        <input type="file" id="imagen" name="imagen" accept="image/*"
                               class="w-full text-sm text-gray-700 dark:text-gray-300">
                        @error('imagen') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="pt-2">
                        <button type="submit"
                                class="px-4 py-2 text-sm bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-white rounded">
                            Guardar Receta
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
