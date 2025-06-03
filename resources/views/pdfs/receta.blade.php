{% load static %}
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Receta: {{ $receta->nombre }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1 {
            color: #333;
        }
        h2 {
            color: #555;
            border-bottom: 1px solid #eee;
            padding-bottom: 5px;
            margin-top: 20px;
        }
        ul {
            list-style-type: disc;
            margin-left: 20px;
        }
        ol {
            list-style-type: decimal;
            margin-left: 20px;
        }
        .section {
            margin-bottom: 15px;
        }
        .image-container {
            text-align: center;
            margin-bottom: 20px;
        }
        .image-container img {
         width: 300px; 
        height: auto; 
        display: block;
        margin: 0 auto; 
        }
        .image-container img[alt="Logo por defecto de la aplicación"] {
            opacity: 0.7;
        }
    </style>
</head>
<body>
    <div class="image-container">
    @php
        $imageData = null;
        $imageMime = null;
        $imagePath = null;

        // Intentar obtener la imagen de la receta desde storage/app/public
        if ($receta->imagen && Storage::disk('public')->exists($receta->imagen)) {
            $imagePath = Storage::disk('public')->path($receta->imagen);
            $imageData = base64_encode(file_get_contents($imagePath));
            $imageMime = mime_content_type($imagePath); // Necesita la extensión fileinfo de PHP
        } 
        // Si no hay imagen de receta o no se encuentra, usar el logo de fallback
        elseif (file_exists(public_path('logo/logo.png'))) {
            $imagePath = public_path('logo/logo.png');
            $imageData = base64_encode(file_get_contents($imagePath));
            $imageMime = 'image/png'; // Asumiendo que tu logo es PNG
        }
    @endphp

    @if ($imageData && $imageMime)
        <img src="data:{{ $imageMime }};base64,{{ $imageData }}" alt="Imagen" style="max-width: 100%;">
    @else
        {{-- O un mensaje de fallback si ninguna imagen pudo ser cargada --}}
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
        <p><strong>Tiempo de Preparación:</strong> {{ $receta->tiempo_preparacion }} minutos</p>
        <p><strong>Tiempo de Cocción:</strong> {{ $receta->tiempo_coccion }} minutos</p>
        <p><strong>Porciones:</strong> {{ $receta->porciones }}</p>
        <p><strong>Dificultad:</strong> {{ $receta->dificultad }}</p>
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