let inputStatus = document.getElementById('input-status');
let form = document.getElementById('form-modificar');
let botones = {
    anular: document.getElementById('boton-anular'),
    actualizar: document.getElementById('boton-actualizar'),
    pagar: document.getElementById('boton-pagar'),
    dicom: document.getElementById('boton-dicom')
};
let pagar = {
    modal: $("#modal-pagar"),
    form: document.getElementById('form-pagar')
};
let inputObservacion = document.getElementById('input-observacion');

$(document).ready(function() {
    let id = inputStatus.getAttribute('idStatus');
    let baseClass = 'form-control form-control-sm font-weight-bold';

    switch(Number(id)) {
        case 1:
            inputStatus.setAttribute('class', `${baseClass} bg-warning text-black`);
        break;
        
        case 2:
            inputStatus.setAttribute('class', `${baseClass} bg-danger text-white`);
        break;
        
        case 3:
            inputStatus.setAttribute('class', `${baseClass} bg-success text-white`);
        break;
        
        case 4:
            inputStatus.setAttribute('class', `${baseClass} bg-success text-white`);
        break;
    }
    
});

/**
 * Dicom
 */
if(botones.dicom != null) {
    botones.dicom.onclick = function() {
        console.log('dicom')
    }
}

/**
 * Anular
 */
if(botones.anular != null) {
    botones.anular.onclick = function() {
        Anular();
    }

    function Anular() {
        let r = confirm('¿Esta seguro que desea anular el factura N° '+ID_FACTURA+'?');
        if(r === false) return;

        let url = `${BASE_URL}/Facturas/CRUD/Anular/`;
        let data = new FormData();
        data.append('idFactura', ID_FACTURA);
        data.append('observacion', inputObservacion.value);

        AJAX.enviar({
            url: url,
            data: data,
            antes() {
                Loader.show();
            },
            error(mensaje) {
                Loader.hide();
                Alerta.danger('Anular factura', mensaje);
            },
            ok(data) {
                location.reload();
            }
        });
    }
}

/**
 * Actualizar
 */
if(botones.actualizar != null) {
    form.onsubmit = function(e) {
        e.preventDefault();
        Actualizar();
    }

    function Actualizar() {
        let url = `${BASE_URL}/Facturas/CRUD/Modificar/`;
        let data = new FormData(form);
        data.append('idFactura', ID_FACTURA);

        AJAX.enviar({
            url: url,
            data: data,
            antes() {
                Loader.show();
            },
            error(mensaje) {
                Loader.hide();
                Alerta.danger('Modificar factura', mensaje);
            },
            ok(data) {
                Loader.hide();
                Alerta.success('Modificar factura', 'Factura modificado exitosamente.');
            }
        });
    }
}

/**
 * Pagar
 */
if(botones.pagar != null) {
    botones.pagar.onclick = function() {
        ModalPagar();
    }

    function ModalPagar() {
        pagar.form.reset();
        pagar.modal.modal('show');
    }

    pagar.form.onsubmit = function(e) {
        e.preventDefault();
        Pagar();
    }

    function Pagar() {
        let url = `${BASE_URL}/Facturas/CRUD/Pagar/`;
        let data = new FormData(pagar.form);
        data.append('idFactura', ID_FACTURA);

        AJAX.enviar({
            url: url,
            data: data,
            antes() {
                Loader.show();
            },
            error(mensaje) {
                Loader.hide();
                Alerta.danger('Pagar factura', mensaje);
            },
            ok(data) {
                location.reload();
            }
        });
    }
}