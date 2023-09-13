$("#filter-empresa").select2();

/**
 * Variables
 */
let idTabla = "tabla";
let labelMontoTotal = 'label-montoTotal';
let filtros = {
    empresas: document.getElementById('filter-empresa'),
    status: [
        document.getElementById('filter-status-1'),
        document.getElementById('filter-status-2'),
        document.getElementById('filter-status-3'),
        document.getElementById('filter-status-4')
    ],
    fecha: {
        desde: document.getElementById("filter-fecha-desde"),
        hasta: document.getElementById("filter-fecha-hasta")
    }
};

/**
 * Tabla
 */
let tabla = $('#'+idTabla).DataTable( {
    "processing": true,
    "serverSide": true,
    "order": [0, "desc"],
     "aLengthMenu": [
         [10, 25, 50, 100, -1],
         [10, 25, 50, 100, "Todo"]
     ],
    "ajax": {
        url: `${BASE_URL}/Facturas/CRUD/Consultar/`,
        dataSrc: function(d) {
            let labelTotal = document.getElementById(labelMontoTotal);
            if(labelTotal != undefined) {
                labelTotal.innerHTML = d.monto_total;
            }
            return d.data;
        },
        data: function(d) {
            let filterStatus = "";
            for(let check of filtros.status) {
                if(check.checked) {
                    if(filterStatus != "") filterStatus += "-";
                    filterStatus += check.value;
                }
            }

            $.extend(d, {
                filter: {
                    status: filterStatus,
                    empresa: filtros.empresas.value,
                    rangoFecha: `${filtros.fecha.desde.value} ${filtros.fecha.hasta.value}`
                }
            });
        }
    },
    "createdRow": function(row, data, dataIndex) {
        switch(Number(data.Status.id))
        {
            case 1: row.className += " table-warning";
            break;
                
            case 2: row.className += " table-danger";
            break;
                
            case 3: row.className += " table-success";
            break;
                
            case 4: row.className += " table-success";
            break;
        }
    },
    "columns": [
        {
            "data": "idFactura",
            "className": 'text-center vertical-middle'
        },
        {
            'orderable': false,
            "data": "fechaCobro",
            "className": 'vertical-middle text-center'
        },
        {
            'orderable': false,
            "data": "PeriodoContable",
            "className": 'vertical-middle',
            "render": function(data, type, row) {
                return data.nombre;
            }
        },
        {
            'orderable': false,
            "data": "Empresa",
            "className": 'vertical-middle',
            "render": function(data, type, row) {
                return data.razon_social;
            }
        },
        {
            'orderable': false,
            "data": "numeroFactura",
            "className": 'vertical-middle text-center'
        },
        {
            'orderable': false,
            "data": "servicio",
            "className": 'vertical-middle text-center'
        },
        {
            'orderable': false,
            "data": "valorCobrar",
            "className": 'vertical-middle text-right'
        },
        {
            'orderable': true,
            "data": "con_movimiento",
            "className": 'vertical-middle text-center',
            "render": function(d, type, row) {
                return (d == '1') ? 'Si' : 'No';
            }
        },
        {
            'orderable': false,
            "data": "fechaVencimiento",
            "className": 'vertical-middle text-center'
        },
        {
            'orderable': false,
            "data": "Status",
            "className": 'vertical-middle text-center',
            "render": function(data, type, row) {
                let classBadge = "danger";
                switch(Number(data.id)) {
                    case 1:
                        classBadge = "warning";
                        break;
                        
                    case 4:
                        classBadge = "success";
                        break;
                }
                return `<div class="badge badge-${classBadge}">${data.nombre}</div>`;
            }
        },
        {
            'orderable': false,
            'className': 'text-center text-truncate vertical-middle',
            'render': function(data, type, row) {
                return `<div>
                <a class="btn btn-sm btn-primary ver" href="${BASE_URL}/Facturas/Ver/${row.idFactura}/">
                    <i class="fas fa-eye"></i>
                </a>
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

filtros.empresas.onchange = function() {
    RefrescarTabla();
}

for(let check of filtros.status) {
    check.onchange = function() {
        RefrescarTabla();
    }
}

filtros.fecha.desde.onchange = function() {
    RefrescarTabla();
}
filtros.fecha.hasta.onchange = function() {
    RefrescarTabla();
}