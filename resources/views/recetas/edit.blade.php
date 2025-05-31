<x-app-layout>
    <x-slot name="header">
        <h2>Editar Receta: {{ $receta->name }}</h2>
    </x-slot>

    <div>
        <div>
            <div>
                <form method="POST" action="{{ route('recetas.update', $receta) }}">
                    @csrf
                    @method('PUT')

                    <div>
                        <label for="name">Nombre de la Receta:</label><br>
                        <input type="text" id="name" name="name" value="{{ old('name', $receta->name) }}" required><br>
                        @error('name') <span style="color: red;">{{ $message }}</span><br> @enderror
                    </div>

                    <div style="margin-top: 10px;">
                        <label for="description">Descripción:</label><br>
                        <textarea id="description" name="description">{{ old('description', $receta->description) }}</textarea><br>
                        @error('description') <span style="color: red;">{{ $message }}</span><br> @enderror
                    </div>

                    <div style="margin-top: 10px;">
                        <label for="instructions">Instrucciones:</label><br>
                        <textarea id="instructions" name="instructions" required>{{ old('instructions', $receta->instructions) }}</textarea><br>
                        @error('instructions') <span style="color: red;">{{ $message }}</span><br> @enderror
                    </div>

                    <div style="margin-top: 10px;">
                        <label for="preparation_time">Tiempo de Preparación (minutos):</label><br>
                        <input type="number" id="preparation_time" name="preparation_time" value="{{ old('preparation_time', $receta->preparation_time) }}"><br>
                        @error('preparation_time') <span style="color: red;">{{ $message }}</span><br> @enderror
                    </div>

                    <div style="margin-top: 10px;">
                        <label for="cooking_time">Tiempo de Cocción (minutos):</label><br>
                        <input type="number" id="cooking_time" name="cooking_time" value="{{ old('cooking_time', $receta->cooking_time) }}"><br>
                        @error('cooking_time') <span style="color: red;">{{ $message }}</span><br> @enderror
                    </div>

                    <div style="margin-top: 10px;">
                        <label for="servings">Porciones:</label><br>
                        <input type="number" id="servings" name="servings" value="{{ old('servings', $receta->servings) }}"><br>
                        @error('servings') <span style="color: red;">{{ $message }}</span><br> @enderror
                    </div>

                    <div style="margin-top: 10px;">
                        <label for="difficulty">Dificultad:</label><br>
                        <select id="difficulty" name="difficulty">
                            <option value="">Selecciona una dificultad</option>
                            <option value="Fácil" {{ old('difficulty', $receta->difficulty) == 'Fácil' ? 'selected' : '' }}>Fácil</option>
                            <option value="Media" {{ old('difficulty', $receta->difficulty) == 'Media' ? 'selected' : '' }}>Media</option>
                            <option value="Difícil" {{ old('difficulty', $receta->difficulty) == 'Difícil' ? 'selected' : '' }}>Difícil</option>
                        </select><br>
                        @error('difficulty') <span style="color: red;">{{ $message }}</span><br> @enderror
                    </div>

                    <div style="margin-top: 15px;">
                        <button type="submit">Actualizar Receta</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>