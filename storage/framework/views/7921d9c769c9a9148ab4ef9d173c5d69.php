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
        <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
            Listado de Recetas
        </h2>
     <?php $__env->endSlot(); ?>

    <?php if(session('success')): ?>
        <alerta-mensaje mensaje="<?php echo e(session('success')); ?>"></alerta-mensaje>
    <?php endif; ?>


    <div class="py-6">
        <div class="max-w-6xl mx-auto px-6">
            <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-lg shadow-md p-6 text-gray-900 dark:text-gray-100">

                <div class="flex justify-between items-center mb-6">
                    <a href="<?php echo e(route('recetas.create')); ?>" class="px-4 py-2 text-sm font-medium bg-blue-500 hover:bg-blue-600 text-white rounded-md transition">
                        Añadir Receta
                    </a>

                    <form action="<?php echo e(route('recetas.search')); ?>" method="GET" class="flex space-x-2">
                        <input type="text" name="query" value="<?php echo e(request('query')); ?>" placeholder="Buscar..." 
                               class="flex-1 px-3 py-2 border border-gray-300 dark:border-gray-600 bg-gray-100 dark:bg-gray-800 rounded-md text-sm text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400">
                        <button type="submit" 
                                class="px-4 py-2 text-sm font-medium bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 text-gray-900 dark:text-white rounded-md transition">
                            Buscar
                        </button>
                    </form>
                </div>

                <?php if($recetas->isEmpty()): ?>
                    <p class="text-gray-500 dark:text-gray-400 text-center text-lg">No hay recetas disponibles.</p>
                <?php else: ?>
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
                                <?php $__currentLoopData = $recetas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $receta): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-800 transition">
                                        <td class="px-4 py-3">
                                            <a href="<?php echo e(route('recetas.show', $receta)); ?>" class="text-blue-600 dark:text-blue-400 hover:underline">
                                                <?php echo e($receta->nombre); ?>

                                            </a>
                                        </td>
                                        <td class="px-4 py-3"><?php echo e(Str::limit($receta->descripcion, 100)); ?></td>
                                        <td class="px-4 py-3 text-center"><?php echo e($receta->tiempo_preparacion); ?> min</td>
                                        <td class="px-4 py-3 text-center"><?php echo e(ucfirst($receta->dificultad)); ?></td>
                                        <td class="px-4 py-3 text-center"><?php echo e($receta->user->name ?? 'Desconocido'); ?></td>
                                        <td class="px-4 py-3 text-center">
                                            <div class="flex items-center justify-center space-x-3">
                                                <a href="<?php echo e(route('recetas.show', $receta)); ?>" class="px-4 py-2 text-sm font-medium text-white bg-gray-600 hover:bg-gray-500 rounded-md transition">
                                                    Ver
                                                </a>
                                                <a href="<?php echo e(route('recetas.pdf', $receta)); ?>" class="px-4 py-2 text-sm font-medium text-white bg-gray-600 hover:bg-gray-500 rounded-md transition">
                                                    PDF
                                                </a>
                                                <?php if(Auth::check()): ?>
                                                    <a href="<?php echo e(route('recetas.edit', $receta)); ?>" class="px-4 py-2 text-sm font-medium text-white bg-yellow-600 hover:bg-yellow-500 rounded-md transition">
                                                        Editar
                                                    </a>
                                                    <form action="<?php echo e(route('recetas.destroy', $receta)); ?>" method="POST">
                                                        <?php echo csrf_field(); ?>
                                                        <?php echo method_field('DELETE'); ?>
                                                        <button type="submit" onclick="return confirm('¿Eliminar esta receta?');"
                                                                class="px-4 py-2 text-sm font-medium text-white bg-red-700 hover:bg-red-600 rounded-md transition">
                                                            Eliminar
                                                        </button>
                                                    </form>
                                                <?php endif; ?>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>

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
<?php /**PATH /var/www/html/resources/views/recetas/index.blade.php ENDPATH**/ ?>