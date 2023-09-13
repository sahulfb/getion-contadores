<?php

function consultar() {
    $table = 'centros_costo';
    $primaryKey = 'idCentroCosto';
    $where = "isDeleted = '0'";
    
    $columns = array(
        [ 'db' => 'idCentroCosto', 'dt' => 'idCentroCosto' ],
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

    if(CentrosCostoModel::ExisteNombre($nombre)) {
        throw new Exception("El centro de costo <b>{$nombre}</b> ya esta registrado.");
    }

    Conexion::db()->startTransaction();
    $idCentroCosto = CentrosCostoModel::Registrar($nombre);
    Conexion::db()->commit();

    sendJson([
        'idCentroCosto' => $idCentroCosto
    ]);
}

function modificar() {
    $idCentroCosto = Input::post('idCentroCosto', TRUE);
    $objCentro = new CentroCostoModel($idCentroCosto);

    $nombre = Input::post('nombre', TRUE);

    $data = [];
    if($nombre != $objCentro->nombre) {
        if(CentrosCostoModel::ExisteNombre($nombre)) {
            throw new Exception("El centro de costo <b>{$nombre}</b> ya esta registrado.");
        }

        $data['nombre'] = $nombre;
    }

    if(sizeof($data) > 0) {
        Conexion::db()->startTransaction();
        $objCentro->Modificar($data);
        Conexion::db()->commit();
    }

    sendJson([
        'idCentroCosto' => $objCentro->id
    ]);
}

function eliminar() {
    $idCentroCosto = Input::post('idCentroCosto', TRUE);
    $objCentro = new CentroCostoModel($idCentroCosto);

    if($objCentro->id == 1) throw new Exception('El centro de costo id:1 no se puede eliminar.');

    Conexion::db()->startTransaction();
    $objCentro->Eliminar();
    Conexion::db()->commit();

    sendJson([
        'idCentroCosto' => $objCentro->id
    ]);
}