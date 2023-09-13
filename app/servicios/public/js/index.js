/**
 * Variables
 */
 let idTabla = "tabla";

let nuevo = {
    modal: $("#modal-nuevo"),
    form: document.getElementById('form-nuevo')
};
 
 let editar = {
     modal: $("#modal-editar"),
     form: document.getElementById('form-editar'),
     inputId: document.getElementById('editar-input-id'),
     inputNombre: document.getElementById('editar-input-nombre'),
     inputObservacion: document.getElementById('editar-input-observacion')
 };
 
 let eliminar = {
     modal: $('#modal-eliminar'),
     form: document.getElementById('form-eliminar'),
     inputId: document.getElementById('eliminar-input-id'),
     labelNombre: document.getElementById('eliminar-label-nombre'),
 };
 
 /**
  * Tabla
  */
 let tabla = $('#'+idTabla).DataTable( {
     "processing": true,
     "serverSide": true,
     "ajax": `${BASE_URL}/Servicios/CRUD/Consultar/`,
     "columns": [
         {
             "data": "id",
             "className": 'text-center vertical-middle'
 
         },
         {
             "data": "nombre",
             "className": 'vertical-middle'
         },
         {
             "data": "observacion",
             "className": 'vertical-middle'
         },
         {
             'orderable': false,
             'className': 'text-center text-truncate vertical-middle',
             "defaultContent": `<div>
                 <button class="btn btn-sm btn-success editar">
                     <i class="fas fa-edit"></i>
                 </button>
                 <button class="btn btn-sm btn-danger eliminar">
                     <i class="fas fa-trash-alt"></i>
                 </button>
             </div>`
         }
     ]
 } );
 
 function RefrescarTabla() {
     tabla.ajax.reload(null, false);
 }
 
/**
 * 
 * Proceso para registrar rol
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
     let url = `${BASE_URL}/Servicios/CRUD/Registrar/`;
     let data = new FormData(nuevo.form);
 
     AJAX.enviar({
         url: url,
         data: data,
         antes: function() {
             Loader.show();
         },
         error: function(mensaje) {
             Loader.hide();
             Alerta.danger('Registrar servicio', mensaje);
         },
         ok: function(data) {
             nuevo.form.reset();
             RefrescarTabla();
             Loader.hide();
             nuevo.modal.modal('hide');
         }
     });
 }
 
 /**
  * 
  * Proceso para modificar rol
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
     editar.inputId.value = data.id;
     editar.inputNombre.value = data.nombre;
     editar.inputObservacion.value = data.observacion;
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
     let url = `${BASE_URL}/Servicios/CRUD/Modificar/`;
     let data = new FormData(editar.form);
 
     AJAX.enviar({
         url: url,
         data: data,
         antes: function() {
             Loader.show();
         },
         error: function(mensaje) {
             Loader.hide();
             Alerta.danger('Modificar servicio', mensaje);
         },
         ok: function(data) {
             RefrescarTabla();
             Loader.hide();
             editar.modal.modal('hide');
         }
     });
 }
 
 /**
  * 
  * Proceso para eliminar rol
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
     eliminar.inputId.value = data.id;
     eliminar.labelNombre.innerHTML = data.nombre;
 
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
     let url = `${BASE_URL}/Servicios/CRUD/Eliminar/`;
     let data = new FormData(eliminar.form);
 
     AJAX.enviar({
         url: url,
         data: data,
         antes: function() {
             Loader.show();
         },
         error: function(mensaje) {
             Loader.hide();
             Alerta.danger('Eliminar servicio', mensaje);
         },
         ok: function(data) {
             RefrescarTabla();
             Loader.hide();
             eliminar.modal.modal('hide');
         }
     });
 }