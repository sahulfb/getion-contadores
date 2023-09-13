<?php

function consultar() {
    $table = 'frecuencia_cobro';
    $primaryKey = 'idFrecuenciaCobro';
    
    $columns = array(
        [ 'db' => 'idFrecuenciaCobro', 'dt' => 'idFrecuenciaCobro' ],
        [ 'db' => 'nombre', 'dt' => 'nombre' ],
        [ 'db' => 'frecuencia', 'dt' => 'frecuencia' ],
        [
            'db'        => 'fecha_registro',
            'dt'        => 'fecha_registro'
        ],
        [
            'db'        => 'fecha_modificacion',
            'dt'        => 'fecha_modificacion'
        ]
    );
    
    // SQL server connection information
    $sql_details = ARRAY_BASE_DATOS;

    $response = SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns );
    echo json_encode($response);
}

function modificar() {
    $idFrecuenciaCobro = Input::post('idFrecuenciaCobro', TRUE);
    $objFrecuencia = new FrecuenciaCobroModel($idFrecuenciaCobro);

    $nombre = Input::post('nombre', TRUE);

    $data = [];
    if($nombre != $objFrecuencia->nombre) {
        $data['nombre'] = $nombre;
    }

    if(sizeof($data) > 0) {
        Conexion::db()->startTransaction();
        $objFrecuencia->Modificar($data);
        Conexion::db()->commit();
    }

    sendJson([
        'idFrecuenciaCobro' => $objFrecuencia->id
    ]);
}