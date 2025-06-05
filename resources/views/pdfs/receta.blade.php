{% load static %}
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Receta: {{ $receta->nombre }}</title>
    <style>
        :root {
            --color-texto-principal:rgb(59, 34, 34);
        }

        body {
            font-family: system-ui, -apple-system, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            font-size: 16px;
            line-height: 1.75;
            color: var(--color-texto-principal);
            background-color: #ffffff;
            margin: 3rem;
        }

        h1 {
            font-size: 2rem;
            font-weight: 700;
            color: var(--color-texto-principal);
            margin-bottom: 1rem;
        }

        h2 {
            font-size: 1.25rem;
            font-weight: 600;
            border-bottom: 2px solid #e0e0e0;
            padding-bottom: 0.25rem;
            margin-top: 2.5rem;
            margin-bottom: 1rem;
            color: var(--color-texto-principal);
        }

        p, li {
            margin: 0.5rem 0;
            color: var(--color-texto-principal);
        }

        ul, ol {
            padding-left: 1.25rem;
        }

        .section {
            margin-bottom: 2rem;
        }

        .image-container {
            text-align: center;
            margin-bottom: 2rem;
        }

        .image-container img {
            max-width: 280px;
            height: auto;
            display: inline-block;
            border-radius: 6px;
            box-shadow: 0 0 6px rgba(0, 0, 0, 0.1);
        }
    </style>

</head>
<body>
    <main role="main" aria-labelledby="titulo-receta">

        <div class="image-container" role="img" aria-label="Imagen de la receta {{ $receta->nombre }}">
            @php
                $imageData = null;
                $imageMime = null;
                $imagePath = null;

                if ($receta->imagen && Storage::disk('public')->exists($receta->imagen)) {
                    $imagePath = Storage::disk('public')->path($receta->imagen);
                    $imageData = base64_encode(file_get_contents($imagePath));
                    $imageMime = mime_content_type($imagePath);
                } elseif (file_exists(public_path('logo/logo.png'))) {
                    $imagePath = public_path('logo/logo.png');
                    $imageData = base64_encode(file_get_contents($imagePath));
                    $imageMime = 'image/png';
                }
            @endphp

            @if ($imageData && $imageMime)
                <img src="data:{{ $imageMime }};base64,{{ $imageData }}" alt="Imagen de la receta {{ $receta->nombre }}">
            @else
                <p>No hay imagen disponible para esta receta.</p>
            @endif
        </div>

        <h1 id="titulo-receta">{{ $receta->nombre }}</h1>

        @if ($receta->descripcion)
        <section class="section" aria-labelledby="descripcion">
            <h2 id="descripcion">Descripción</h2>
            <p>{{ $receta->descripcion }}</p>
        </section>
        @endif

        <section class="section" aria-labelledby="detalles">
            <h2 id="detalles">Detalles</h2>
            <p><strong>Preparación:</strong> {{ $receta->tiempo_preparacion }} min</p>
            <p><strong>Cocción:</strong> {{ $receta->tiempo_coccion }} min</p>
            <p><strong>Porciones:</strong> {{ $receta->porciones }}</p>
            <p><strong>Dificultad:</strong> {{ ucfirst($receta->dificultad) }}</p>
        </section>

        <section class="section" aria-labelledby="escandallo">
            <h2 id="escandallo">Merma y Escandallo</h2>
            <p><strong>Coste Bruto:</strong> {{ number_format($receta->getCostebrutoTotal(), 2, ',', '.') }} €</p>
            <p><strong>Coste Neto:</strong> {{ number_format($receta->getCosteNetoTotal(), 2, ',', '.') }} €</p>
            <p><strong>Coste por Porción:</strong> {{ number_format($receta->getCostePorPorcion(), 2, ',', '.') }} €</p>
            <p><strong>Precio de Venta:</strong> {{ number_format($receta->getPrecioVentaPorPorcion(), 2, ',', '.') }} €</p>
        </section>

        @if ($receta->ingredientes->count() > 0)
        <section class="section" aria-labelledby="ingredientes">
            <h2 id="ingredientes">Ingredientes</h2>
            <ul>
                @foreach ($receta->ingredientes as $ingrediente)
                <li>
                    {{ $ingrediente->pivot->cantidad_bruta }} {{ $ingrediente->pivot->unidad_receta_medida }} de {{ $ingrediente->nombre }}
                    @if ($ingrediente->alergenos->count() > 0)
                        (Alérgenos:
                        {{ $ingrediente->alergenos->pluck('nombre')->join(', ') }})
                    @endif
                </li>
                @endforeach
            </ul>
        </section>
        @endif

        <section class="section" aria-labelledby="instrucciones">
            <h2 id="instrucciones">Instrucciones</h2>
            <ol>
                @if (is_array($receta->instrucciones))
                    @foreach ($receta->instrucciones as $instruccion)
                        <li>{{ $instruccion }}</li>
                    @endforeach
                @else
                    <li>{{ $receta->instrucciones }}</li>
                @endif
            </ol>
        </section>

    </main>
</body>
</html>
