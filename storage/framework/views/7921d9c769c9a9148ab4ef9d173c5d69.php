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
        <h2 class="text-lg font-medium text-gray-800 dark:text-gray-100">
            Listado de Recetas
        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-4">
        <div class="max-w-5xl mx-auto px-4">
            <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded p-4">

                <a href="<?php echo e(route('recetas.create')); ?>" class="text-sm px-3 py-1 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-100 rounded">
                    Añadir Receta
                </a>

                <?php if(session('success')): ?>
                    <div class="mt-4 text-sm p-2 bg-green-50 text-green-700 border border-green-300 rounded">
                        <?php echo e(session('success')); ?>

                    </div>
                <?php endif; ?>

                <form action="<?php echo e(route('recetas.search')); ?>" method="GET" class="mt-4 flex">
                    <input type="text" name="query" value="<?php echo e(request('query')); ?>"
                           placeholder="Buscar..."
                           class="flex-1 px-2 py-1 border border-gray-300 dark:border-gray-600 rounded-l text-sm dark:bg-gray-800 dark:text-white">
                    <button type="submit"
                            class="px-3 py-1 bg-gray-300 dark:bg-gray-600 text-gray-800 dark:text-white rounded-r text-sm">
                        Buscar
                    </button>
                </form>

                <?php if($recetas->isEmpty()): ?>
                    <p class="mt-4 text-gray-600 dark:text-gray-400 text-sm">No hay recetas.</p>
                <?php else: ?>
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
                                <?php $__currentLoopData = $recetas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $receta): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="border-b dark:border-gray-700">
                                        <td class="px-2 py-1 text-center">
                                            <a href="<?php echo e(route('recetas.show', $receta)); ?>" class="text-gray-800 dark:text-gray-100 underline">
                                                <?php echo e($receta->nombre); ?>

                                            </a>
                                        </td>
                                        <td class="px-2 py-1 text-center">
                                            <?php echo e(Str::limit($receta->descripcion, 100)); ?>

                                        </td>
                                        <td class="px-2 py-1 text-center">
                                            <?php echo e($receta->tiempo_preparacion); ?> min
                                        </td>
                                        <td class="px-2 py-1 text-center">
                                            <?php echo e(ucfirst($receta->dificultad)); ?>

                                        </td>
                                        <td class="px-2 py-1 text-center">
                                            <?php echo e($receta->user->name ?? 'Desconocido'); ?>

                                        </td>
                                        <td class="px-2 py-1 text-center space-x-2">
                                            
                                            <a href="<?php echo e(route('recetas.show', $receta)); ?>" class="underline">Ver</a>

                                            
                                            <a href="<?php echo e(route('recetas.pdf', $receta)); ?>"
                                               class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150 ms-3">
                                                Descargar PDF
                                            </a>
                                            

                                            <?php if(Auth::check()): ?>
                                                
                                                <a href="<?php echo e(route('recetas.edit', $receta)); ?>" class="underline ms-3">Editar</a>
                                                
                                                
                                                <form action="<?php echo e(route('recetas.destroy', $receta)); ?>" method="POST" class="inline">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                    <button type="submit" onclick="return confirm('¿Eliminar?');" class="text-red-600 underline ms-3">Eliminar</button>
                                                </form>
                                            <?php endif; ?>
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
<?php endif; ?><?php /**PATH /var/www/html/resources/views/recetas/index.blade.php ENDPATH**/ ?>