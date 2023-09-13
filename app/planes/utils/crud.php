<?php

function consultar() {
    $table = 'planes';
    $primaryKey = 'idPlan';
    
    $columns = array(
        [ 'db' => 'idPlan', 'dt' => 'idPlan' ],
        [ 'db' => 'codigo', 'dt' => 'codigo' ],
        [ 'db' => 'nombre', 'dt' => 'nombre' ],
        [
            'db' => 'idFrecuenciaCobro',
            'dt' => 'periodo',
            'formatter' => function($d, $row) {
                $objFrecuencia = new FrecuenciaCobroModel($d);
                return [
                    "id" => $objFrecuencia->id,
                    "nombre" => $objFrecuencia->nombre
                ];
            }
        ],
        [
            'db' => 'monto',
            'dt' => 'monto'
        ],
        [ 'db' => 'detalle', 'dt' => 'detalle' ],
        [
            'db' => 'idMoneda',
            'dt' => 'moneda',
            'formatter' => function($d, $row) {
                $objMoneda = new MonedaModel($d);
                return [
                    "id" => $objMoneda->id,
                    "nombre" => $objMoneda->nombre,
                    "simbolo" => $objMoneda->simbolo,
                    "decimales" => $objMoneda->decimales
                ];
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

    $response = SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns );
    for($i=0; $i<sizeof($response['data']); $i++) {
        $response['data'][$i]['monto'] = Formato::Numero($response['data'][$i]['monto'], $response['data'][$i]['moneda']['decimales']);
    }
    echo json_encode($response);
}

function registrar() {
    $codigo = Input::post('codigo', TRUE);
    $nombre = Input::post('nombre', TRUE);
    $idPeriodo = Input::post('idPeriodo', TRUE);
    $monto = Input::post('monto', TRUE);
    $detalle = Input::post('detalle', TRUE);
    $idMoneda = Input::post('idMoneda', TRUE);

    $objPeriodo = new FrecuenciaCobroModel($idPeriodo);
    $objMoneda = new MonedaModel($idMoneda);

    if(PlanesModel::ExisteCodigo($codigo)) {
        throw new Exception("El codigo <b>{$codigo}</b> ya esta registrado.");
    }

    if($monto < 0) {
        throw new Exception("El monto no puede ser negativo.");
    }

    Conexion::db()->startTransaction();
    $idPlan = PlanesModel::Registrar($codigo, $nombre, $objPeriodo->id, $monto, $detalle, $objMoneda->id);
    Conexion::db()->commit();

    sendJson([
        'idPlan' => $idPlan
    ]);
}

function modificar() {
    $idPlan = Input::post('idPlan', TRUE);
    $objPlan = new PlanModel($idPlan);

    $codigo = Input::post('codigo', TRUE);
    $nombre = Input::post('nombre', TRUE);
    $idFrecuenciaCobro = Input::post('idFrecuenciaCobro', TRUE);
    $monto = Input::post('monto', TRUE);
    $detalle = Input::post('detalle', TRUE);
    $idMoneda = Input::post('idMoneda', TRUE);

    $objPeriodo = new FrecuenciaCobroModel($idFrecuenciaCobro);
    $objMoneda = new MonedaModel($idMoneda);

    $data = [];

    if($codigo != $objPlan->codigo) {
        if(PlanesModel::ExisteCodigo($codigo)) {
            throw new Exception("El codigo <b>{$codigo}</b> ya esta registrado.");
        }
        $data['codigo'] = $codigo;
    }
    if($nombre != $objPlan->nombre) {        
        $data['nombre'] = $nombre;
    }
    if($objPeriodo->id != $objPlan->idFrecuenciaCobro) {        
        $data['idFrecuenciaCobro'] = $objPeriodo->id;
    }
    if($monto != $objPlan->monto) {  
        if($monto < 0) {
            throw new Exception("El monto no puede ser negativo.");
        }      
        $data['monto'] = $monto;
    }
    if($detalle != $objPlan->detalle) {        
        $data['detalle'] = $detalle;
    }
    if($objMoneda->id != $objPlan->idMoneda) {        
        $data['idMoneda'] = $objMoneda->id;
    }

    if(sizeof($data) > 0) {
        Conexion::db()->startTransaction();
        $objPlan->Modificar($data);
        Conexion::db()->commit();
    }

    sendJson([
        'idPlan' => $objPlan->id
    ]);
}

function eliminar() {
    $idPlan = Input::post('idPlan', TRUE);
    $objPlan = new PlanModel($idPlan);

    Conexion::db()->startTransaction();
    $objPlan->Eliminar();
    Conexion::db()->commit();

    sendJson([
        'idPlan' => $objPlan->id
    ]);
}