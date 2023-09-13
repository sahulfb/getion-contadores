/**
 * AJAX
 */
const AJAX = {
    /**
     * 
     * @param {{
     *  url: String,
     *  data?: FormData,
     *  method?: String,
     *  antes?: (): void,
     *  error?: (String): void,
     *  ok?: (object): void
     * }} objeto 
     */
    async enviar(objeto) {
        /**
         * Verificamos cada posición del parametro
         */
        if(objeto.url == undefined) throw "[AJAX] -> No se envio la URL.";
        if(objeto.data == undefined) objeto.data = new FormData();
        if(objeto.method == undefined) objeto.method = "POST";
        if(objeto.antes == undefined) objeto.antes = () => {};
        if(objeto.error == undefined) objeto.error = (mensaje) => {};
        if(objeto.ok == undefined) objeto.ok = (body) => {};

        let respuesta = {};

        try
        {
            objeto.antes();
            var response = await fetch(objeto.url, {
                method: objeto.method,
                body: objeto.data
            });

            try {
                respuesta = await response.json();
            } catch(ex) {
                alert("Ocurrio un error con la petición AJAX.");
                console.error(e);
            }
        }
        catch(e)
        {
            objeto.error(e);
        }

        let error = respuesta.error;
        let data = respuesta.body;

        if(error.status == true) {
            objeto.error(error.mensaje);
            console.error(respuesta);
        } else {
            objeto.ok(data);
        }
    },

    /**
     * 
     * @param {{
     *  url: String,
     *  data?: FormData,
     *  method?: String,
     *  antes?: (): void,
     *  error?: (String): void,
     *  ok?: (object): void
     * }} objeto 
     */
    async api(objeto) {
        /**
         * Verificamos cada posición del parametro
         */
        if(objeto.url == undefined) throw "[AJAX] -> No se envio la URL.";
        if(objeto.data == undefined) objeto.data = "";
        if(objeto.method == undefined) objeto.method = "";
        if(objeto.antes == undefined) objeto.antes = () => {};
        if(objeto.error == undefined) objeto.error = (mensaje) => {};
        if(objeto.ok == undefined) objeto.ok = (body) => {};

        let respuesta = {};
        let options = {};
        if(objeto.method != "") options.method = objeto.method;
        if(objeto.data != "") options.data = objeto.method;

        try
        {
            objeto.antes();
            var response = await fetch(objeto.url, options);

            try {
                respuesta = await response.json();
            } catch(ex) {
                alert("Ocurrio un error con la petición AJAX.");
                console.error(e);
            }
        }
        catch(e)
        {
            objeto.error(e);
        }

        objeto.ok(respuesta);
    }
};

/**
 * Modal Loader
 */
const Loader = {
    id: 'modal-loader',

    show() {
        if(document.querySelector("#"+this.id) != undefined) return;
        let modalLoader = document.createElement('div');
        modalLoader.setAttribute('id', this.id);
        modalLoader.innerHTML = `<div class="modal show" data-backdrop="static" aria-modal="true" style="display: block;">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-sm">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="text-center p-3">
                            <div class="spinner-border" role="status"></div>
                        </div>
                    </div>
                </div>                
            </div>
        </div>`;

        document.querySelector('body').appendChild(modalLoader);
    },

    hide() {
        if(document.querySelector("#"+this.id) == undefined) return;
        document.querySelector("#"+this.id).remove();
    }
};

/**
 * Notificaciones
 */
 toastr.options = {
    "closeButton": false,
    "debug": false,
    "newestOnTop": true,
    "progressBar": true,
    "positionClass": "toast-top-right",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
}

const Alerta = {
    idContainer: 'notification-content',

    info(title, msj) { toastr.info(msj, title); },
    success(title, msj) { toastr.success(msj, title); },
    warning(title, msj) { toastr.warning(msj, title); },
    danger(title, msj) { toastr.error(msj, title); },
};

/**
 * Menu lateral
 */
if(document.getElementById('menu-lateral') != undefined)
{
    var parentMenuLateral = document.getElementById('menu-lateral').parentElement;

    function switchMenuLateral() {
        var showAttribute = parentMenuLateral.getAttribute('menu-lateral');
        if(showAttribute == "true") {
            parentMenuLateral.setAttribute('menu-lateral', 'false');
    
            let darkWindows = Array.from(parentMenuLateral.querySelectorAll('.dark-window-movil'));
            for(let darkWindow of darkWindows) {
                darkWindow.remove();
            }
        } else {
            parentMenuLateral.setAttribute('menu-lateral', 'true');
    
            let darkWindow = document.createElement('div');
            darkWindow.setAttribute('class', 'dark-window-movil');
            darkWindow.setAttribute('onclick', 'switchMenuLateral()');
            parentMenuLateral.appendChild(darkWindow);
    
        }
    }
}

/**
 * Cerrar sesión
 */
function CerrarSesion() {
    let url = `${BASE_URL}/Salir/`;

    AJAX.enviar({
        url: url,
        antes() {
            Loader.show();
        },

        error(mensaje) {
            Loader.hide();
            Alerta.danger(mensaje);
        },

        ok() {
            location.href = `${BASE_URL}/Login/`;
        }
    });
}

/**
 * Format Number
 */
 function formatNumber(num, n = 2, s = '.', c = ',') {
    num = Number(num);
	var re = '\\d(?=(\\d{' + (3) + '})+' + (n > 0 ? '\\D' : '$') + ')',
        num = num.toFixed(Math.max(0, ~~n));

    return (c ? num.replace('.', c) : num).replace(new RegExp(re, 'g'), '$&' + (s || ','));
}