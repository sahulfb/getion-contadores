/**
 * Variables
 */
var form = document.getElementById('form-datos');
var inputNombre = document.getElementById('input-nombre');
var inputCorreo = document.getElementById('input-correo');
var inputClave = document.getElementById('input-clave');
var inputIdRol = document.getElementById('input-idRol');
var inputActivo = document.getElementById('input-activo');

form.onsubmit = function(e) {
    e.preventDefault();
    GuardarCambios();
}

function GuardarCambios() {
    let url = `${BASE_URL}/Gestion_Sistema/CRUD_Usuarios/Modificar/`;
    let data = new FormData(form);

    AJAX.enviar({
        url: url,
        data: data,
        antes: function() {
            Loader.show();
        },
        error: function(mensaje) {
            Loader.hide();
            Alerta.danger('Error al modificar el usuario', mensaje);
        },
        ok: function(data) {
            Loader.hide();
            location.reload();
        }
    });
}