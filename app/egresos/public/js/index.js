/**
 * Variables
 */
let idTabla = "tabla";
let labelMontoTotal = 'label-montoTotal';
let filtros = {
    centros: document.getElementById('filter-centro'),
    fecha: {
        desde: document.getElementById("filter-fecha-desde"),
        hasta: document.getElementById("filter-fecha-hasta")
    }
};
let nuevo = {
    modal: $("#modal-nuevo"),
    form: document.getElementById('form-nuevo')
};
let editar = {
    modal: $("#modal-editar"),
    form: document.getElementById('form-editar'),
    inputs: {
        idEgreso: document.getElementById('editar-input-idEgreso'),
        fecha: document.getElementById('editar-input-fecha'),
        detalle: document.getElementById('editar-input-detalle'),
        montoCLP: document.getElementById('editar-input-montoCLP'),
        idCentroCosto: document.getElementById('editar-input-idCentroCosto'),
        observacion: document.getElementById('editar-input-observacion')
    }
};
let eliminar = {
    modal: $("#modal-eliminar"),
    form: document.getElementById('form-eliminar'),
    label: document.getElementById("eliminar-label-id"),
    inputs: {
        id: document.getElementById('eliminar-input-idEgreso')
    }
};

/**
 * Tabla
 */
let tabla = $('#'+idTabla).DataTable( {
    "processing": true,
    "serverSide": true,
    "ajax": {
        url: `${BASE_URL}/Egresos/CRUD/Consultar/`,
        dataSrc: function(d) {
            let labelTotal = document.getElementById(labelMontoTotal);
            if(labelTotal != undefined) {
                labelTotal.innerHTML = d.monto_total;
            }
            return d.data;
        },
        data: function(d) {
            $.extend(d, {
                filter: {
                    centro: filtros.centros.value,
                    rangoFecha: `${filtros.fecha.desde.value} ${filtros.fecha.hasta.value}`
                }
            });
        }
    },
    "createdRow": function(row, data, dataIndex) {
        let newClass = "table-success";
        if(data.Status.id == 2) {
            newClass = "table-danger";
        }
        row.className += " "+newClass;
    },
    "columns": [
        {
            "data": "idEgreso",
            "className": 'text-center vertical-middle'
        },
        {
            "data": "fecha",
            "className": 'vertical-middle text-center'
        },
        {
            "data": "detalle",
            "className": 'vertical-middle'
        },
        {
            "data": "montoCLP",
            "className": 'vertical-middle text-right'
        },
        {
            "data": "centroCosto",
            "className": 'vertical-middle',
            "render": function(data, type, row) {
                return data.nombre;
            }
        },
        {
            "data": "Status",
            "className": 'vertical-middle text-center',
            "render": function(data, type, row) {
                let className = 'badge-success';
                if(data.id == "2") className = 'badge-danger';
                return `<div class="badge ${className}">${data.nombre}</div>`;
            }
        },
        {
            'orderable': false,
            'className': 'text-center text-truncate vertical-middle',
            'render': function(data, type, row) {
                let disabled = (row.Status.id == '2') ? 'disabled' : '';
                return `<div>
                    <button class="btn btn-sm btn-success editar" ${disabled}>
                        <i class="fas fa-edit"></i>
                    </button>
                    
                    <button class="btn btn-sm btn-danger eliminar" ${disabled}>
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </div>`;
            }
        }
    ]
} );

function RefrescarTabla() {
    tabla.ajax.reload(null, false);
}

/**
 * Filtros
 */
document.querySelector('#tabla_filter').className = "text-center text-md-right";
document.querySelector('#tabla_filter').innerHTML = `<div>
    <div class="d-block d-md-inline mb-3 mb-md-0 mr-2 p-1 border rounded bg-light position-relative" style="top: 2px;">
        <label class="mb-0">Monto total: <b id="${labelMontoTotal}">0</b></label>
    </div>
    <div class="d-block d-md-inline">
        <button class="btn btn-sm btn-outline-secondary" data-toggle="collapse" data-target="#filtros">
            <i class="fas fa-search"></i> Filtros
        </button>
    </div>
</div>`;

filtros.centros.onchange = function() {
    RefrescarTabla();
}

filtros.fecha.desde.onchange = function() {
    RefrescarTabla();
}
filtros.fecha.hasta.onchange = function() {
    RefrescarTabla();
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
    let url = `${BASE_URL}/Egresos/CRUD/Registrar/`;
    let data = new FormData(nuevo.form);

    AJAX.enviar({
        url: url,
        data: data,
        antes: function() {
            Loader.show();
        },
        error: function(mensaje) {
            Loader.hide();
            Alerta.danger('Registrar egreso', mensaje);
        },
        ok: function(data) {
            nuevo.form.reset();
            RefrescarTabla();
            Loader.hide();
            nuevo.modal.modal('hide');
            Alerta.success('Registrar egreso', 'Se ha registrado el egreso exitosamente.');
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
    let aFecha = data.fecha.split('/');
    let fecha = aFecha[2]+"-"+aFecha[1]+"-"+aFecha[0];
    let montoString = data.montoCLP.split(' ')[0].replace(/\./, '').replace(/\,/, '.');
    let montoCLP = Number(montoString);

    editar.inputs.idEgreso.value = data.idEgreso;
    editar.inputs.fecha.value = fecha;
    editar.inputs.detalle.value = data.detalle;
    editar.inputs.montoCLP.value = montoCLP;
    editar.inputs.idCentroCosto.value = data.centroCosto.id;
    editar.inputs.observacion.value = data.observacion;
    console.log(data);

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
    let url = `${BASE_URL}/Egresos/CRUD/Modificar/`;
    let data = new FormData(editar.form);

    AJAX.enviar({
        url: url,
        data: data,
        antes: function() {
            Loader.show();
        },
        error: function(mensaje) {
            Loader.hide();
            Alerta.danger('Modificar egreso', mensaje);
        },
        ok: function(data) {
            RefrescarTabla();
            Loader.hide();
            editar.modal.modal('hide');
            Alerta.success('Modificar egreso', 'Se ha modificado el egreso exitosamente.');
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
    eliminar.inputs.id.value = data.idEgreso;
    eliminar.label.innerHTML = data.idEgreso;
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
    let url = `${BASE_URL}/Egresos/CRUD/Anular/`;
    let data = new FormData(eliminar.form);

    AJAX.enviar({
        url: url,
        data: data,
        antes: function() {
            Loader.show();
        },
        error: function(mensaje) {
            Loader.hide();
            Alerta.danger('Anular egreso', mensaje);
        },
        ok: function(data) {
            RefrescarTabla();
            Loader.hide();
            eliminar.modal.modal('hide');
            Alerta.success('Anular egreso', 'Egreso anulado exitosamente');
        }
    });
}