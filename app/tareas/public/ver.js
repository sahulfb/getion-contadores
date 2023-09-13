/**
 * Select 2
 */
$("[name=empresa]").select2();
$("[name=usuario]").select2();

/**
 * Actualizar
 */
$("#form-datos").on('submit', (e) => {
    e.preventDefault();
    actualizar();
});

function actualizar() {
    let url = `${BASE_URL}/tareas/api/modificar/`;
    let data = new FormData( $("#form-datos")[0] );
    data.append('id', ID);

    AJAX.enviar({
        url: url,
        data: data,
        antes: function() {
            Loader.show();
        },
        error: function(mensaje) {
            Loader.hide();
            Alerta.danger('Modificar tarea', mensaje);
        },
        ok: function(data) {
            location.reload();
        }
    });
}

/**
 * Cerrar
 */
function cerrar() {
    let url = `${BASE_URL}/tareas/api/estado/`;
    let data = new FormData();
    data.append('id', ID);
    data.append('estado_id', '4');

    AJAX.enviar({
        url: url,
        data: data,
        antes: function() {
            Loader.show();
        },
        error: function(mensaje) {
            Loader.hide();
            Alerta.danger('Cambiar estado de la tarea', mensaje);
        },
        ok: function(data) {
            location.reload();
        }
    });
}

/**
 * Abrir
 */
function abrir () {
    let url = `${BASE_URL}/tareas/api/estado/`;
    let data = new FormData();
    data.append('id', ID);
    data.append('estado_id', '1');

    AJAX.enviar({
        url: url,
        data: data,
        antes: function() {
            Loader.show();
        },
        error: function(mensaje) {
            Loader.hide();
            Alerta.danger('Cambiar estado de la tarea', mensaje);
        },
        ok: function(data) {
            location.reload();
        }
    });
}

/**
 * Anular
*/
function anular() {
    let url = `${BASE_URL}/tareas/api/anular/`;
    let data = new FormData();
    data.append('id', ID);
    data.append('justificacion', $("#anular-justificacion").val());

    AJAX.enviar({
        url: url,
        data: data,
        antes: function() {
            Loader.show();
        },
        error: function(mensaje) {
            Loader.hide();
            Alerta.danger('Cambiar estado de la tarea', mensaje);
        },
        ok: function(data) {
            location.reload();
        }
    });
}

/**
 * Agregar una acción
 */
$("#form-nuevo").on('submit', (e) => {
    e.preventDefault();
    agregar_accion();
});

function agregar_accion() {
    let url = `${BASE_URL}/tareas/api_historial/registrar/`;
    let data = new FormData( $("#form-nuevo")[0] );
    data.append('id', ID);

    AJAX.enviar({
        url: url,
        data: data,
        antes: function() {
            Loader.show();
        },
        error: function(mensaje) {
            Loader.hide();
            Alerta.danger('Agregar acción al historial', mensaje);
        },
        ok: function(data) {
            location.reload();
        }
    });
}

/**
 * Anular una acción
 */
function modal_anular_accion(accion_id) {
    let cambio = CAMBIOS.find(item => item.id == accion_id);
    if(cambio == undefined) return;

    let datetime = cambio.created_at.split(' ');
    let aFecha = datetime[0].split('-');
    let fecha = `${aFecha[2]}/${aFecha[1]}/${aFecha[0]}`;
    let hora = datetime[1];

    $("#anular_accion-input-id").val(cambio.id);
    $("#anular_accion-label-fecha").html(`${fecha} - ${hora}`);
    $("#anular_accion-label-usuario").html(cambio.usuario.nombre);
    $("#anular_accion-label-comentario").html(cambio.comentario);
    $("#modal-anular_accion").modal('show');
}

$("#form-anular_accion").on('submit', (e) => {
    e.preventDefault();
    anular_accion();
});

function anular_accion() {
    let url = `${BASE_URL}/tareas/api_historial/anular/`;
    let data = new FormData( $("#form-anular_accion")[0] );

    AJAX.enviar({
        url: url,
        data: data,
        antes: function() {
            Loader.show();
        },
        error: function(mensaje) {
            Loader.hide();
            Alerta.danger('Anular acción del historial', mensaje);
        },
        ok: function(data) {
            location.reload();
        }
    });
}