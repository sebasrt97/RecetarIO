console.log('Componente alerta cargado')
class Alerta extends HTMLElement {
    connectedCallback() {
        const mensaje = this.getAttribute('message') || 'Operación realizada correctamente';
        this.innerHTML = `
            <div style="
                background-color: rgb(76, 117, 211);
                color: white;
                padding: 10px;
                border-radius: 5px;
                text-align: center;
                font-family: Arial, sans-serif;
                font-size: 13px;
                font-weight: bold;
            ">
                ${mensaje}
            </div>
        `;
    }
}

customElements.define('alerta-mensaje', Alerta);
