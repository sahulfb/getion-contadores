/**
 * Elementos
 */
let form = document.getElementById('form-nuevo');
let inputs = {
    idEmpresa: document.getElementById('input-idEmpresa'),
    tipo_plan: document.getElementById('input-tipo_plan'),
    idPlan: document.getElementById('input-idPlan'),
    valorPlan: document.getElementById('input-valorPlan')
};

$('#input-periodoCobro').select2();
$('#input-idEmpresa').select2();
$("#input-servicio").select2();

/**
 * Evento Submit del formulario
 * @param {*} e 
 */
form.onsubmit = function(e) {
    e.preventDefault();
    Registrar();
}

/**
 * Metodo Registrar
 */
function Registrar() {
    let url = `${BASE_URL}/Facturas/CRUD/Registrar/`;
    let data = new FormData(form);

    AJAX.enviar({
        url: url,
        data: data,
        antes: function() {
            Loader.show();
        },
        error: function(mensaje) {
            Loader.hide();
            Alerta.danger('Registro de factura', mensaje);
        },
        ok: function(data) {
            location.href = `${BASE_URL}/Facturas/Index/`;
        }
    });
}

/**
 * Cambio en el input de empresa
 */
inputs.idEmpresa.onchange = function(e) {
    let idEmpresa = inputs.idEmpresa.value;
    let objEmpresa = EMPRESAS.filter(item => item.idEmpresa == idEmpresa)[0];
    if(objEmpresa == undefined || objEmpresa == null) {
        inputs.idPlan.value = "";
        inputs.valorPlan.value = "";
        $("#input-valorCobrar").val('');
        return;
    }

    if(objEmpresa.plan_sinMovimiento == null) {
        $( inputs.tipo_plan ).val('1');
        $( inputs.tipo_plan ).find('option[value=0]').attr('disabled', '');
    } else {
        $( inputs.tipo_plan ).find('option[value=0]').removeAttr('disabled');
    }

    actualizar_plan(objEmpresa);
}

/**
 * Cambio en el input del tipo de plan
 */
inputs.tipo_plan.onchange = function(e) {
    let idEmpresa = inputs.idEmpresa.value;
    let objEmpresa = EMPRESAS.filter(item => item.idEmpresa == idEmpresa)[0];
    if(objEmpresa == undefined || objEmpresa == null) return;
    actualizar_plan(objEmpresa);
}

actualizar_cobros_adicionales();

$("#input-periodoCobro").on('change', function() {
    actualizar_cobros_adicionales();
});

function actualizar_plan(objEmpresa) {
    if( $( inputs.tipo_plan ).val() == '1' ) {
        inputs.idPlan.value = objEmpresa.plan.nombre;
        inputs.valorPlan.value = objEmpresa.plan.monto;
    } else {
        inputs.idPlan.value = objEmpresa.plan_sinMovimiento.nombre;
        inputs.valorPlan.value = objEmpresa.plan_sinMovimiento.monto;
    }

    actualizar_cobros_adicionales();
}

function actualizar_cobros_adicionales() {
    let tbody = $("#modal-cobros-adicionales table tbody");

    let idEmpresa = inputs.idEmpresa.value;
    let objEmpresa = EMPRESAS.filter(item => item.idEmpresa == idEmpresa)[0];
    if(objEmpresa == undefined || objEmpresa == null) {
        tbody.html(`<tr>
            <td colspan="100">
                <h5 class="mb-0 p-3 text-center">Seleccione una empresa y un periodo contable.</h5>
            </td>
        </tr>`);
        return;
    }

    let idPeriodo = $("#input-periodoCobro").val();

    let cobros_adicionales = 0;
    
    if(idPeriodo != "") {
        let periodos = objEmpresa.cobros_adicionales.filter((item) => {
            return item.periodos.find(i => i == idPeriodo) || item.es_fijo == '1';
        });
        
        cobros_adicionales = 0;
        if(periodos.length > 0) {
            tbody.html(``);
            for(let cobro of periodos) {
                cobros_adicionales += cobro.monto;
                
                tbody.append(`<tr>
                    <td class="text-center">${cobro.id}</td>
                    <td class="text-left">${cobro.descripcion}</td>
                    <td class="text-right">${formatNumber(cobro.monto, 0)} ${MONEDA.simbolo}</td>
                </tr>`);
            }

            tbody.append(`<tr class="font-weight-bold">
                <td class="text-left" colspan="2">Total</td>
                <td class="text-right">${formatNumber(cobros_adicionales, 0)} ${MONEDA.simbolo}</td>
            </tr>`);
        }
        else {
            tbody.html(`<tr>
                <td colspan="100">
                    <h5 class="mb-0 p-3 text-center">No hay cobros adicionales asociados.</h5>
                </td>
            </tr>`);
        }
    }
    else {
        tbody.html(`<tr>
            <td colspan="100">
                <h5 class="mb-0 p-3 text-center">Seleccione una empresa y un periodo contable.</h5>
            </td>
        </tr>`);
    }
    
    let monto_plan = 0;
    if( objEmpresa.plan_sinMovimiento != null && $(inputs.tipo_plan).val() == '0' ) {
        monto_plan = objEmpresa.plan_sinMovimiento.value;
    }
    else {
        monto_plan = objEmpresa.plan.value;
    }

    let total = Number(cobros_adicionales) + Number(monto_plan);

    $("#input-cobrosAdicionales").val(`${formatNumber(cobros_adicionales, 0)} ${MONEDA.simbolo}`);
    $("#input-valorCobrar").val(total);
}