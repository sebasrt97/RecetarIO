<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\AppLayout::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header', null, []); ?> 
        <h2 class="text-lg font-medium text-gray-800 dark:text-gray-100">Detalles de la Receta: <?php echo e($receta->nombre); ?></h2>
     <?php $__env->endSlot(); ?>

    <div class="py-4">
        <div class="max-w-4xl mx-auto px-4">
            <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded p-4 space-y-4">
                <?php if(session('success')): ?>
                    <p class="bg-green-100 text-green-800 border border-green-400 p-2 rounded text-sm">
                        <?php echo e(session('success')); ?>

                    </p>
                <?php endif; ?>

                <h1 class="text-xl font-semibold text-gray-900 dark:text-white"><?php echo e($receta->nombre); ?></h1>

                <?php if($receta->imagen): ?>
                    <img src="<?php echo e(asset('storage/' . $receta->imagen)); ?>" alt="Imagen de <?php echo e($receta->nombre); ?>" class="w-full max-w-md rounded">
                <?php endif; ?>

                <div class="text-sm text-gray-800 dark:text-gray-200 space-y-2">
                    <p>
                    <span class="font-semibold block mb-1">Descripción:</span>
                    <span class="block mt-2 mb-1"><?php echo e($receta->descripcion); ?></span>
                    </p>                   
                    <p><span class="font-semibold">Tiempo de Preparación:</span> <?php echo e($receta->tiempo_preparacion); ?> minutos</p>
                    <p><span class="font-semibold">Tiempo de Cocción:</span> <?php echo e($receta->tiempo_coccion); ?> minutos</p>
                    <p><span class="font-semibold">Porciones:</span> <?php echo e($receta->porciones); ?></p>
                    <p><span class="font-semibold">Dificultad:</span> <span class="capitalize"><?php echo e($receta->dificultad); ?></span></p>
                </div>

                <div class="text-sm text-gray-800 dark:text-gray-200 space-y-1">
                    <h3 class="font-semibold mt-4">Ingredientes:</h3>
                    <?php if($receta->ingredientes && count($receta->ingredientes) > 0): ?>
                        <ul class="list-disc list-inside">
                            <?php $__currentLoopData = $receta->ingredientes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ingrediente): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li>
                                <?php echo e($ingrediente->pivot->cantidad_bruta); ?>

                                <?php echo e($ingrediente->pivot->unidad_receta_medida); ?> de
                                <?php echo e($ingrediente->nombre); ?>

                                 <?php if($ingrediente->alergenos->isNotEmpty()): ?>
                                (Alérgenos:
                                
                                **<?php echo e($ingrediente->alergenos->pluck('nombre')->join(', ')); ?>**)
                            <?php endif; ?>
                            </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    <?php else: ?>
                        <p>No se especificaron ingredientes.</p>
                    <?php endif; ?>
                </div>

                <div class="text-sm text-gray-800 dark:text-gray-200 space-y-1">
                    <h3 class="font-semibold mt-4">Instrucciones:</h3>


                    <?php if(is_array($receta->instrucciones)): ?>
                        <ol class="list-decimal list-inside">
                            <?php $__currentLoopData = $receta->instrucciones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $instruccion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($instruccion); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>    
                        </ol>                    
                    <?php else: ?>
                        <p>Instrucción Única: [<?php echo e($receta->instrucciones); ?>]</p>
                    <?php endif; ?>
                </div>

                <p class="text-sm text-gray-800 dark:text-gray-200 mt-4">
                    Receta creada por: <span class="font-semibold"><?php echo e($receta->user->name ?? 'Usuario Desconocido'); ?></span>
                </p>
    
                <div class="flex items-center gap-4 text-sm mt-4">
                    <a href="<?php echo e(route('recetas.index')); ?>" class="text-gray-800 dark:text-gray-200 underline">Volver al Listado</a>

                    <?php if(Auth::check()): ?>
                        <a href="<?php echo e(route('recetas.edit', $receta)); ?>" class="text-gray-800 dark:text-gray-200 underline">Editar Receta</a>

                        <form action="<?php echo e(route('recetas.destroy', $receta)); ?>" method="POST" onsubmit="return confirm('¿Estás seguro de que quieres eliminar esta receta?');" class="inline">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="text-red-600 dark:text-red-400">Eliminar Receta</button>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php /**PATH /var/www/html/resources/views/recetas/show.blade.php ENDPATH**/ ?>