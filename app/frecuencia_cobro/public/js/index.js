/**
 * Variables
 */
let idTabla = "tabla";

let editar = {
    modal: $("#modal-editar"),
    form: document.getElementById('form-editar'),
    inputIdPeriodo: document.getElementById('editar-input-idPeriodo'),
    inputIdPeriodoHidden: document.getElementById('editar-input-idPeriodoHidden'),
    inputNombre: document.getElementById('editar-input-nombre'),
    inputFrecuencia: document.getElementById('editar-input-frecuencia')
};

/**
 * Tabla
 */
let tabla = $('#'+idTabla).DataTable( {
    "processing": true,
    "serverSide": true,
    "ajax": `${BASE_URL}/Frecuencia_Cobro/CRUD/Consultar/`,
    "columns": [
        {
            "data": "idFrecuenciaCobro",
            "className": 'text-center vertical-middle'

        },
        {
            "data": "nombre",
            "className": 'vertical-middle'
        },
        {
            "data": "frecuencia",
            "className": 'vertical-middle text-center'
        },
        {
            'orderable': false,
            'className': 'text-center text-truncate vertical-middle',
            "defaultContent": `<div>
                <button class="btn btn-sm btn-success editar">
                    <i class="fas fa-edit"></i>
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
    editar.inputIdPeriodoHidden.value = data.idPeriodo;
    editar.inputNombre.value = data.nombre;
    editar.inputFrecuencia.value = data.frecuencia;
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
    let url = `${BASE_URL}/Frecuencia_Cobro/CRUD/Modificar/`;
    let data = new FormData(editar.form);

    AJAX.enviar({
        url: url,
        data: data,
        antes: function() {
            Loader.show();
        },
        error: function(mensaje) {
            Loader.hide();
            Alerta.danger('Modificar periodo de cobro', mensaje);
        },
        ok: function(data) {
            RefrescarTabla();
            Loader.hide();
            editar.modal.modal('hide');
        }
    });
}