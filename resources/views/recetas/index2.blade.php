<x-app-layout>
    <x-slot name="header">
        <h2>Todas las Recetas</h2>
    </x-slot>

    <div>
        <div>
            <div>
                <h3>Listado de Recetas</h3>

                <a href="{{ route('recetas.create') }}" style="margin-bottom: 20px; display: inline-block;">
                    Crear Nueva Receta
                </a>

                {{-- Mensaje de éxito/error --}}
                @if (session('success'))
                    <div style="background-color: #d4edda; color: #155724; padding: 10px; border: 1px solid #c3e6cb; margin-bottom: 15px;">
                        {{ session('success') }}
                    </div>
                @endif

                {{-- Formulario de Búsqueda --}}
                <div style="margin-bottom: 20px;">
                    <form action="{{ route('recetas.search') }}" method="GET" style="display: flex; align-items: center;">
                        <input type="text" name="query" placeholder="Buscar recetas por nombre..." value="{{ request('query') }}" style="flex-grow: 1; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
                        <button type="submit" style="margin-left: 10px; padding: 8px 15px; background-color: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer;">
                            Buscar
                        </button>
                    </form>
                </div>

                {{-- Lista de Recetas --}}
                @if ($recetas->isEmpty())
                    <p>No hay recetas disponibles. ¡Crea la primera!</p>
                @else
                    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 20px;">
                        @foreach ($recetas as $receta)
                            <div style="border: 1px solid #eee; padding: 15px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                                @if ($receta->imagen)
                                    <img src="{{ asset('storage/' . $receta->imagen) }}" alt="{{ $receta->nombre }}" style="width: 100%; height: 180px; object-fit: cover; border-radius: 4px; margin-bottom: 10px;">
                                @endif
                                <h4 style="font-size: 1.2em; margin-bottom: 5px;">
                                    <a href="{{ route('recetas.show', $receta) }}" style="text-decoration: none; color: #337ab7;">
                                        {{ $receta->nombre }}
                                    </a>
                                </h4>
                                <p style="font-size: 0.9em; color: #666; margin-bottom: 10px;">{{ Str::limit($receta->descripcion, 100) }}</p>
                                <p style="font-size: 0.8em; color: #888;">
                                    Tiempo de preparación: {{ $receta->tiempo_preparacion }} min |
                                    Dificultad: <span style="text-transform: capitalize;">{{ $receta->dificultad }}</span>
                                </p>
                                <p style="font-size: 0.8em; color: #888;">
                                    Creada por: {{ $receta->user->name ?? 'Usuario Desconocido' }}
                                </p>

                                <div style="margin-top: 15px; display: flex; gap: 10px;">
                                    <a href="{{ route('recetas.show', $receta) }}" style="padding: 5px 10px; background-color: #5bc0de; color: white; border-radius: 4px; text-decoration: none;">
                                        Ver
                                    </a>
                                    @if (Auth::check())
                                        <a href="{{ route('recetas.edit', $receta) }}" style="padding: 5px 10px; background-color: #f0ad4e; color: white; border-radius: 4px; text-decoration: none;">
                                            Editar
                                        </a>
                                        <form action="{{ route('recetas.destroy', $receta) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que quieres eliminar esta receta?');" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" style="padding: 5px 10px; background-color: #dc3545; color: white; border: none; border-radius: 4px; cursor: pointer;">
                                                Eliminar
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>