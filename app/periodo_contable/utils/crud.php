<?php

function consultar() {
    $table = 'periodos_contables';
    $primaryKey = 'idPeriodoContable';
    $where = "isDeleted = '0'";
    
    $columns = array(
        [ 'db' => 'idPeriodoContable', 'dt' => 'idPeriodo' ],
        [ 'db' => 'nombre', 'dt' => 'nombre' ],
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

    $response = SSP::complex( $_GET, $sql_details, $table, $primaryKey, $columns, $where );
    echo json_encode($response);
}

function registrar() {
    $nombre = Input::post('nombre', TRUE);

    if(PeriodosContablesModel::ExisteNombre($nombre)) {
        throw new Exception("El periodo contable <b>{$nombre}</b> ya esta registrado.");
    }

    Conexion::db()->startTransaction();
    $idPeriodo = PeriodosContablesModel::Registrar($nombre);
    Conexion::db()->commit();

    sendJson([
        'idPeriodo' => $idPeriodo
    ]);
}

function modificar() {
    $idPeriodo = Input::post('idPeriodo', TRUE);
    $objPeriodo = new PeriodoContableModel($idPeriodo);

    $nombre = Input::post('nombre', TRUE);

    $data = [];
    if($nombre != $objPeriodo->nombre) {
        if(PeriodosContablesModel::ExisteNombre($nombre)) {
            throw new Exception("El periodo contable <b>{$nombre}</b> ya esta registrado.");
        }

        $data['nombre'] = $nombre;
    }

    if(sizeof($data) > 0) {
        Conexion::db()->startTransaction();
        $objPeriodo->Modificar($data);
        Conexion::db()->commit();
    }

    sendJson([
        'idPeriodo' => $objPeriodo->id
    ]);
}

function eliminar() {
    $idPeriodo = Input::post('idPeriodo', TRUE);
    $objPeriodo = new PeriodoContableModel($idPeriodo);

    Conexion::db()->startTransaction();
    $objPeriodo->Eliminar();
    Conexion::db()->commit();

    sendJson([
        'idPeriodo' => $objPeriodo->id
    ]);
}