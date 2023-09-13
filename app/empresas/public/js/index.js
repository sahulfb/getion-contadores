/**
 * Variables
 */
let idTabla = "tabla";

let nuevo = {
    modal: $("#modal-nuevo"),
    form: document.getElementById('form-nuevo')
};

/**
 * Tabla
 */
let tabla = $('#'+idTabla).DataTable( {
    "processing": true,
    "serverSide": true,
    "ajax": `${BASE_URL}/Empresas/CRUD/Consultar/`,
    "columns": [
        {
            "data": "idEmpresa",
            "className": 'text-center vertical-middle'

        },
        {
            "data": "rut",
            "className": 'vertical-middle text-center',
            'render': function(data, type, row) {
                return `<a href="${BASE_URL}/Empresas/Index/${row.idEmpresa}/">
                    <div>
                        ${data}
                    </div>
                </a>`;
            }
        },
        {
            "data": "razon_social",
            "className": 'vertical-middle',
            'render': function(data, type, row) {
                return `<a href="${BASE_URL}/Empresas/Index/${row.idEmpresa}/">
                    <div>
                        ${data}
                    </div>
                </a>`;
            }
        },
        {
            "data": "plan",
            "className": 'vertical-middle text-left',
            'render': function(data, type, row) {
                return (data.nombre != "") ? data.nombre : `<label class="text-muted">(No aplica)</label>`;
            }
        },
        {
            "data": "plan_sinMovimiento",
            "className": 'vertical-middle text-left',
            'render': function(data, type, row) {
                return (data.nombre != "") ? data.nombre : `<label class="text-muted">(No aplica)</label>`;
            }
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
    let url = `${BASE_URL}/Empresas/CRUD/Registrar/`;
    let data = new FormData(nuevo.form);

    AJAX.enviar({
        url: url,
        data: data,
        antes: function() {
            Loader.show();
        },
        error: function(mensaje) {
            Loader.hide();
            Alerta.danger('Registrar empresa', mensaje);
        },
        ok: function(data) {
            nuevo.form.reset();
            RefrescarTabla();
            Loader.hide();
            nuevo.modal.modal('hide');
        }
    });
}