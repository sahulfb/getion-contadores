/**
 * Filtros
 */
$("#filtro-estado").on('change', () => {
    RefrescarTabla();
})
$("#filtro-empresa").on('change', () => {
    RefrescarTabla();
})
$("#filtro-usuario").on('change', () => {
    RefrescarTabla();
})

$("#filtro-empresa").select2();
$("#filtro-usuario").select2();

$("#nuevo-input-empresa").select2();
$("#nuevo-input-usuario").select2();

/**
 * Tabla
 */
 let tabla = $('#tabla').DataTable( {
    "processing": true,
    "serverSide": true,
    "aLengthMenu": [
        [10, 25, 50, 100, -1],
        [10, 25, 50, 100, "Todo"]
    ],
    "ajax": {
        url: `${BASE_URL}/tareas/api/datatable/`,
        data: function(d) {
            d.filtros = {
                estado: $("#filtro-estado").val(),
                empresa: $("#filtro-empresa").val(),
                usuario: $("#filtro-usuario").val(),
            };
            return d;
        }
    },
    "createdRow": function(tr, data) {
        $(tr).addClass('tr-success');
        if(data.estado.id == '4') {
            $(tr).addClass('table-success');
        }
    },
    "columns": [
        {
            "data": "id",
            "className": 'text-center vertical-middle',
            "render": function(d, type, row) {
                return `<a href="${BASE_URL}/Tareas/Ver/${row.id}/">${d}</a>`;
            }
        },
        {
            "data": "empresa",
            "className": 'vertical-middle text-truncate',
            "render": function(d, type, row) {
                return d.razon_social;
            }
        },
        {
            "data": "descripcion",
            "className": 'vertical-middle text-truncate max-width-description'
        },
        {
            "data": "fecha_registro",
            "className": 'vertical-middle text-center'
        },
        {
            "data": "fecha_vencimiento",
            "className": 'vertical-middle text-center'
        },
        {
            "data": "estado",
            "className": 'vertical-middle text-center',
            "render": function(d, type, row) {
                return `<div class="badge badge-${d.color_class}">${d.nombre}</div>`;
            }
        },
    ]
} );

function RefrescarTabla() {
    tabla.ajax.reload(null, false);
}

/**
 * Registrar
 */
let nuevo = {
    modal: $("#modal-nuevo"),
    form: document.getElementById('form-nuevo')
};

nuevo.form.onsubmit = function(e) {
    e.preventDefault();
    Registrar();
}

function Registrar() {
    let url = `${BASE_URL}/tareas/api/registrar/`;
    let data = new FormData(nuevo.form);

    AJAX.enviar({
        url: url,
        data: data,
        antes: function() {
            Loader.show();
        },
        error: function(mensaje) {
            Loader.hide();
            Alerta.danger('Registrar tarea', mensaje);
        },
        ok: function(data) {
            nuevo.form.reset();
            RefrescarTabla();
            Loader.hide();
            nuevo.modal.modal('hide');
            Alerta.success('Registrar tarea', 'Tarea registrada exitosamente.');
        }
    });
}