<?php

/**
 * 
 */
function consultar() {
    $table = 'usuarios';
    $primaryKey = 'idUsuario';
    $where = "isDeleted = '0'";
    
    $columns = array(
        [ 'db' => 'idUsuario', 'dt' => 'idUsuario' ],
        [ 'db' => 'nombre', 'dt' => 'nombre' ],
        [ 'db' => 'correo', 'dt' => 'correo' ],
        [ 'db' => 'clave', 'dt' => 'clave' ],
        [ 'db' => 'idRol', 'dt' => 'idRol' ],
        [
            'db' => 'activo',
            'dt' => 'activo',
            'formatter' => function($d, $row) {
                return ($d == '0') ? FALSE : TRUE;
            }
        ],
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
    for($i=0; $i<sizeof($response['data']); $i++) {
        $idRol = $response['data'][$i]['idRol'];
        $objRol = new RolModel($idRol);
        $response['data'][$i]['idRol'] = [
            "id" => $objRol->id,
            "nombre" => $objRol->nombre
        ];
    }
    
    echo json_encode($response);
}

/**
 * 
 */
function registrar() {
    $nombre = Input::post('nombre', TRUE);
    $correo = Input::post('correo', TRUE);
    $clave = Input::post('clave', TRUE);
    $idRol = Input::post('idRol', TRUE);
    $activo = (Input::post('activo', FALSE) === FALSE) ? FALSE : TRUE;

    if(UsuariosModel::ExisteCorreo($correo)) {
        throw new Exception("El correo <b>{$correo}</b> ya esta registrado.");
    }

    Conexion::db()->startTransaction();
    $idUsuario = UsuariosModel::Registrar($nombre, $correo, $clave, $idRol, $activo);
    Conexion::db()->commit();

    sendJson([
        'idUsuario' => $idUsuario
    ]);
}

/**
 * 
 */
function modificar() {
    $idUsuario = Input::post('idUsuario', TRUE);
    $objUsuario = new UsuarioModel($idUsuario);

    $nombre = Input::post('nombre', TRUE);
    $correo = Input::post('correo', TRUE);
    $clave = Input::post('clave', TRUE);
    $idRol = Input::post('idRol', TRUE);
    $activo = (Input::post('activo', FALSE) === FALSE) ? FALSE : TRUE;

    $data = [];
    $data['nombre'] = $nombre;
    if($correo != $objUsuario->correo) {
        if(UsuariosModel::ExisteCorreo($correo, $objUsuario->id)) {
            throw new Exception("El correo <b>{$correo}</b> ya esta registrado.");
        }
        $data['correo'] = $correo;
    }
    if($clave != "" && $clave != $objUsuario->clave) {
        $data['clave'] = $clave;
    }
    if($idRol != $objUsuario->idRol) {
        $data['idRol'] = $idRol;
    }
    if($activo != $objUsuario->activo) {
        if($objUsuario->id == Sesion::Usuario()->id) {
            throw new Exception('No se puede desactivar el usuario actual.');
        }
        $data['activo'] = (int) $activo;
    }

    Conexion::db()->startTransaction();
    $objUsuario->Modificar($data);
    Conexion::db()->commit();

    sendJson(['ok' => TRUE]);
}

/**
 * 
 */
function eliminar() {
    $idUsuario = Input::post('idUsuario');

    Conexion::db()->startTransaction();
    $objUsuario = new UsuarioModel($idUsuario);

    if($objUsuario->id == Sesion::Usuario()->id) {
        throw new Exception('No puede eliminar el usuario actual');
    }

    $objUsuario->Eliminar();
    Conexion::db()->commit();

    sendJson([
        'idUsuario' => $objUsuario->id
    ]);
}

/**
 * 
 */
function activar() {
    $idUsuario = Input::post('idUsuario');

    Conexion::db()->startTransaction();
    $objUsuario = new UsuarioModel($idUsuario);

    if($objUsuario->id == Sesion::Usuario()->id) {
        throw new Exception('No puede desactivar el usuario actual');
    }

    $objUsuario->Activar( !$objUsuario->activo );
    Conexion::db()->commit();

    sendJson([
        'idUsuario' => $objUsuario->id
    ]);
}