/**
 * Variables
 */
let container = document.getElementById('rowBody');
let monedaCLP = undefined;
let monedas = [];

let modificar = {
    modal: $("#modal-modificar"),
    form: document.getElementById('form-modificar'),
    inputIdMoneda: document.getElementById('editar-input-idMoneda'),
    inputNombre: document.getElementById('editar-input-nombre'),
    inputSimbolo: document.getElementById('editar-input-simbolo'),
    inputDecimales: document.getElementById('editar-input-decimales')
};

let actualizar = {
    modal: $("#modal-actualizar"),
    form: document.getElementById('form-actualizar'),
    inputIdMoneda: document.getElementById('actualizar-input-idMoneda'),
    inputFecha: document.getElementById('actualizar-input-fecha'),
    inputMonto: document.getElementById('actualizar-input-monto')
};

/**
 * Actualizar
 */
function Refrescar() {
    let url = `${BASE_URL}/Monedas/CRUD/Consultar/`;

    AJAX.enviar({
        url: url,
        antes: function() {
            container.innerHTML = `<div class="col-12">
                <div class="card card-body text-center bg-light">
                    <h5 class="mb-0">Cargando...</h5>
                </div>
            </div>`;
        },
        error: function(mensaje) {
            container.innerHTML = `<div class="col-12">
                <div class="card card-body text-center bg-danger text-white">
                    ${mensaje}
                </div>
            </div>`;
        },
        ok: function(data) {
            monedaCLP = data.CLP;
            monedas = [...data.monedas];
            let codeHTML = "";
            for(let moneda of monedas) {
                codeHTML += CardMonedaHTML(moneda);
            }
            container.innerHTML = codeHTML;
        }
    });
}

function CardMonedaHTML(moneda) {
    return `<div class="col-12 col-md-6 mb-3">
        <div class="card ${moneda.classCard} text-truncate card-button" onclick="ModalActualizar('${moneda.idMoneda}')" oncontextmenu="ModalModificar('${moneda.idMoneda}'); return false;">
            <div class="card-header">
                <h5 class="mb-0">${moneda.nombre} (${moneda.simbolo})</h5>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="h6">
                            <label class="h4" id="card-label-monto">${moneda.precioCLP}</label>
                            <label style="position: relative; top: -5px;">${monedaCLP.simbolo}</label>
                        </div>

                        <div>
                            Simbolo: <label class=" font-weight-bold mb-0">${moneda.simbolo}</label>
                        </div>

                        <div>
                            Decimales: <label class=" font-weight-bold mb-0">${moneda.decimales}</label>
                        </div>

                        <div>
                            Actualización: <label class=" font-weight-bold mb-0">${moneda.fecha_actualizacion}</label>
                        </div>
                    </div>

                    <div class="col-6">
                        <div style="font-size: 4em; opacity: .5;" class="d-flex justify-content-end py-1 text-dark">
                            <i class="fas fa-money-check-alt"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>`;
}

/**
 * Modificar
 * @param {Number} idMoneda 
 */
function ModalModificar(idMoneda) {
    let objMoneda = monedas.filter(item => item.idMoneda == idMoneda)[0];

    let header = modificar.form.querySelector('.modal-header');
    let footerButtons = modificar.form.querySelectorAll('.modal-footer button');
    header.setAttribute('class', `modal-header ${objMoneda.classCard}`);
    footerButtons[1].setAttribute('class', `btn ${objMoneda.classCard}`);

    modificar.inputIdMoneda.value = objMoneda.idMoneda;
    modificar.inputNombre.value = objMoneda.nombre;
    modificar.inputSimbolo.value = objMoneda.simbolo;
    modificar.inputDecimales.value = objMoneda.decimales;

    modificar.modal.modal('show');
}

modificar.form.onsubmit = function(e) {
    e.preventDefault();
    Modificar();
}

function Modificar() {
    let url = `${BASE_URL}/Monedas/CRUD/Modificar/`;
    let data = new FormData(modificar.form);

    AJAX.enviar({
        url: url,
        data: data,
        antes() {
            Loader.show();
        },
        error(mensaje) {
            Loader.hide();
            Alerta.danger(mensaje);
        },
        ok(data) {
            Refrescar();
            Loader.hide();
            Alerta.success('Modificar moneda', 'Modificación exitosa.');
            modificar.modal.modal('hide');
        }
    });
}

/**
 * Actualizar
 * @param {Number} idMoneda 
 */
function ModalActualizar(idMoneda) {
    let objMoneda = monedas.filter(item => item.idMoneda == idMoneda)[0];

    let header = actualizar.form.querySelector('.modal-header');
    let footerButtons = actualizar.form.querySelectorAll('.modal-footer button');
    header.setAttribute('class', `modal-header ${objMoneda.classCard}`);
    footerButtons[1].setAttribute('class', `btn ${objMoneda.classCard}`);

    let monto = objMoneda.precioCLP.replace(/\./, '').replace(/\,/, '.');

    actualizar.inputIdMoneda.value = objMoneda.idMoneda;
    actualizar.inputMonto.value = Number(monto);
    actualizar.inputMonto.disabled = (objMoneda.idMoneda == 1);

    actualizar.modal.modal('show');
}

async function BuscarMindicador() {
    let idMoneda = actualizar.inputIdMoneda.value;
    let objMoneda = monedas.filter(item => item.idMoneda == idMoneda)[0];
    let aFecha = actualizar.inputFecha.value.split('-');
    let fecha = `${aFecha[2]}-${aFecha[1]}-${aFecha[0]}`;
    
    let url = `https://mindicador.cl/api/${objMoneda.codigoMiIndicador}/${fecha}`;
    
    AJAX.api({
        url: url,
        antes() {
            Loader.show();
        },
        error(mensaje) {
            Loader.hide();
            console.error(mensaje);
            Alerta.danger('Mindicador', 'Error al consumir la API.');
        },
        ok(data) {
            Loader.hide();
            let valor = data.serie[0].valor;
            actualizar.inputMonto.value = valor;
        }
    });
}

actualizar.modal.on('hidden.bs.modal', function(e) {
    actualizar.form.reset();
});

actualizar.form.onsubmit = function(e) {
    e.preventDefault();
    Actualizar();
}

function Actualizar() {
    let url = `${BASE_URL}/Monedas/CRUD/Actualizar/`;
    let data = new FormData(actualizar.form);

    AJAX.enviar({
        url: url,
        data: data,
        antes() {
            Loader.show();
        },
        error(mensaje) {
            Loader.hide();
            Alerta.danger('Actualizar precio de la moneda', mensaje);
        },
        ok(data) {
            Refrescar();
            Loader.hide();
            Alerta.success('Actualizar precio', 'Precio actualizado exitosamente.');
            actualizar.modal.modal('hide');
        }
    });
}

Refrescar();