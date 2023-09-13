/**
 * Variables
 */
let idTabla = "tabla";

let nuevo = {
    modal: $("#modal-nuevo"),
    form: document.getElementById('form-nuevo')
};

let eliminar = {
    modal: $('#modal-eliminar'),
    form: document.getElementById('form-eliminar'),
    inputIdUsuario: document.getElementById('eliminar-input-idUsuario'),
    labelNombre: document.getElementById('eliminar-label-nombre')
};

/**
 * Tabla
 */
let tabla = $('#'+idTabla).DataTable( {
    "processing": true,
    "serverSide": true,
    "ajax": `${BASE_URL}/Gestion_Sistema/CRUD_Usuarios/Consultar/`,
    "columns": [
        {
            "data": "idUsuario",
            "className": 'text-center vertical-middle'

        },
        {
            "data": "nombre",
            "className": 'vertical-middle',
            'render': function(data, type, row) {
                return `<a href="${BASE_URL}/Gestion_Sistema/Usuarios/${row.idUsuario}/">
                    <div>${row.nombre}</div>
                </a>`;
            }
        },
        {
            "data": "idRol",
            "className": 'vertical-middle',
            'render': function(data, type, row) {
                return data.nombre;
            }
        },
        {
            "data": "activo",
            "className": 'text-center vertical-middle',
            'orderable': false,
            "render": function(data, type, row) {
                return `<div class="badge badge-${(data) ? 'success' : 'danger'}">
                    ${(data) ? 'Si' : 'No'}
                </div>`;
            }
        },
        {
            'orderable': false,
            'className': 'text-center text-truncate vertical-middle',
            "defaultContent": `<div>
                <button class="btn btn-sm btn-warning activar">
                    <i class="fas fa-power-off"></i>
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
 * Proceso para registrar un usuario
 * 
 */
nuevo.form.onsubmit = function(e) {
    e.preventDefault();
    Registrar();
}

/**
 * Registra un usuario
 */
function Registrar() {
    let url = `${BASE_URL}/Gestion_Sistema/CRUD_Usuarios/Registrar/`;
    let data = new FormData(nuevo.form);

    AJAX.enviar({
        url: url,
        data: data,
        antes: function() {
            Loader.show();
        },
        error: function(mensaje) {
            Loader.hide();
            Alerta.danger('Registro de usuario', mensaje);
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
 * Proceso para activar/desactivar un usuario
 * 
 */
tabla.on('click', 'td button.activar', function() {
    var data = tabla.row( $(this).parents('tr') ).data();
    Desactivar(data);
});

function Desactivar(dataRow) {
    let url = `${BASE_URL}/Gestion_Sistema/CRUD_Usuarios/Activar/`;
    let data = new FormData();
    data.append('idUsuario', dataRow.idUsuario);

    AJAX.enviar({
        url: url,
        data: data,
        antes: function() {
            Loader.show();
        },
        error: function(mensaje) {
            Loader.hide();
            Alerta.danger('Registro de usuario', mensaje);
        },
        ok: function(data) {
            RefrescarTabla();
            Loader.hide();
        }
    });
}

/**
 * 
 * Proceso para eliminar un usuario
 * 
 */

/**
 * Click boton 'Eliminar'
 */
tabla.on('click', 'td button.eliminar', function() {
    var data = tabla.row( $(this).parents('tr') ).data();
    ModalEliminar(data);
});

/**
 * Mostrar el modal con los datos del usuario actual
 * @param {*} data 
 */
function ModalEliminar(data) {
    eliminar.inputIdUsuario.value = data.idUsuario;
    eliminar.labelNombre.innerHTML = data.nombre;
    eliminar.modal.modal('show');
}

eliminar.form.onsubmit = function(e) {
    e.preventDefault();
    Eliminar();
}

/**
 * Eliminar un usuario
 */
function Eliminar() {
    let url = `${BASE_URL}/Gestion_Sistema/CRUD_Usuarios/Eliminar/`;
    let data = new FormData(eliminar.form);

    AJAX.enviar({
        url: url,
        data: data,
        antes: function() {
            Loader.show();
        },
        error: function(mensaje) {
            Loader.hide();
            Alerta.danger('Eliminar de usuario', mensaje);
        },
        ok: function(data) {
            RefrescarTabla();
            Loader.hide();
            eliminar.modal.modal('hide');
        }
    });
}