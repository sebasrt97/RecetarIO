<x-app-layout>
    <x-slot name="header">
        <h2 class="text-lg font-medium text-gray-800 dark:text-gray-100">Detalles de la Receta: {{ $receta->nombre }}</h2>
    </x-slot>

    <div class="py-4">
        <div class="max-w-4xl mx-auto px-4">
            <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded p-4 space-y-4">
                @if (session('success'))
                    <p class="bg-green-100 text-green-800 border border-green-400 p-2 rounded text-sm">
                        {{ session('success') }}
                    </p>
                @endif

                <h1 class="text-xl font-semibold text-gray-900 dark:text-white">{{ $receta->nombre }}</h1>

                @if ($receta->imagen)
                    <img src="{{ asset('storage/imagenes/' . $receta->imagen) }}" alt="Imagen de {{ $receta->nombre }}" class="w-[300px] h-auto mx-auto block rounded">
                @endif

                <div class="text-sm text-gray-800 dark:text-gray-200 space-y-2">
                    <p>
                    <span class="font-semibold block mb-1">Descripción:</span>
                    <span class="block mt-2 mb-1">{{ $receta->descripcion }}</span>
                    </p>                   
                    <p><span class="font-semibold">Tiempo de Preparación:</span> {{ $receta->tiempo_preparacion }} minutos</p>
                    <p><span class="font-semibold">Tiempo de Cocción:</span> {{ $receta->tiempo_coccion }} minutos</p>
                    <p><span class="font-semibold">Porciones:</span> {{ $receta->porciones }}</p>
                    <p><span class="font-semibold">Dificultad:</span> <span class="capitalize">{{ $receta->dificultad }}</span></p>
                </div>

                <div class="text-sm text-gray-800 dark:text-gray-200 space-y-2">
                    <h3 class="font-semibold mt-4">Merma y Escandallo:</h3>
                    <p><span class="font-semibold">Coste Bruto Total:</span> {{number_format($receta->getCostebrutoTotal(),2,',','.')}} €</p>
                    <p><span class="font-semibold">Coste Neto Total:</span> {{number_format($receta->getCosteNetoTotal(),2,',','.')}} €</p>
                    <p><span class="font-semibold">Coste Porcion:</span> {{number_format($receta->getCostePorPorcion(),2,',','.')}} €</p>
                    <p><span class="font-semibold">Coste Neto Total:</span> {{number_format($receta->getCosteNetoTotal(),2,',','.')}} €</p>
                    <p><span class="font-semibold">Precio Venta Por Porcion:</span> {{number_format($receta->getPrecioVentaPorPorcion(),2,',','.')}} €</p>
                </div>

                <div class="text-sm text-gray-800 dark:text-gray-200 space-y-1">
                    <h3 class="font-semibold mt-4">Ingredientes:</h3>
                    @if ($receta->ingredientes && count($receta->ingredientes) > 0)
                        <ul class="list-disc list-inside">
                            @foreach ($receta->ingredientes as $ingrediente)
                                <li>
                                {{ $ingrediente->pivot->cantidad_bruta }}
                                {{ $ingrediente->pivot->unidad_receta_medida }} de
                                {{ $ingrediente->nombre }}
                                 @if ($ingrediente->alergenos->isNotEmpty())
                                (Alérgenos:
                                {{-- Usa pluck('nombre') para obtener solo los nombres y join(', ') para unirlos --}}
                                **{{ $ingrediente->alergenos->pluck('nombre')->join(', ') }}**)
                            @endif
                            </li>
                            @endforeach
                        </ul>
                    @else
                        <p>No se especificaron ingredientes.</p>
                    @endif
                </div>

                <div class="text-sm text-gray-800 dark:text-gray-200 space-y-1">
                    <h3 class="font-semibold mt-4">Instrucciones:</h3>


                    @if (is_array($receta->instrucciones))
                        <ol class="list-decimal list-inside">
                            @foreach ($receta->instrucciones as $instruccion)
                                <li>{{ $instruccion }}</li>
                            @endforeach    
                        </ol>                    
                    @else
                        <p>Instrucción Única: [{{ $receta->instrucciones }}]</p>
                    @endif
                </div>

                <p class="text-sm text-gray-800 dark:text-gray-200 mt-4">
                    Receta creada por: <span class="font-semibold">{{ $receta->user->name ?? 'Usuario Desconocido' }}</span>
                </p>
    
                <div class="flex items-center gap-4 text-sm mt-4">
                    <a href="{{ route('recetas.index') }}" class="text-gray-800 dark:text-gray-200 underline">Volver al Listado</a>

                    @if (Auth::check())
                        <a href="{{ route('recetas.edit', $receta) }}" class="text-gray-800 dark:text-gray-200 underline">Editar Receta</a>

                        <form action="{{ route('recetas.destroy', $receta) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que quieres eliminar esta receta?');" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 dark:text-red-400">Eliminar Receta</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
