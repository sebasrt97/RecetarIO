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
        <h2 class="text-lg font-medium text-gray-800 dark:text-gray-100">Crear Nueva Receta</h2>
     <?php $__env->endSlot(); ?>

    <div class="py-4">
        <div class="max-w-xl mx-auto px-4">
            <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded p-4">
                <form id="receta-form" method="POST" action="<?php echo e(route('recetas.store')); ?>" enctype="multipart/form-data" class="space-y-4">
                    <?php echo csrf_field(); ?>

                    <div>
                        <label for="nombre" class="block text-sm text-gray-700 dark:text-gray-300">Nombre de la Receta</label>
                        <input type="text" id="nombre" name="nombre" value="<?php echo e(old('nombre')); ?>" required class="w-full border border-gray-300 dark:border-gray-600 px-2 py-1 rounded text-sm dark:bg-gray-800 dark:text-white">
                        <?php $__errorArgs = ['nombre'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-600 text-sm"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div>
                        <label for="descripcion" class="block text-sm text-gray-700 dark:text-gray-300">Descripción</label>
                        <textarea id="descripcion" name="descripcion" rows="3" class="w-full border border-gray-300 dark:border-gray-600 px-2 py-1 rounded text-sm dark:bg-gray-800 dark:text-white"><?php echo e(old('descripcion')); ?></textarea>
                        <?php $__errorArgs = ['descripcion'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-600 text-sm"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div>
                        <label for="instrucciones" class="block text-sm text-gray-700 dark:text-gray-300">Instrucciones (una por línea)</label>
                        <textarea id="instrucciones" name="instrucciones" rows="5" required class="w-full border border-gray-300 dark:border-gray-600 px-2 py-1 rounded text-sm dark:bg-gray-800 dark:text-white"><?php echo e(old('instrucciones')); ?></textarea>
                        <?php $__errorArgs = ['instrucciones'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-600 text-sm"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div>
                        <label class="block text-sm text-gray-700 dark:text-gray-300 mb-2">Ingredientes:</label>
                        <div id="ingredientes-contenedor"></div>
                        <button type="button" id="ingrediente-agregar-btn" class="mt-2 px-4 py-2 text-sm bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-white rounded">Añadir Ingrediente</button>
                        <?php $__errorArgs = ['ingredientes'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-600 text-sm"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <template id="ingrediente-filas">
                        <div class="ingrediente-fila flex items-center space-x-2 mb-2 p-2 border border-gray-300 dark:border-gray-700 rounded">
                            <select name="ingredientes[INDEX][id]" required class="w-1/3 border border-gray-300 dark:border-gray-600 px-2 py-1 rounded text-sm dark:bg-gray-800 dark:text-white">
                                <option value="">-- Selecciona un Ingrediente --</option>
                                <?php if(isset($ingredientesDisponibles)): ?> 
                                    <?php $__currentLoopData = $ingredientesDisponibles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ingrediente): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($ingrediente->id); ?>"><?php echo e($ingrediente->nombre); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </select>
                            <input type="number" name="ingredientes[INDEX][cantidad_bruta]" step="0.01" min="0.01" placeholder="Cantidad" required class="w-1/4 border border-gray-300 dark:border-gray-600 px-2 py-1 rounded text-sm dark:bg-gray-800 dark:text-white">
                            <input type="text" name="ingredientes[INDEX][unidad_receta_medida]" placeholder="Unidad (ej: gr, ml, unidad)" required class="w-1/4 border border-gray-300 dark:border-gray-600 px-2 py-1 rounded text-sm dark:bg-gray-800 dark:text-white">
                            <button type="button" class="ingrediente-eliminar-btn px-3 py-1 bg-red-500 text-white rounded text-xs">Eliminar</button>
                        </div>
                    </template>

                    <div>
                        <label for="tiempo_preparacion" class="block text-sm text-gray-700 dark:text-gray-300">Tiempo de Preparación (minutos)</label>
                        <input type="number" id="tiempo_preparacion" name="tiempo_preparacion" value="<?php echo e(old('tiempo_preparacion')); ?>" class="w-full border border-gray-300 dark:border-gray-600 px-2 py-1 rounded text-sm dark:bg-gray-800 dark:text-white">
                        <?php $__errorArgs = ['tiempo_preparacion'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-600 text-sm"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div>
                        <label for="tiempo_coccion" class="block text-sm text-gray-700 dark:text-gray-300">Tiempo de Cocción (minutos)</label>
                        <input type="number" id="tiempo_coccion" name="tiempo_coccion" value="<?php echo e(old('tiempo_coccion')); ?>" class="w-full border border-gray-300 dark:border-gray-600 px-2 py-1 rounded text-sm dark:bg-gray-800 dark:text-white">
                        <?php $__errorArgs = ['tiempo_coccion'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-600 text-sm"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div>
                        <label for="porciones" class="block text-sm text-gray-700 dark:text-gray-300">Porciones</label>
                        <input type="number" id="porciones" name="porciones" value="<?php echo e(old('porciones')); ?>" class="w-full border border-gray-300 dark:border-gray-600 px-2 py-1 rounded text-sm dark:bg-gray-800 dark:text-white">
                        <?php $__errorArgs = ['porciones'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-600 text-sm"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div>
                        <label for="dificultad" class="block text-sm text-gray-700 dark:text-gray-300">Dificultad</label>
                        <select id="dificultad" name="dificultad" class="w-full border border-gray-300 dark:border-gray-600 px-2 py-1 rounded text-sm dark:bg-gray-800 dark:text-white">
                            <option value="fácil" <?php echo e(old('dificultad') == 'fácil' ? 'selected' : ''); ?>>Fácil</option>
                            <option value="media" <?php echo e(old('dificultad') == 'media' ? 'selected' : ''); ?>>Media</option>
                            <option value="difícil" <?php echo e(old('dificultad') == 'difícil' ? 'selected' : ''); ?>>Difícil</option>
                        </select>
                        <?php $__errorArgs = ['dificultad'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-600 text-sm"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div>
                        <label for="margen_beneficio" class="block text-sm text-gray-700 dark:text-gray-300">Margen de Beneficio (%)</label>
                        <input type="number" id="margen_beneficio" name="margen_beneficio" value="<?php echo e(old('margen_beneficio')); ?>" step="0.01" min="0" class="w-full border border-gray-300 dark:border-gray-600 px-2 py-1 rounded text-sm dark:bg-gray-800 dark:text-white">
                        <?php $__errorArgs = ['margen_beneficio'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-600 text-sm"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div>
                        <label for="imagen" class="block text-sm text-gray-700 dark:text-gray-300">Imagen de la Receta</label>
                        <input type="file" id="imagen" name="imagen" accept="image/*" class="text-sm text-gray-700 dark:text-gray-300">
                        <?php $__errorArgs = ['imagen'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-600 text-sm"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="pt-2">
                        <button type="submit" class="px-4 py-2 text-sm bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-white rounded">Crear Receta</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const ingredienteContenedor = document.getElementById('ingredientes-contenedor');
            const botonAgregar = document.getElementById('ingrediente-agregar-btn');
            const plantilla = document.getElementById('ingrediente-filas');
            let index = 0;

            function agregarFila(ingredienteDato = null) {
                const nodo = plantilla.content.cloneNode(true);
                const fila = nodo.querySelector('.ingrediente-fila');

                fila.querySelectorAll('[name*="ingredientes[INDEX]"]').forEach(el => {
                    el.name = el.name.replace('INDEX', index);
                });

                if (ingredienteDato) {
                    fila.querySelector('[name$="[id]"]').value = ingredienteDato.id || '';
                    fila.querySelector('[name$="[cantidad_bruta]"]').value = ingredienteDato.cantidad_bruta || '';
                    fila.querySelector('[name$="[unidad_receta_medida]"]').value = ingredienteDato.unidad_receta_medida || '';
                }

                fila.querySelector('.ingrediente-eliminar-btn').addEventListener('click', () => fila.remove());
                ingredienteContenedor.appendChild(fila);
                index++;
            }

            const antiguos = <?php echo json_encode(old('ingredientes', []), 512) ?>;
            if (antiguos.length > 0) {
                antiguos.forEach(dato => agregarFila(dato));
            } else {
                agregarFila();
            }

            botonAgregar.addEventListener('click', () => agregarFila());
        });
    </script>
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
<?php /**PATH /var/www/html/resources/views/recetas/create.blade.php ENDPATH**/ ?>