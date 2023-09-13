/**
 * Variables
 */
let form = document.getElementById('form-datos');

form.onsubmit = function(e) {
    e.preventDefault();
    ModificarDatos();
}

function ModificarDatos() {
    let url = `${BASE_URL}/Empresas/CRUD/Modificar/`;
    let data = new FormData(form);

    AJAX.enviar({
        url: url,
        data: data,
        antes: function() {
            Loader.show();
        },
        error: function(mensaje) {
            Loader.hide();
            Alerta.danger('Modificar empresa', mensaje);
        },
        ok: function(data) {
            Loader.hide();
            Alerta.success('Modificar empresa', 'Se realizaron los cambios exitosamente.');
        }
    });
}

$("#input-idPlan").on('change', () => {
    let plan = PLANES.find(item => item.idPlan == $("#input-idPlan").val());
    if(plan == undefined) {
        $("#input-detalle").val('');
        return;
    }
    $("#input-detalle").val( plan.detalle );
});
$("#input-idPlan").trigger('change');

$("#input-idPlan-sinMovimiento").on('change', () => {
    let plan = PLANES.find(item => item.idPlan == $("#input-idPlan-sinMovimiento").val());
    if(plan == undefined) {
        $("#input-detalle-sinMovimiento").val('');
        return;
    }
    $("#input-detalle-sinMovimiento").val( plan.detalle );
});
$("#input-idPlan-sinMovimiento").trigger('change');