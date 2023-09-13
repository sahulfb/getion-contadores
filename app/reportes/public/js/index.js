// monto-ventas_pendientes
// monto-ventas_vencidas
// monto-ventas_ano_curso
// monto-ventas
// monto-egresos
// monto-utilidades

$("#form-filtro").on('submit', (e) => {
    e.preventDefault();
});

$("#form-filtro").on('change', (e) => {
    actualizar_montos();
});

$(document).ready( () => {
    actualizar_montos();
} );

function actualizar_montos() {
    let url = `${BASE_URL}/reportes/api/consultar/`;
    let data = new FormData( $("#form-filtro")[0] );

    AJAX.enviar({
        url: url,
        data: data,
        antes: function() {
            Loader.show();
        },
        error: function(mensaje) {
            Loader.hide();
            Alerta.danger('Consultar datos', mensaje);
        },
        ok: function(data) {
            Loader.hide();
            console.log( data.totalItem1 );

            $("#monto-ventas_pendientes").html( data.totalItem1 );
            $("#monto-ventas_vencidas").html( data.totalItem2 );
            $("#monto-ventas_ano_curso").html( data.totalItem3 );
            $("#monto-ventas").html( data.ventas );
            $("#monto-egresos").html( data.egresos );
            $("#monto-utilidades").html( data.utlidades );
        }
    });
}