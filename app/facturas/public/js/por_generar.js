$("#filtro-incluir-periodo").select2();
$("#filtro-excluir-periodo").select2();

/**
 * Variables
 */
 let idTabla = "tabla";
 
 /**
  * Tabla
  */
 let tabla = $('#'+idTabla).DataTable( {
     "processing": true,
     "serverSide": true,
     "aLengthMenu": [
         [10, 25, 50, 100, -1],
         [10, 25, 50, 100, "Todo"]
     ],
     "ajax": {
         url: `${BASE_URL}/Facturas/CRUD/Empresas/`,
         data: function(d) {
             d.filtros = {
                 incluir:  $("#filtro-incluir-periodo").val(),
                 excluir:  $("#filtro-excluir-periodo").val(),
             };
         }
     },
     "columns": [
         {
             "data": "id",
             "className": 'text-center vertical-middle'
 
         },
         {
             "data": "rut",
             "className": 'vertical-middle text-center',
             'render': function(data, type, row) {
                 return `<a href="${BASE_URL}/Facturas/Ver_Empresa/${row.id}/">
                     <div>
                         ${data}
                     </div>
                 </a>`;
             }
         },
         {
             "data": "razon_social",
             "className": 'vertical-middle',
             'render': function(data, type, row) {
                 return data;
             }
         }
     ]
 } );
 
 function RefrescarTabla() {
     tabla.ajax.reload(null, false);
 }

$("#filtro-incluir-periodo").on('change', () => {
    RefrescarTabla();
});
$("#filtro-excluir-periodo").on('change', () => {
    RefrescarTabla();
});