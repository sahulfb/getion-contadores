<?php

function consultar() {
    $table = 'egresos';
    $primaryKey = 'idEgreso';
    $where = "idStatus = '1'";
    if(isset($_GET['filter']['centro']) && $_GET['filter']['centro'] != "") {
        $idCentro = $_GET['filter']['centro'];
        if($where != "") $where .= " AND ";
        $where .= "idCentroCosto = \"{$idCentro}\"";
    }
    if(isset($_GET['filter']['rangoFecha']) && trim($_GET['filter']['rangoFecha'], ' ') != "") {
        $rangoFecha = explode(' ', trim($_GET['filter']['rangoFecha'], ' '));
        if(sizeof($rangoFecha) == 2) {
            $fechaDesde = $rangoFecha[0];
            $fechaHasta = $rangoFecha[1];

            if($where != "") $where .= " AND ";
            $where .= "fecha >= \"{$fechaDesde}\" AND fecha <= \"{$fechaHasta}\"";
        }
    }
    
    $columns = array(
        [ 'db' => 'idEgreso', 'dt' => 'idEgreso' ],
        [
            'db' => 'fecha',
            'dt' => 'fecha',
            'formatter' => function($data, $row) {
                return Formato::Fecha($data);
            }
        ],
        [ 'db' => 'detalle', 'dt' => 'detalle' ],
        [
            'db' => 'montoCLP',
            'dt' => 'montoCLP',
            'formatter' => function($data, $row) {
                $objMonedaCLP = new MonedaModel(1);
                return Formato::Precio($data, $objMonedaCLP->decimales, $objMonedaCLP->simbolo);
            }
        ],
        [
            'db' => 'idCentroCosto',
            'dt' => 'centroCosto',
            'formatter' => function($data, $row) {
                $objCentroCosto = new CentroCostoModel($data);
                return [
                    'id' => $objCentroCosto->id,
                    'nombre' => $objCentroCosto->nombre
                ];
            }
        ],
        [
            'db' => 'idUsuario',
            'dt' => 'idUsuario',
            'formatter' => function($data, $row) {
                $objUsuarioModel = new UsuarioModel($data);
                return [
                    'id' => $objUsuarioModel->id,
                    'nombre' => $objUsuarioModel->nombre
                ];
            }
        ],
        [ 'db' => 'observacion', 'dt' => 'observacion' ],
        [
            'db' => 'idStatus',
            'dt' => 'Status',
            'formatter' => function($data, $row) {
                $objStatus = new StatusEgresoModel($data);
                return [
                    'id' => $objStatus->id,
                    'nombre' => $objStatus->nombre
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

    $response = SSP::complex( $_GET, $sql_details, $table, $primaryKey, $columns, $where );
    if($where != "") Conexion::db()->where($where);
    $rowMontoTotal = Conexion::db()->getOne('egresos', 'SUM(montoCLP) as monto_total')['monto_total'];
    if($rowMontoTotal == NULL) $rowMontoTotal = 0;
    $objMonedaCLP = new MonedaModel(1);
    $response['monto_total'] = Formato::Precio($rowMontoTotal, $objMonedaCLP->decimales, $objMonedaCLP->simbolo);
    echo json_encode($response);
}

function registrar() {
    $fecha = Input::post('fecha', TRUE);
    $detalle = Input::post('detalle', TRUE);
    $montoCLP = Input::post('montoCLP', TRUE);
    $idCentroCosto = Input::post('idCentroCosto', TRUE);
    $observacion = Input::post('observacion', TRUE);

    $objCentroCosto = new CentroCostoModel($idCentroCosto);
    if(!validarFecha($fecha, 'Y-m-d')) throw new Exception('El formato de la fecha es invalido.');
    if($montoCLP < 0) throw new Exception('El monto no puede ser negativo.');

    Conexion::db()->startTransaction();
    $idEgreso = EgresosModel::Registrar($fecha, $detalle, $montoCLP, $objCentroCosto->id, $observacion);
    Conexion::db()->commit();

    sendJson(['ok' => TRUE, 'idEgreso' => $idEgreso]);
}

function modificar() {
    $idEgreso = Input::post('idEgreso', TRUE);
    $objEgreso = new EgresoModel($idEgreso);

    $fecha = Input::post('fecha', TRUE);
    $detalle = Input::post('detalle', TRUE);
    $montoCLP = Input::post('montoCLP', TRUE);
    $idCentroCosto = Input::post('idCentroCosto', TRUE);
    $observacion = Input::post('observacion', TRUE);

    if($objEgreso->idStatus == '2') throw new Exception('Egreso anulado');
    $objCentroCosto = new CentroCostoModel($idCentroCosto);
    if(!validarFecha($fecha, 'Y-m-d')) throw new Exception('El formato de la fecha es invalido.');
    if($montoCLP < 0) throw new Exception('El monto no puede ser negativo.');

    $data = [];
    if($fecha != $objEgreso->fecha) {
        $data['fecha'] = $fecha;
    }
    if($detalle != $objEgreso->detalle) {
        $data['detalle'] = $detalle;
    }
    if($montoCLP != $objEgreso->montoCLP) {
        $data['montoCLP'] = $montoCLP;
    }
    if($idCentroCosto != $objEgreso->idCentroCosto) {
        $data['idCentroCosto'] = $idCentroCosto;
    }
    if($observacion != $objEgreso->observacion) {
        $data['observacion'] = $observacion;
    }
    
    if(sizeof($data) > 0) {
        Conexion::db()->startTransaction();
        $idEgreso = $objEgreso->Modificar($data);
        Conexion::db()->commit();
    }

    sendJson(['ok' => TRUE, 'idEgreso' => $idEgreso]);
}

function anular() {
    $idEgreso = Input::post('idEgreso', TRUE);
    $objEgreso = new EgresoModel($idEgreso);
    if($objEgreso->idStatus == '2') throw new Exception('Egreso anulado');
    
    Conexion::db()->startTransaction();
    $idEgreso = $objEgreso->Modificar(['idStatus' => '2']);
    Conexion::db()->commit();
    
    sendJson(['ok' => TRUE, 'idEgreso' => $idEgreso]);
}