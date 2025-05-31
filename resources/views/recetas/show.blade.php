<x-app-layout>
    <x-slot name="header">
        <h2>Detalles de la Receta: {{ $receta->nombre }}</h2>
    </x-slot>

    <div>
        <div>
            <div>
                @if (session('success'))
                    <p style="background-color: lightgreen; padding: 10px; border: 1px solid green; margin-bottom: 15px;">
                        {{ session('success') }}
                    </p>
                @endif

                <h1>{{ $receta->nombre }}</h1>

                @if ($receta->imagen)
                    <div>
                        <img src="{{ asset('storage/' . $receta->imagen) }}" alt="Imagen de {{ $receta->nombre }}" style="max-width: 400px; height: auto; display: block; margin-bottom: 15px;">
                    </div>
                @endif

                <p>
                    <strong>Descripción:</strong> {{ $receta->descripcion }}
                </p>

                <p><strong>Tiempo de Preparación:</strong> {{ $receta->tiempo_preparacion }} minutos</p>
                <p><strong>Tiempo de Cocción:</strong> {{ $receta->tiempo_coccion }} minutos</p>
                <p><strong>Porciones:</strong> {{ $receta->porciones }}</p>
                <p><strong>Dificultad:</strong> <span style="text-transform: capitalize;">{{ $receta->dificultad }}</span></p>

                <h3>Ingredientes:</h3>
                @if ($receta->ingredientes && count($receta->ingredientes) > 0)
                    <ul>
                        @foreach ($receta->ingredientes as $ingrediente)
                            <li>{{ $ingrediente }}</li>
                        @endforeach
                    </ul>
                @else
                    <p>No se especificaron ingredientes.</p>
                @endif

                <h3>Instrucciones:</h3>
                @if ($receta->instrucciones && count($receta->instrucciones) > 0)
                    <ol>
                        @foreach ($receta->instrucciones as $instruccion)
                            <li>{{ $instruccion }}</li>
                        @endforeach
                    </ol>
                @else
                    <p>No se especificaron instrucciones.</p>
                @endif

                <p>
                    Receta creada por: <strong>{{ $receta->user->name ?? 'Usuario Desconocido' }}</strong>
                </p>

                <div style="margin-top: 20px;">
                    <a href="{{ route('recetas.index') }}">Volver al Listado</a>

                    @if (Auth::check())
                        | <a href="{{ route('recetas.edit', $receta) }}">Editar Receta</a> |
                        <form action="{{ route('recetas.destroy', $receta) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('¿Estás seguro de que quieres eliminar esta receta?');" style="background:none; border:none; color:red; cursor:pointer;">Eliminar Receta</button>
                        </form>
                    @endif
                </div>

            </div>
        </div>
    </div>
</x-app-layout>