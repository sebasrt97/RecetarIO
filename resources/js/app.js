import './bootstrap';

document.addEventListener('DOMContentLoaded', () => {

    const recetaForm = document.getElementById('receta-form');

    if (recetaForm) {

        const nombre = document.getElementById('nombre');
        const descripcion = document.getElementById("descripcion");
        const ingredientes = document.getElementById('ingredientes');
        const instrucciones = document.getElementById('instrucciones');
        const tiempoPreparacion = document.getElementById('tiempo_preparacion');
        const tiempoCoccion = document.getElementById('tiempo_coccion');
        const porciones = document.getElementById('porciones');
        const dificultad = document.getElementById('dificultad');

        const nombreError = document.getElementById('nombre-error');
        const descripcionError = document.getElementById("descripcion-error");
        const ingredientesError = document.getElementById('ingredientes-error');
        const instruccionesError = document.getElementById('instrucciones-error');
        const tiempoPreparacionError = document.getElementById('tiempo-preparacion-error');
        const tiempoCoccionError = document.getElementById('tiempo-coccion-error');
        const porcionesError = document.getElementById('porciones-error');
        const dificultadError = document.getElementById('dificultad-error');


        if (nombre) {
            nombre.addEventListener("blur", () => {
                nombre.value = nombre.value.trim();
                validarTexto(nombre, nombreError, "El nombre de la receta no puede estar vacío.");
            });
        }

        if (descripcion) {
            descripcion.addEventListener("blur", () => {
                descripcion.value = descripcion.value.trim();
            });
        }

        if (ingredientes) {
            ingredientes.addEventListener("blur", () => {
                ingredientes.value = ingredientes.value.trim();
                validarTextArea(ingredientes, ingredientesError, "Debe introducir al menos un ingrediente."); // Usando validarTextArea
            });
        }

        if (instrucciones) {
            instrucciones.addEventListener("blur", () => {
                instrucciones.value = instrucciones.value.trim();
                validarTextArea(instrucciones, instruccionesError, "Debe introducir al menos una instrucción."); // Usando validarTextArea
            });
        }

        if (tiempoPreparacion) {
            tiempoPreparacion.addEventListener("input", () => {
                validarNumero(tiempoPreparacion, tiempoPreparacionError, "Debe ser un número positivo.", 0);
            });
        }

        if (tiempoCoccion) {
            tiempoCoccion.addEventListener("input", () => {
                validarNumero(tiempoCoccion, tiempoCoccionError, "Debe ser un número positivo.", 0);
            });
        }

        if (porciones) {
            porciones.addEventListener("input", () => {
                validarNumero(porciones, porcionesError, "Debe ser un número de porciones válido (mínimo 1).", 1);
            });
        }

        if (dificultad) {
            dificultad.addEventListener("change", () => {
                validarSelect(dificultad, dificultadError, "Por favor, selecciona una dificultad.");
            });
        }

        recetaForm.addEventListener("submit", (event) => {
            let formValido = true;


            if (!validarTexto(nombre, nombreError, "El nombre de la receta no puede estar vacío."))
                formValido = false;
            if (!validarTextArea(ingredientes, ingredientesError, "Debe introducir al menos un ingrediente."))
                formValido = false;
            if (!validarTextArea(instrucciones, instruccionesError, "Debe introducir al menos una instrucción."))
                formValido = false;
            if (!validarNumero(tiempoPreparacion, tiempoPreparacionError, "Debe ser un número positivo.", 0))
                formValido = false;
            if (!validarNumero(tiempoCoccion, tiempoCoccionError, "Debe ser un número positivo.", 0))
                formValido = false;
            if (!validarNumero(porciones, porcionesError, "Debe ser un número de porciones válido (mínimo 1).", 1))
                formValido = false;
            if (!validarSelect(dificultad, dificultadError, "Por favor, selecciona una dificultad."))
                formValido = false;


            if (!formValido) {
                event.preventDefault();
                alert("Por favor, corrige los errores del formulario.");
            }
        });

        function mostrarError(valido, errorElemento, mensajeError) {
            if (valido) {
                errorElemento.textContent = '';
                errorElemento.style.display = 'none';
            } else {
                errorElemento.textContent = mensajeError;
                errorElemento.style.display = 'inline';
            }
        }

        function validarTexto(campo, errorElemento, mensajeError) {
            const valido = campo.value.trim() !== "";
            mostrarError(valido, errorElemento, mensajeError);
            return valido;
        }

        function validarNumero(campo, errorElemento, mensajeError, min = 0) {
            const valor = parseFloat(campo.value);
            const valido = !isNaN(valor) && valor >= min;
            mostrarError(valido, errorElemento, mensajeError);
            return valido;
        }

        function validarTextArea(campo, errorElemento, mensajeError) {
            const lineas = campo.value.split('\n').map(line => line.trim()).filter(line => line !== '');
            const valido = lineas.length > 0;
            mostrarError(valido, errorElemento, mensajeError);
            return valido;
        }


        function validarSelect(campo, errorElemento, mensajeError) {
            const valido = campo.value !== "" && campo.value !== null;
            mostrarError(valido, errorElemento, mensajeError);
            return valido;
        }

    }
});