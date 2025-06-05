<x-app-layout>
    <x-slot name="header">
        <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
            Listado de Recetas
        </h2>
    </x-slot>

    @if(session('success'))
        <alerta-mensaje mensaje="{{ session('success') }}"></alerta-mensaje>
    @endif


    <div class="py-6">
        <div class="max-w-6xl mx-auto px-6">
            <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-lg shadow-md p-6 text-gray-900 dark:text-gray-100">

                <div class="flex justify-between items-center mb-6">
                    <a href="{{ route('recetas.create') }}" class="px-4 py-2 text-sm font-medium bg-blue-500 hover:bg-blue-600 text-white rounded-md transition">
                        Añadir Receta
                    </a>

                    <form action="{{ route('recetas.search') }}" method="GET" class="flex space-x-2">
                        <input type="text" name="query" value="{{ request('query') }}" placeholder="Buscar..." 
                               class="flex-1 px-3 py-2 border border-gray-300 dark:border-gray-600 bg-gray-100 dark:bg-gray-800 rounded-md text-sm text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400">
                        <button type="submit" 
                                class="px-4 py-2 text-sm font-medium bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 text-gray-900 dark:text-white rounded-md transition">
                            Buscar
                        </button>
                    </form>
                </div>

                @if ($recetas->isEmpty())
                    <p class="text-gray-500 dark:text-gray-400 text-center text-lg">No hay recetas disponibles.</p>
                @else
                    <div class="mt-4 overflow-x-auto">
                        <table class="w-full text-sm border-collapse">
                            <thead class="bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300 border-b border-gray-300 dark:border-gray-600">
                                <tr class="text-left">
                                    <th class="px-4 py-3">Nombre</th>
                                    <th class="px-4 py-3">Descripción</th>
                                    <th class="px-4 py-3 text-center">Tiempo</th>
                                    <th class="px-4 py-3 text-center">Dificultad</th>
                                    <th class="px-4 py-3 text-center">Usuario</th>
                                    <th class="px-4 py-3 text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($recetas as $receta)
                                    <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-800 transition">
                                        <td class="px-4 py-3">
                                            <a href="{{ route('recetas.show', $receta) }}" class="text-blue-600 dark:text-blue-400 hover:underline">
                                                {{ $receta->nombre }}
                                            </a>
                                        </td>
                                        <td class="px-4 py-3">{{ Str::limit($receta->descripcion, 100) }}</td>
                                        <td class="px-4 py-3 text-center">{{ $receta->tiempo_preparacion }} min</td>
                                        <td class="px-4 py-3 text-center">{{ ucfirst($receta->dificultad) }}</td>
                                        <td class="px-4 py-3 text-center">{{ $receta->user->name ?? 'Desconocido' }}</td>
                                        <td class="px-4 py-3 text-center">
                                            <div class="flex items-center justify-center space-x-3">
                                                <a href="{{ route('recetas.show', $receta) }}" class="px-4 py-2 text-sm font-medium text-white bg-gray-600 hover:bg-gray-500 rounded-md transition">
                                                    Ver
                                                </a>
                                                <a href="{{ route('recetas.pdf', $receta) }}" class="px-4 py-2 text-sm font-medium text-white bg-gray-600 hover:bg-gray-500 rounded-md transition">
                                                    PDF
                                                </a>
                                                @if (Auth::check())
                                                    <a href="{{ route('recetas.edit', $receta) }}" class="px-4 py-2 text-sm font-medium text-white bg-yellow-600 hover:bg-yellow-500 rounded-md transition">
                                                        Editar
                                                    </a>
                                                    <form action="{{ route('recetas.destroy', $receta) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" onclick="return confirm('¿Eliminar esta receta?');"
                                                                class="px-4 py-2 text-sm font-medium text-white bg-red-700 hover:bg-red-600 rounded-md transition">
                                                            Eliminar
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>
