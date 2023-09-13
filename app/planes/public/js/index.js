/**
 * Variables
 */
let idTabla = "tabla";

let nuevo = {
    modal: $("#modal-nuevo"),
    form: document.getElementById('form-nuevo')
};

let editar = {
    modal: $("#modal-editar"),
    form: document.getElementById('form-editar'),
    inputIdPlan: document.getElementById('editar-input-idPlan'),
    inputIdPlanShow: document.getElementById('editar-input-idPlanShow'),
    inputCodigo: document.getElementById('editar-input-codigo'),
    inputNombre: document.getElementById('editar-input-nombre'),
    inputIdPeriodo: document.getElementById('editar-input-idPeriodo'),
    inputMonto: document.getElementById('editar-input-monto'),
    inputIdMoneda: document.getElementById('editar-input-idMoneda'),
    inputDetalles: document.getElementById('editar-input-detalle')
};

let eliminar = {
    modal: $('#modal-eliminar'),
    form: document.getElementById('form-eliminar'),
    inputIdPlan: document.getElementById('eliminar-input-idPlan'),
    labelNombre: document.getElementById('eliminar-label-nombre')
};

/**
 * Tabla
 */
let tabla = $('#'+idTabla).DataTable( {
    "processing": true,
    "serverSide": true,
    "ajax": `${BASE_URL}/Planes/CRUD/Consultar/`,
    "columns": [
        {
            "data": "codigo",
            "className": 'vertical-middle text-center'
        },
        {
            "data": "nombre",
            "className": 'vertical-middle'
        },
        {
            "data": "periodo",
            "className": 'vertical-middle text-center',
            "render": function(data, type, row) {
                return data.nombre;
            }
        },
        {
            "data": "monto",
            "className": 'vertical-middle text-center',
            "render": function(data, type, row) {
                return `${data} ${row.moneda.simbolo}`;
            }
        },
        {
            'orderable': false,
            'className': 'text-center text-truncate vertical-middle',
            "defaultContent": `<div>
                <button class="btn btn-sm btn-success editar">
                    <i class="fas fa-edit"></i>
                </button>

                <button class="btn btn-sm btn-danger eliminar">
                    <i class="fas fa-trash-alt"></i>
                </button>
            </div>`
        }
    ]
} );

function RefrescarTabla() {
    tabla.ajax.reload(null, false);
}

/**
 * 
 * Proceso para registrar
 * 
 */
nuevo.form.onsubmit = function(e) {
    e.preventDefault();
    Registrar();
}

/**
 * Registrar
 */
function Registrar() {
    let url = `${BASE_URL}/Planes/CRUD/Registrar/`;
    let data = new FormData(nuevo.form);

    AJAX.enviar({
        url: url,
        data: data,
        antes: function() {
            Loader.show();
        },
        error: function(mensaje) {
            Loader.hide();
            Alerta.danger('Registrar plan', mensaje);
        },
        ok: function(data) {
            nuevo.form.reset();
            RefrescarTabla();
            Loader.hide();
            nuevo.modal.modal('hide');
        }
    });
}

/**
 * 
 * Proceso para modificar
 * 
 */
tabla.on('click', 'td button.editar', function() {
    var data = tabla.row( $(this).parents('tr') ).data();
    ModalEditar(data);
});

/**
 * Mostrar modal para editar
 * @param {*} data 
 */
function ModalEditar(data) {
    editar.inputIdPlan.value = data.idPlan;
    editar.inputIdPlanShow.value = data.idPlan;
    editar.inputCodigo.value = data.codigo;
    editar.inputNombre.value = data.nombre;
    editar.inputIdPeriodo.value = data.periodo.id;
    editar.inputMonto.value = data.monto.replace(/\./g, '').replace(/,/g, '.');
    editar.inputIdMoneda.value = data.moneda.id;
    editar.inputDetalles.value = data.detalle;

    editar.modal.modal('show');
}

editar.form.onsubmit = function(e) {
    e.preventDefault();
    Editar();
}

/**
 * Editar
 */
function Editar() {
    let url = `${BASE_URL}/Planes/CRUD/Modificar/`;
    let data = new FormData(editar.form);

    AJAX.enviar({
        url: url,
        data: data,
        antes: function() {
            Loader.show();
        },
        error: function(mensaje) {
            Loader.hide();
            Alerta.danger('Modificar plan', mensaje);
        },
        ok: function(data) {
            RefrescarTabla();
            Loader.hide();
            editar.modal.modal('hide');
        }
    });
}

/**
 * 
 * Proceso para eliminar
 * 
 */
tabla.on('click', 'td button.eliminar', function() {
    var data = tabla.row( $(this).parents('tr') ).data();
    ModalEliminar(data);
});

/**
 * Mostrar modal para eliminar
 * @param {*} data 
 */
function ModalEliminar(data) {
    eliminar.inputIdPlan.value = data.idPlan;
    eliminar.labelNombre.innerHTML = data.nombre;

    eliminar.modal.modal('show');
}

eliminar.form.onsubmit = function(e) {
    e.preventDefault();
    Eliminar();
}

/**
 * Eliminar
 */
function Eliminar() {
    let url = `${BASE_URL}/Planes/CRUD/Eliminar/`;
    let data = new FormData(eliminar.form);

    AJAX.enviar({
        url: url,
        data: data,
        antes: function() {
            Loader.show();
        },
        error: function(mensaje) {
            Loader.hide();
            Alerta.danger('Eliminar plan', mensaje);
        },
        ok: function(data) {
            RefrescarTabla();
            Loader.hide();
            eliminar.modal.modal('hide');
        }
    });
}