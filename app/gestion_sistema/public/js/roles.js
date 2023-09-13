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
    inputIdRol: document.getElementById('editar-input-idRol'),
    inputNombre: document.getElementById('editar-input-nombre'),
    inputDescripcion: document.getElementById('editar-input-descripcion')
};

let permisos = {
    modal: $("#modal-permisos"),
    labelNombre: document.getElementById('permisos-label-nombre'),
    tbody: document.getElementById('permisos-tbody')
};

let eliminar = {
    modal: $('#modal-eliminar'),
    form: document.getElementById('form-eliminar'),
    inputIdRol: document.getElementById('eliminar-input-idRol'),
    labelNombre: document.getElementById('eliminar-label-nombre'),
    inputIdRolSustituto: document.getElementById('eliminar-input-idRolSustituto')
};

/**
 * Tabla
 */
let tabla = $('#'+idTabla).DataTable( {
    "processing": true,
    "serverSide": true,
    "ajax": `${BASE_URL}/Gestion_Sistema/CRUD_Roles/Consultar/`,
    "columns": [
        {
            "data": "idRol",
            "className": 'text-center vertical-middle'

        },
        {
            "data": "nombre",
            "className": 'vertical-middle'
        },
        {
            "data": "descripcion",
            "className": 'vertical-middle'
        },
        {
            'orderable': false,
            'className': 'text-center text-truncate vertical-middle',
            "defaultContent": `<div>
                <button class="btn btn-sm btn-success editar">
                    <i class="fas fa-edit"></i>
                </button>

                <button class="btn btn-sm btn-info permisos">
                    <i class="fas fa-key"></i>
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
 * Proceso para registrar rol
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
    let url = `${BASE_URL}/Gestion_Sistema/CRUD_Roles/Registrar/`;
    let data = new FormData(nuevo.form);

    AJAX.enviar({
        url: url,
        data: data,
        antes: function() {
            Loader.show();
        },
        error: function(mensaje) {
            Loader.hide();
            Alerta.danger('Registrar rol', mensaje);
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
 * Proceso para modificar rol
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
    editar.inputIdRol.value = data.idRol;
    editar.inputNombre.value = data.nombre;
    editar.inputDescripcion.value = data.descripcion;
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
    let url = `${BASE_URL}/Gestion_Sistema/CRUD_Roles/Modificar/`;
    let data = new FormData(editar.form);

    AJAX.enviar({
        url: url,
        data: data,
        antes: function() {
            Loader.show();
        },
        error: function(mensaje) {
            Loader.hide();
            Alerta.danger('Modificar rol', mensaje);
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
 * Proceso para modificar permisos
 * 
 */
tabla.on('click', 'td button.permisos', function() {
    var data = tabla.row( $(this).parents('tr') ).data();
    ModalPermisos(data);
});

function ModalPermisos(rowData) {
    let url = `${BASE_URL}/Gestion_Sistema/CRUD_Permisos/Consultar/`;
    let data = new FormData();
    data.append('idRol', rowData.idRol);

    AJAX.enviar({
        url: url,
        data: data,
        antes: function() {
            Loader.show();
        },
        error: function(mensaje) {
            Loader.hide();
            Alerta.danger('Consulta de permisos', mensaje);
        },
        ok: function(data) {
            Loader.hide();
            permisos.labelNombre.innerHTML = rowData.nombre;

            let codeHTML = "";
            for(let keyMenuA in data) {
                let menuA = data[keyMenuA];
                codeHTML += `<tr class="table-sm">
                    <td class="vertical-middle">
                        <i class="ml-1 ${menuA.image} mr-1"></i>
                        ${menuA.label}
                    </td>

                    <td class="text-center vertical-middle">
                        <button class="btn btn-sm btn-${(menuA.permiso) ? 'success' : 'danger'}" onclick="CambiarPermiso('A-${menuA.id}-${rowData.idRol}')">
                            ${(menuA.permiso) ? 'Si' : 'No'}
                            <i class="fas fa-sync ml-2"></i>
                        </button>
                    </td>
                </tr>`;

                for(let keyMenuB in menuA.opciones) {
                    let menuB = menuA.opciones[keyMenuB];
                    codeHTML += `<tr class="table-sm">
                        <td class="vertical-middle">
                            <i class="ml-3 ${menuB.image} mr-1"></i>
                            ${menuB.label}
                        </td>
    
                        <td class="text-center vertical-middle">
                            <button class="btn btn-sm btn-${(menuB.permiso) ? 'success' : 'danger'}" onclick="CambiarPermiso('B-${menuB.id}-${rowData.idRol}')">
                                ${(menuB.permiso) ? 'Si' : 'No'}
                                <i class="fas fa-sync ml-2"></i>
                            </button>
                        </td>
                    </tr>`;
                }
            }
            permisos.tbody.innerHTML = codeHTML;

            permisos.modal.modal('show');
        }
    });
}

function CambiarPermiso(menu) {
    let arrayMenu = menu.split('-');
    let tipo = arrayMenu[0];
    let idMenu = arrayMenu[1];
    let idRol = arrayMenu[2];

    let url = `${BASE_URL}/Gestion_Sistema/CRUD_Permisos/Cambiar/`;
    let data = new FormData();
    data.append('tipo', tipo);
    data.append('idMenu', idMenu);
    data.append('idRol', idRol);

    AJAX.enviar({
        url: url,
        data: data,
        antes: function() {
            Loader.show();
        },
        error: function(mensaje) {
            Loader.hide();
            Alerta.danger('Cambio de permisos', mensaje);
        },
        ok: function(data) {
            Loader.hide();
            ModalPermisos(data);
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
    eliminar.inputIdRol.value = data.idRol;
    eliminar.labelNombre.innerHTML = data.nombre;
    
    let options = eliminar.inputIdRolSustituto.getElementsByTagName('option');
    for(let option of options) {
        if(option.value == data.idRol) {
            option.setAttribute('disabled', '');
        } else {
            option.removeAttribute('disabled');
        }
    }

    if(options[0].selected && options[0].disabled) {
        options[1].selected = true;
    } else {
        options[0].selected = true;
    }

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
    let url = `${BASE_URL}/Gestion_Sistema/CRUD_Roles/Eliminar/`;
    let data = new FormData(eliminar.form);

    AJAX.enviar({
        url: url,
        data: data,
        antes: function() {
            Loader.show();
        },
        error: function(mensaje) {
            Loader.hide();
            Alerta.danger('Eliminar rol', mensaje);
        },
        ok: function(data) {
            RefrescarTabla();
            Loader.hide();
            eliminar.modal.modal('hide');
        }
    });
}