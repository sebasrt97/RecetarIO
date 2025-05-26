<x-app-layout>
    <x-slot name="header">
        <h2>Crear Nueva Receta</h2>
    </x-slot>

    <div>
        <div>
            <div>
                <form method="POST" action="{{ route('recetas.store') }}">
                    @csrf

                    <div>
                        <label for="name">Nombre de la Receta:</label><br>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" required><br>
                        @error('name') <span style="color: red;">{{ $message }}</span><br> @enderror
                    </div>

                    <div style="margin-top: 10px;">
                        <label for="description">Descripción:</label><br>
                        <textarea id="description" name="description">{{ old('description') }}</textarea><br>
                        @error('description') <span style="color: red;">{{ $message }}</span><br> @enderror
                    </div>

                    <div style="margin-top: 10px;">
                        <label for="instructions">Instrucciones:</label><br>
                        <textarea id="instructions" name="instructions" required>{{ old('instructions') }}</textarea><br>
                        @error('instructions') <span style="color: red;">{{ $message }}</span><br> @enderror
                    </div>

                    <div style="margin-top: 10px;">
                        <label for="preparation_time">Tiempo de Preparación:</label><br>
                        <input type="number" id="preparation_time" name="preparation_time" value="{{ old('preparation_time') }}"><br>
                        @error('preparation_time') <span style="color: red;">{{ $message }}</span><br> @enderror
                    </div>

                    <div style="margin-top: 10px;">
                        <label for="cooking_time">Tiempo de Cocción (minutos):</label><br>
                        <input type="number" id="cooking_time" name="cooking_time" value="{{ old('cooking_time') }}"><br>
                        @error('cooking_time') <span style="color: red;">{{ $message }}</span><br> @enderror
                    </div>

                    <div style="margin-top: 10px;">
                        <label for="servings">Porciones:</label><br>
                        <input type="number" id="servings" name="servings" value="{{ old('servings') }}"><br>
                        @error('servings') <span style="color: red;">{{ $message }}</span><br> @enderror
                    </div>

                    <div style="margin-top: 10px;">
                        <label for="difficulty">Dificultad:</label><br>
                        <select id="difficulty" name="difficulty">
                            <option value="">Selecciona una dificultad</option>
                            <option value="Fácil" {{ old('difficulty') == 'Fácil' ? 'selected' : '' }}>Fácil</option>
                            <option value="Media" {{ old('difficulty') == 'Media' ? 'selected' : '' }}>Media</option>
                            <option value="Difícil" {{ old('difficulty') == 'Difícil' ? 'selected' : '' }}>Difícil</option>
                        </select><br>
                        @error('difficulty') <span style="color: red;">{{ $message }}</span><br> @enderror
                    </div>

                    <div style="margin-top: 15px;">
                        <button type="submit">Guardar Receta</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>