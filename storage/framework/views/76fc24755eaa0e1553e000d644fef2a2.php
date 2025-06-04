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
        <h2 class="text-lg font-medium text-gray-800 dark:text-gray-100">Editar Receta: <?php echo e($receta->nombre); ?></h2>
     <?php $__env->endSlot(); ?>

    <div class="py-4">
        <div class="max-w-xl mx-auto px-4">
            <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded p-4">
                <form id="receta-form" method="POST" action="<?php echo e(route('recetas.update', $receta)); ?>" enctype="multipart/form-data" class="space-y-4">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>

                    <div>
                        <label for="nombre" class="block text-sm text-gray-700 dark:text-gray-300">Nombre de la Receta</label>
                        <input type="text" id="nombre" name="nombre" value="<?php echo e(old('nombre', $receta->nombre)); ?>" required
                               class="w-full border border-gray-300 dark:border-gray-600 px-2 py-1 rounded text-sm dark:bg-gray-800 dark:text-white">
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
                        <textarea id="descripcion" name="descripcion" rows="3"
                                  class="w-full border border-gray-300 dark:border-gray-600 px-2 py-1 rounded text-sm dark:bg-gray-800 dark:text-white"><?php echo e(old('descripcion', $receta->descripcion)); ?></textarea>
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
                        <textarea id="instrucciones" name="instrucciones" rows="5" required
                                  class="w-full border border-gray-300 dark:border-gray-600 px-2 py-1 rounded text-sm dark:bg-gray-800 dark:text-white"
                                  ><?php echo e(old('instrucciones', is_array($receta->instrucciones) ? implode("\n", $receta->instrucciones) : '')); ?></textarea>
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
                        <div id="ingredientes-contenedor">
                            </div>
                        <button type="button" id="ingrediente-agregar-btn"
                                class="mt-2 px-4 py-2 text-sm bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-white rounded">
                        Añadir Ingrediente
                        </button>
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
                            <select name="ingredientes[INDEX][id]" required
                                    class="w-1/3 border border-gray-300 dark:border-gray-600 px-2 py-1 rounded text-sm dark:bg-gray-800 dark:text-white">
                                <option value="">-- Selecciona un Ingrediente --</option>
                                </select>
                            <input type="number" name="ingredientes[INDEX][cantidad_bruta]" step="0.01" min="0.01" placeholder="Cantidad" required
                                        class="w-1/4 border border-gray-300 dark:border-gray-600 px-2 py-1 rounded text-sm dark:bg-gray-800 dark:text-white">
                            <input type="text" name="ingredientes[INDEX][unidad_receta_medida]" placeholder="Unidad (ej: kg, l, unidad)" required
                                        class="w-1/4 border border-gray-300 dark:border-gray-600 px-2 py-1 rounded text-sm dark:bg-gray-800 dark:text-white">
                            <button type="button" class="ingrediente-eliminar-btn px-3 py-1 bg-red-500 text-white rounded text-xs">
                                Eliminar
                            </button>
                        </div>
                    </template>
                    
                    <div>
                        <label for="tiempo_preparacion" class="block text-sm text-gray-700 dark:text-gray-300">Tiempo de Preparación (minutos)</label>
                        <input type="number" id="tiempo_preparacion" name="tiempo_preparacion" value="<?php echo e(old('tiempo_preparacion', $receta->tiempo_preparacion)); ?>"
                               class="w-full border border-gray-300 dark:border-gray-600 px-2 py-1 rounded text-sm dark:bg-gray-800 dark:text-white">
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
                        <input type="number" id="tiempo_coccion" name="tiempo_coccion" value="<?php echo e(old('tiempo_coccion', $receta->tiempo_coccion)); ?>"
                               class="w-full border border-gray-300 dark:border-gray-600 px-2 py-1 rounded text-sm dark:bg-gray-800 dark:text-white">
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
                        <input type="number" id="porciones" name="porciones" value="<?php echo e(old('porciones', $receta->porciones)); ?>"
                               class="w-full border border-gray-300 dark:border-gray-600 px-2 py-1 rounded text-sm dark:bg-gray-800 dark:text-white">
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
                        <select id="dificultad" name="dificultad"
                                class="w-full border border-gray-300 dark:border-gray-600 px-2 py-1 rounded text-sm dark:bg-gray-800 dark:text-white">
                            <option value="fácil" <?php echo e(old('dificultad', $receta->dificultad) == 'fácil' ? 'selected' : ''); ?>>Fácil</option>
                            <option value="media" <?php echo e(old('dificultad', $receta->dificultad) == 'media' ? 'selected' : ''); ?>>Media</option>
                            <option value="difícil" <?php echo e(old('dificultad', $receta->dificultad) == 'difícil' ? 'selected' : ''); ?>>Difícil</option>
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
                        <input type="number" id="margen_beneficio" name="margen_beneficio" value="<?php echo e(old('margen_beneficio', $receta->margen_beneficio)); ?>"
                               step="0.01" min="0"
                               class="w-full border border-gray-300 dark:border-gray-600 px-2 py-1 rounded text-sm dark:bg-gray-800 dark:text-white">
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
                        <?php if($receta->imagen): ?>
                            <img src="<?php echo e(asset('storage/' . $receta->imagen)); ?>" alt="Imagen actual de la receta" class="w-48 mb-2 rounded">
                            <p class="text-sm text-gray-600 dark:text-gray-400">Cambiar imagen:</p>
                        <?php endif; ?>
                        <input type="file" id="imagen" name="imagen" accept="image/*"
                               class="text-sm text-gray-700 dark:text-gray-300">
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
                        <button type="submit"
                                class="px-4 py-2 text-sm bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-white rounded">
                            Actualizar Receta
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

 
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const ingredienteContenedor = document.getElementById('ingredientes-contenedor');
        const ingredienteAgregar = document.getElementById('ingrediente-agregar-btn');
        const ingredienteFilas = document.getElementById('ingrediente-filas');
        let ingrediente = 0;

        const ingredienteAntiguo = <?php echo json_encode(old('ingredientes', []), 512) ?>;
        const ingredienteExiste = <?php echo json_encode($receta->ingredientes->map(function($relacion) {return ['ingrediente_id' => $relacion->id, 'cantidad_bruta' => $relacion->pivot->cantidad_bruta, 'unidad_receta_medida' => $relacion->pivot->unidad_receta_medida];})) ?>;
        const ingredientesDisponiblesJs = <?php echo json_encode($ingredientesDisponibles, 15, 512) ?>; // ¡Aquí está!

        function añadirIngrediente(ingredienteDato = null) {
            const fila = ingredienteFilas.content.cloneNode(true);
            const filaDiv = fila.querySelector('.ingrediente-fila');

            // Actualizar los atributos 'name' con el índice correcto
            filaDiv.querySelectorAll('[name*="ingredientes[INDEX]"]').forEach(input => {
                input.name = input.name.replace('INDEX', ingrediente);
            });

            // Generar las opciones del select de ingredientes
            const selectId = filaDiv.querySelector('select[name*="[id]"]');
            if (selectId) {
                // Iterar sobre los ingredientes disponibles en JS y crear las <option>
                ingredientesDisponiblesJs.forEach(ing => {
                    const option = document.createElement('option');
                    option.value = ing.id;
                    option.textContent = ing.nombre;
                    selectId.appendChild(option);
                });

                // Seleccionar el ingrediente correcto si se proporciona data
                if (ingredienteDato && (ingredienteDato.ingrediente_id || ingredienteDato.id)) {
                     selectId.value = ingredienteDato.ingrediente_id || ingredienteDato.id;
                }
            }


            // Rellenar la fila si se proporciona data (para old() values o ingredientes existentes)
            if (ingredienteDato) {
                const inputCantidad = filaDiv.querySelector('input[name*="[cantidad_bruta]"]');
                const inputUnidad = filaDiv.querySelector('input[name*="[unidad_receta_medida]"]');

                if (inputCantidad) inputCantidad.value = ingredienteDato.cantidad_bruta || '';
                if (inputUnidad) inputUnidad.value = ingredienteDato.unidad_receta_medida || '';
            }

            // Añadir el listener para el botón de eliminar
            filaDiv.querySelector('.ingrediente-eliminar-btn').addEventListener('click', function() {
                filaDiv.remove();
            });

            ingredienteContenedor.appendChild(filaDiv);
            ingrediente++;
        }

        let ingredienteArray = [];
        if (ingredienteAntiguo.length > 0) {
            ingredienteArray = ingredienteAntiguo;
        } else if (ingredienteExiste.length > 0) {
            ingredienteArray = ingredienteExiste;
        }

        if (ingredienteArray.length > 0) {
            ingredienteArray.forEach(ingrediente => añadirIngrediente(ingrediente));
        } else {
            añadirIngrediente(); // Si no hay ninguno, añadir una fila vacía para empezar
        }

        ingredienteAgregar.addEventListener('click', function() {
            añadirIngrediente();
	});
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
<?php endif; ?><?php /**PATH /var/www/html/resources/views/recetas/edit.blade.php ENDPATH**/ ?>