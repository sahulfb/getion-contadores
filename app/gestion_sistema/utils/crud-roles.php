<?php

/**
 * Consultar
 */
function consultar() {
    $table = 'roles';
    $primaryKey = 'idRol';
    
    $columns = array(
        [ 'db' => 'idRol', 'dt' => 'idRol' ],
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

    $response = SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns );
    echo json_encode($response);
}

/**
 * Registrar
 */
function registrar() {
    $nombre = Input::post('nombre', TRUE);
    $descripcion = Input::post('descripcion', TRUE);

    if(RolesModel::ExisteNombre($nombre)) {
        throw new Exception("El rol <b>{$nombre}</b> ya esta registrado.");
    }

    Conexion::db()->startTransaction();
    $idRol = RolesModel::Registrar($nombre, $descripcion);
    Conexion::db()->commit();

    sendJson([
        'idRol' => $idRol
    ]);
}

/**
 * Modificar
 */
function modificar() {
    $idRol = Input::post('idRol', TRUE);
    $objRol = new RolModel($idRol);

    $nombre = Input::post('nombre', TRUE);
    $descripcion = Input::post('descripcion', TRUE);

    $data = [];
    if($nombre != $objRol->nombre) {
        if(RolesModel::ExisteNombre($nombre)) {
            throw new Exception("El rol <b>{$nombre}</b> ya esta registrado.");
        }

        $data['nombre'] = $nombre;
    }
    if($descripcion != $objRol->descripcion) {
        $data['descripcion'] = $descripcion;
    }

    if(sizeof($data) > 0) {
        Conexion::db()->startTransaction();
        $objRol->Modificar($data);
        Conexion::db()->commit();
    }

    sendJson([
        'idRol' => $objRol->id
    ]);
}

/**
 * Eliminar
 */
function eliminar() {
    $idRol = Input::post('idRol', TRUE);
    $idRolSustituto = Input::post('idRolSustituto', TRUE);
    
    $objRol = new RolModel($idRol);
    $objRolSustituto = new RolModel($idRolSustituto);

    if($objRol->id == $objRolSustituto->id) {
        throw new Exception('Debe seleccionar un rol sustituto distinto al que se eliminara.');
    }

    if($objRol->id == Sesion::Usuario()->idRol) {
        throw new Exception('No puede eliminar el rol del usuario actual.');
    }

    Conexion::db()->startTransaction();
    $objRol->Eliminar($objRolSustituto->id);
    Conexion::db()->commit();

    sendJson([
        'idRol' => $objRol->id
    ]);
}