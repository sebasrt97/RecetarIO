<x-app-layout>
    <x-slot name="header">
        <h2 class="text-lg font-medium text-gray-800 dark:text-gray-100">
            Listado de Recetas
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="max-w-5xl mx-auto px-4">
            <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded p-4">

                <a href="{{ route('recetas.create') }}" class="text-sm px-3 py-1 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-100 rounded">
                    Añadir Receta
                </a>

                @if (session('success'))
                    <div class="mt-4 text-sm p-2 bg-green-50 text-green-700 border border-green-300 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('recetas.search') }}" method="GET" class="mt-4 flex">
                    <input type="text" name="query" value="{{ request('query') }}" class="placeholder-gray-500 dark:placeholder-gray-400"
                           placeholder="Buscar..."
                           class="flex-1 px-2 py-1 border border-gray-300 dark:border-gray-600 rounded-l text-sm dark:bg-gray-800 dark:text-white">
                    <button type="submit"
                            class="px-3 py-1 bg-gray-300 dark:bg-gray-600 text-gray-800 dark:text-white rounded-r text-sm">
                        Buscar
                    </button>
                </form>

                @if ($recetas->isEmpty())
                    <p class="mt-4 text-gray-600 dark:text-gray-400 text-sm">No hay recetas.</p>
                @else
                    <div class="mt-4 overflow-x-auto">
                        <table class="w-full text-sm border-collapse">
                            <thead class="bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300 border-b dark:border-gray-600">
                                <tr>
                                    <th class="px-2 py-1 text-center">Nombre</th>
                                    <th class="px-2 py-1 text-center">Descripción</th>
                                    <th class="px-2 py-1 text-center">Tiempo</th>
                                    <th class="px-2 py-1 text-center">Dificultad</th>
                                    <th class="px-2 py-1 text-center">Usuario</th>
                                    <th class="px-2 py-1 text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($recetas as $receta)
                                    <tr class="border-b dark:border-gray-700">
                                        <td class="px-2 py-1 text-center text-gray-700 dark:text-gray-300">
                                            <a href="{{ route('recetas.show', $receta) }}" class="text-gray-800 dark:text-gray-100 underline">
                                                {{ $receta->nombre }}
                                            </a>
                                        </td>
                                        <td class="px-2 py-1 text-center text-gray-700 dark:text-gray-300">
                                            {{ Str::limit($receta->descripcion, 100) }}
                                        </td>
                                        <td class="px-2 py-1 text-center text-gray-700 dark:text-gray-300">
                                            {{ $receta->tiempo_preparacion }} min
                                        </td>
                                        <td class="px-2 py-1 text-center text-gray-700 dark:text-gray-300">
                                            {{ ucfirst($receta->dificultad) }}
                                        </td>
                                        <td class="px-2 py-1 text-center text-gray-700 dark:text-gray-300">
                                            {{ $receta->user->name ?? 'Desconocido' }}
                                        </td>
                                        <td class="px-2 py-1 text-center space-x-2 text-gray-700 dark:text-gray-300">
                                            {{-- Enlace para Ver Detalles --}}
                                            <a href="{{ route('recetas.show', $receta) }}" class="underline ">Ver</a>

                                            {{-- AÑADE AQUÍ EL ENLACE/BOTÓN PARA DESCARGAR PDF --}}
                                            <a href="{{ route('recetas.pdf', $receta) }}"
                                               class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 ms-5">
                                                Descargar PDF
                                            </a>
                                            {{-- FIN DEL ENLACE/BOTÓN DE DESCARGA PDF --}}

                                            @if (Auth::check())
                                                {{-- Enlace para Editar (añadido ms-3 para espaciado consistente) --}}
                                                <a href="{{ route('recetas.edit', $receta) }}" class="underline ms-3">Editar</a>
                                                
                                                {{-- Formulario para Eliminar (añadido ms-3 para espaciado consistente) --}}
                                                <form action="{{ route('recetas.destroy', $receta) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" onclick="return confirm('¿Eliminar?');" class="text-red-600 underline ms-3">Eliminar</button>
                                                </form>
                                            @endif
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