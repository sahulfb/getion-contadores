<?php

function consultar() {
    $table = 'metodos_pago';
    $primaryKey = 'idMetodoPago';
    $where = "isDeleted = '0'";
    
    $columns = array(
        [ 'db' => 'idMetodoPago', 'dt' => 'idMetodoPago' ],
        [ 'db' => 'nombre', 'dt' => 'nombre' ],
        [ 'db' => 'descripcion', 'dt' => 'descripcion' ],
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
    $descripcion = Input::post('descripcion', TRUE);

    if(MetodosPagoModel::ExisteNombre($nombre)) {
        throw new Exception("El metodo de pago <b>{$nombre}</b> ya esta registrado.");
    }

    Conexion::db()->startTransaction();
    $idMetodoPago = MetodosPagoModel::Registrar($nombre, $descripcion);
    Conexion::db()->commit();

    sendJson([
        'idMetodoPago' => $idMetodoPago
    ]);
}

function modificar() {
    $idMetodoPago = Input::post('idMetodoPago', TRUE);
    $objMetodo = new MetodoPagoModel($idMetodoPago);

    $nombre = Input::post('nombre', TRUE);
    $descripcion = Input::post('descripcion', TRUE);

    $data = [];
    if($nombre != $objMetodo->nombre) {
        if(MetodosPagoModel::ExisteNombre($nombre)) {
            throw new Exception("El metodo de pago <b>{$nombre}</b> ya esta registrado.");
        }

        $data['nombre'] = $nombre;
    }
    if($descripcion != $objMetodo->descripcion) {
        $data['descripcion'] = $descripcion;
    }

    if(sizeof($data) > 0) {
        Conexion::db()->startTransaction();
        $objMetodo->Modificar($data);
        Conexion::db()->commit();
    }

    sendJson([
        'idMetodoPago' => $objMetodo->id
    ]);
}

function eliminar() {
    $idMetodoPago = Input::post('idMetodoPago', TRUE);
    $objmetodo = new MetodoPagoModel($idMetodoPago);

    Conexion::db()->startTransaction();
    $objmetodo->Eliminar();
    Conexion::db()->commit();

    sendJson([
        'idMetodoPago' => $objmetodo->id
    ]);
}