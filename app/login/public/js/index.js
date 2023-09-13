/**
 * Elementos
 */
let form = document.getElementById('form-login');

form.onsubmit = (event) => {
    event.preventDefault();
    Acceder();
}

function Acceder() {
    let url = `${BASE_URL}/Login/Acceder/`;
    let data = new FormData(form);

    AJAX.enviar({
        url: url,
        data: data,
        antes: () => {
            Loader.show();
        },
        error: (mensaje) => {
            Loader.hide();
            Alerta.danger('Error al iniciar sesión', mensaje);
        },
        ok: (data) => {
            location.href = BASE_URL;
        }
    });
}