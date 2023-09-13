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
    inputIdPeriodo: document.getElementById('editar-input-idPeriodo'),
    inputNombre: document.getElementById('editar-input-nombre')
};

let eliminar = {
    modal: $('#modal-eliminar'),
    form: document.getElementById('form-eliminar'),
    inputIdPeriodo: document.getElementById('eliminar-input-idPeriodo'),
    labelNombre: document.getElementById('eliminar-label-nombre')
};

/**
 * Tabla
 */
let tabla = $('#'+idTabla).DataTable( {
    "processing": true,
    "serverSide": true,
    "ajax": `${BASE_URL}/Periodo_Contable/CRUD/Consultar/`,
    "columns": [
        {
            "data": "idPeriodo",
            "className": 'text-center vertical-middle'

        },
        {
            "data": "nombre",
            "className": 'vertical-middle'
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
    let url = `${BASE_URL}/Periodo_Contable/CRUD/Registrar/`;
    let data = new FormData(nuevo.form);

    AJAX.enviar({
        url: url,
        data: data,
        antes: function() {
            Loader.show();
        },
        error: function(mensaje) {
            Loader.hide();
            Alerta.danger('Registrar periodo contable', mensaje);
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
    editar.inputIdPeriodo.value = data.idPeriodo;
    editar.inputNombre.value = data.nombre;
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
    let url = `${BASE_URL}/Periodo_Contable/CRUD/Modificar/`;
    let data = new FormData(editar.form);

    AJAX.enviar({
        url: url,
        data: data,
        antes: function() {
            Loader.show();
        },
        error: function(mensaje) {
            Loader.hide();
            Alerta.danger('Modificar periodo contable', mensaje);
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
 * Proceso para eliminar rol
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
    eliminar.inputIdPeriodo.value = data.idPeriodo;
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
    let url = `${BASE_URL}/Periodo_Contable/CRUD/Eliminar/`;
    let data = new FormData(eliminar.form);

    AJAX.enviar({
        url: url,
        data: data,
        antes: function() {
            Loader.show();
        },
        error: function(mensaje) {
            Loader.hide();
            Alerta.danger('Eliminar periodos contables', mensaje);
        },
        ok: function(data) {
            RefrescarTabla();
            Loader.hide();
            eliminar.modal.modal('hide');
        }
    });
}