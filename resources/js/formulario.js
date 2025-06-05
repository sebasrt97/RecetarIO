document.querySelectorAll('.form-receta').forEach(form => {
    form.addEventListener('submit', (event) => {
        event.preventDefault();

        const nombre = form.querySelector('[name="nombre"]');
        const descripcion = form.querySelector('[name="descripcion"]');
        const instrucciones = form.querySelector('[name="instrucciones"]');
        const tiempoPreparacion = form.querySelector('[name="tiempo_preparacion"]');
        const tiempoCoccion = form.querySelector('[name="tiempo_coccion"]');
        const porciones = form.querySelector('[name="porciones"]');
        const dificultad = form.querySelector('[name="dificultad"]');

        const errores = [];

        if (!nombre.value.trim()) {
            errores.push('El nombre es obligatorio.');
        }
        if (!descripcion.value.trim()) {
            errores.push('La descripción es obligatoria.');
        }
        if (!instrucciones.value.trim()) {
            errores.push('Las instrucciones son obligatorias.');
        }
        if (!tiempoPreparacion.value.trim() || isNaN(tiempoPreparacion.value) || parseFloat(tiempoPreparacion.value) < 0) {
            errores.push('El tiempo de preparación debe ser un número válido.');
        }
        if (!tiempoCoccion.value.trim() || isNaN(tiempoCoccion.value) || parseFloat(tiempoCoccion.value) < 0) {
            errores.push('El tiempo de cocción debe ser un número válido.');
        }
        if (!porciones.value.trim() || isNaN(porciones.value) || parseInt(porciones.value) < 1) {
            errores.push('Las porciones deben ser un número válido (mínimo 1).');
        }
        if (!dificultad.value) {
            errores.push('La dificultad es obligatoria.');
        }

        if (errores.length > 0) {
            alert(errores.join('\n'));
            return;
        }

        form.submit();
    });
});
