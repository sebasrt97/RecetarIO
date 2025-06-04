{% load static %}
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Receta: <?php echo e($receta->nombre); ?></title>
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
        <?php
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
        ?>

        <?php if($imageData && $imageMime): ?>
            <img src="data:<?php echo e($imageMime); ?>;base64,<?php echo e($imageData); ?>" alt="Imagen receta">
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
        <p><strong>Preparación:</strong> <?php echo e($receta->tiempo_preparacion); ?> min</p>
        <p><strong>Cocción:</strong> <?php echo e($receta->tiempo_coccion); ?> min</p>
        <p><strong>Porciones:</strong> <?php echo e($receta->porciones); ?></p>
        <p><strong>Dificultad:</strong> <?php echo e($receta->dificultad); ?></p>
    </div>

    <div class="section">
        <h2>Merma y Escandallo</h2>
        <p><strong>Coste Bruto:</strong> <?php echo e(number_format($receta->getCostebrutoTotal(), 2, ',', '.')); ?> €</p>
        <p><strong>Coste Neto:</strong> <?php echo e(number_format($receta->getCosteNetoTotal(), 2, ',', '.')); ?> €</p>
        <p><strong>Coste por Porción:</strong> <?php echo e(number_format($receta->getCostePorPorcion(), 2, ',', '.')); ?> €</p>
        <p><strong>Precio de Venta:</strong> <?php echo e(number_format($receta->getPrecioVentaPorPorcion(), 2, ',', '.')); ?> €</p>
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
</html>
<?php /**PATH /var/www/html/resources/views/pdfs/receta.blade.php ENDPATH**/ ?>