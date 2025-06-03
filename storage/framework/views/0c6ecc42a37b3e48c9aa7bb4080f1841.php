{% load static %}
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Receta: <?php echo e($receta->nombre); ?></title>
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
    <?php
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
    ?>

    <?php if($imageData && $imageMime): ?>
        <img src="data:<?php echo e($imageMime); ?>;base64,<?php echo e($imageData); ?>" alt="Imagen" style="max-width: 100%;">
    <?php else: ?>
        
        <p>No hay imagen disponible para esta receta.</p>
    <?php endif; ?>
</div>

    <h1><?php echo e($receta->nombre); ?></h1>

    <?php if($receta->descripcion): ?>
        <div class="section">
            <h2>Descripción</h2>
            <p><?php echo e($receta->descripcion); ?></p>
        </div>
    <?php endif; ?>

    <div class="section">
        <h2>Detalles</h2>
        <p><strong>Tiempo de Preparación:</strong> <?php echo e($receta->tiempo_preparacion); ?> minutos</p>
        <p><strong>Tiempo de Cocción:</strong> <?php echo e($receta->tiempo_coccion); ?> minutos</p>
        <p><strong>Porciones:</strong> <?php echo e($receta->porciones); ?></p>
        <p><strong>Dificultad:</strong> <?php echo e($receta->dificultad); ?></p>
    </div>

    <?php if($receta->ingredientes->count() > 0): ?>
        <div class="section">
            <h2>Ingredientes</h2>
            <ul>
                <?php $__currentLoopData = $receta->ingredientes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ingrediente): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li>
                        <?php echo e($ingrediente->pivot->cantidad_bruta); ?> <?php echo e($ingrediente->pivot->unidad_receta_medida); ?> de <?php echo e($ingrediente->nombre); ?>

                        <?php if($ingrediente->alergenos->count() > 0): ?>
                            (Alérgenos:
                            <?php $__currentLoopData = $ingrediente->alergenos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $alergeno): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php echo e($alergeno->nombre); ?><?php echo e($key < $ingrediente->alergenos->count() - 1 ? ',' : ''); ?>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>)
                        <?php endif; ?>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <div class="section">
        <h2>Instrucciones</h2>
        <ol>
            <?php if(is_array($receta->instrucciones)): ?>
            <?php $__currentLoopData = $receta->instrucciones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $instruccion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($instruccion); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
            <li><?php echo e($receta->instrucciones); ?></li>
        <?php endif; ?>
        </ol>
    </div>

</body>
</html><?php /**PATH /var/www/html/resources/views/pdfs/receta.blade.php ENDPATH**/ ?>