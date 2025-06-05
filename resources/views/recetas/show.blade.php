<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-semibold text-black dark:text-white">
            Detalles de la Receta: {{ $receta->nombre }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-4xl mx-auto px-6">
            <article class="bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-700 rounded-lg shadow-md p-8 space-y-8 text-base leading-relaxed text-black dark:text-gray-100">

                @if (session('success'))
                    <p class="bg-green-100 text-green-900 border border-green-400 p-3 rounded" role="status">
                        {{ session('success') }}
                    </p>
                @endif

                <header class="text-center space-y-4">
                    <h1 class="text-3xl font-bold">{{ $receta->nombre }}</h1>

                    @if ($receta->imagen && Storage::disk('public')->exists($receta->imagen))
                        <img src="{{ asset('storage/' . $receta->imagen) }}" alt="Imagen de la receta {{ $receta->nombre }}" class="w-80 h-auto mx-auto rounded-lg shadow-md">
                    @elseif (file_exists(public_path('logo/logo.png')))
                        <img src="{{ asset('logo/logo.png') }}" alt="Logo de RecetarIO" class="w-80 h-auto mx-auto rounded-lg shadow-md">
                    @else
                        <p class="text-gray-600 dark:text-gray-400">No hay imagen disponible para esta receta.</p>
                    @endif
                </header>

                <section aria-labelledby="descripcion">
                    <h3 id="descripcion" class="text-xl font-semibold">Descripción</h3>
                    <p>{{ $receta->descripcion }}</p>
                </section>

                <section aria-labelledby="detalles-tiempo">
                    <h3 id="detalles-tiempo" class="text-xl font-semibold">Detalles</h3>
                    <ul class="space-y-1">
                        <li><strong>Tiempo de Preparación:</strong> {{ $receta->tiempo_preparacion }} min</li>
                        <li><strong>Tiempo de Cocción:</strong> {{ $receta->tiempo_coccion }} min</li>
                        <li><strong>Porciones:</strong> {{ $receta->porciones }}</li>
                        <li><strong>Dificultad:</strong> <span class="capitalize">{{ $receta->dificultad }}</span></li>
                    </ul>
                </section>

                <section aria-labelledby="costes">
                    <h3 id="costes" class="text-xl font-semibold">Merma y Escandallo</h3>
                    <ul class="space-y-1">
                        <li><strong>Coste Bruto Total:</strong> {{ number_format($receta->getCostebrutoTotal(), 2, ',', '.') }} €</li>
                        <li><strong>Coste Neto Total:</strong> {{ number_format($receta->getCosteNetoTotal(), 2, ',', '.') }} €</li>
                        <li><strong>Coste por Porción:</strong> {{ number_format($receta->getCostePorPorcion(), 2, ',', '.') }} €</li>
                        <li><strong>Precio Venta por Porción:</strong> {{ number_format($receta->getPrecioVentaPorPorcion(), 2, ',', '.') }} €</li>
                    </ul>
                </section>

                <section aria-labelledby="ingredientes">
                    <h3 id="ingredientes" class="text-xl font-semibold">Ingredientes</h3>
                    @if ($receta->ingredientes->isNotEmpty())
                        <ul class="list-disc list-inside space-y-1">
                            @foreach ($receta->ingredientes as $ingrediente)
                                <li>
                                    {{ $ingrediente->pivot->cantidad_bruta }} {{ $ingrediente->pivot->unidad_receta_medida }} de {{ $ingrediente->nombre }}
                                    @if ($ingrediente->alergenos->isNotEmpty())
                                        (Alérgenos: {{ $ingrediente->alergenos->pluck('nombre')->join(', ') }})
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p>No se especificaron ingredientes.</p>
                    @endif
                </section>

                <section aria-labelledby="instrucciones">
                    <h3 id="instrucciones" class="text-xl font-semibold">Instrucciones</h3>
                    @if (is_array($receta->instrucciones))
                        <ol class="list-decimal list-inside space-y-1">
                            @foreach ($receta->instrucciones as $instruccion)
                                <li>{{ $instruccion }}</li>
                            @endforeach
                        </ol>
                    @else
                        <p>{{ $receta->instrucciones }}</p>
                    @endif
                </section>

                <footer class="text-base mt-6">
                    <p><strong>Receta creada por:</strong> {{ $receta->user->name ?? 'Usuario Desconocido' }}</p>

                    <nav class="flex flex-wrap gap-4 mt-4 text-sm" aria-label="Acciones">
                        <a href="{{ route('recetas.index') }}" class="text-blue-700 dark:text-blue-400 underline focus:outline focus:ring-2 focus:ring-blue-500">Volver al Listado</a>

                        @if (Auth::check())
                            <a href="{{ route('recetas.edit', $receta) }}" class="text-yellow-700 dark:text-yellow-400 underline focus:outline focus:ring-2 focus:ring-yellow-500">Editar Receta</a>

                            <form action="{{ route('recetas.destroy', $receta) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que quieres eliminar esta receta?');" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-700 dark:text-red-400 underline focus:outline focus:ring-2 focus:ring-red-500">
                                    Eliminar Receta
                                </button>
                            </form>
                        @endif
                    </nav>
                </footer>

            </article>
        </div>
    </div>
</x-app-layout>
