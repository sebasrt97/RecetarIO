{% load static %}
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Receta: {{ $receta->nombre }}</title>
    <style>
        body {
    font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
    font-size: 11pt;
    line-height: 1.6;
    color: #222;
    margin: 40px;
    background: #fff;
}

h1 {
    font-size: 22pt;
    font-weight: 600;
    margin-bottom: 10px;
    color: #111;
}

h2 {
    font-size: 14pt;
    font-weight: 500;
    margin-top: 30px;
    margin-bottom: 6px;
    padding-bottom: 4px;
    border-bottom: 1px solid #ddd;
    color: #333;
}

p, li {
    margin: 4px 0;
}

ul, ol {
    padding-left: 18px;
}

.section {
    margin-bottom: 24px;
}

.image-container {
    text-align: center;
    margin-bottom: 24px;
}

.image-container img {
    max-width: 240px;
    height: auto;
    display: inline-block;
    border-radius: 4px;
    opacity: 0.95;
}

    </style>
</head>
<body>
    <div class="image-container">
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
            <img src="data:{{ $imageMime }};base64,{{ $imageData }}" alt="Imagen receta">
        @else
            <p>No hay imagen disponible para esta receta.</p>
        @endif
    </div>

    <h1>{{ $receta->nombre }}</h1>

    @if ($receta->descripcion)
    <div class="section">
        <h2>Descripción</h2>
        <p>{{ $receta->descripcion }}</p>
    </div>
    @endif

    <div class="section">
        <h2>Detalles</h2>
        <p><strong>Preparación:</strong> {{ $receta->tiempo_preparacion }} min</p>
        <p><strong>Cocción:</strong> {{ $receta->tiempo_coccion }} min</p>
        <p><strong>Porciones:</strong> {{ $receta->porciones }}</p>
        <p><strong>Dificultad:</strong> {{ $receta->dificultad }}</p>
    </div>

    <div class="section">
        <h2>Merma y Escandallo</h2>
        <p><strong>Coste Bruto:</strong> {{ number_format($receta->getCostebrutoTotal(), 2, ',', '.') }} €</p>
        <p><strong>Coste Neto:</strong> {{ number_format($receta->getCosteNetoTotal(), 2, ',', '.') }} €</p>
        <p><strong>Coste por Porción:</strong> {{ number_format($receta->getCostePorPorcion(), 2, ',', '.') }} €</p>
        <p><strong>Precio de Venta:</strong> {{ number_format($receta->getPrecioVentaPorPorcion(), 2, ',', '.') }} €</p>
    </div>

    @if ($receta->ingredientes->count() > 0)
    <div class="section">
        <h2>Ingredientes</h2>
        <ul>
            @foreach ($receta->ingredientes as $ingrediente)
            <li>
                {{ $ingrediente->pivot->cantidad_bruta }} {{ $ingrediente->pivot->unidad_receta_medida }} de {{ $ingrediente->nombre }}
                @if ($ingrediente->alergenos->count() > 0)
                    (Alérgenos:
                    @foreach ($ingrediente->alergenos as $key => $alergeno)
                        {{ $alergeno->nombre }}{{ $key < $ingrediente->alergenos->count() - 1 ? ',' : '' }}
                    @endforeach)
                @endif
            </li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="section">
        <h2>Instrucciones</h2>
        <ol>
            @if (is_array($receta->instrucciones))
                @foreach ($receta->instrucciones as $instruccion)
                    <li>{{ $instruccion }}</li>
                @endforeach
            @else
                <li>{{ $receta->instrucciones }}</li>
            @endif
        </ol>
    </div>
</body>
</html>
