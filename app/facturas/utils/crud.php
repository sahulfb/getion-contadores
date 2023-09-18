<?php

function consultar() {
    $table = 'facturas';
    $primaryKey = 'idFactura';
    $where = "";
    if(isset($_GET['filter']['empresa']) && $_GET['filter']['empresa'] != "") {
        $idEmpresa = $_GET['filter']['empresa'];
        $where .= "idEmpresa = \"{$idEmpresa}\"";
    }
    if(isset($_GET['filter']['status']) && $_GET['filter']['status'] != "") {
        $idsStatus = explode('-', $_GET['filter']['status']);
        $inStatus = "";
        foreach($idsStatus as $idStatus) {
            if($inStatus != "") $inStatus .= ",";
            $inStatus .= "\"{$idStatus}\"";
        }
        if($where != "") $where .= " AND ";
        $where .= "idStatus IN ($inStatus)";
    }
    if(isset($_GET['filter']['rangoFecha']) && trim($_GET['filter']['rangoFecha'], ' ') != "") {
        $rangoFecha = explode(' ', trim($_GET['filter']['rangoFecha'], ' '));
        if(sizeof($rangoFecha) == 2) {
            $fechaDesde = $rangoFecha[0];
            $fechaHasta = $rangoFecha[1];

            if($where != "") $where .= " AND ";
            $where .= "fechaPago >= \"{$fechaDesde}\" AND fechaPago <= \"{$fechaHasta}\"";
        }
    }
    
    $columns = array(
        [ 'db' => 'idFactura', 'dt' => 'idFactura' ],
        [
            'db' => 'idPeriodoContable',
            'dt' => 'PeriodoContable',
            'formatter' => function($data, $row) {
                $obj = new PeriodoContableModel($data);
                return [
                    'id' => $obj->id,
                    'nombre' => $obj->nombre
                ];
            }
        ],
        [
            'db' => 'idEmpresa',
            'dt' => 'Empresa',
            'formatter' => function($data, $row) {
                $obj = new EmpresaModel($data);
                return [
                    'id' => $obj->id,
                    'razon_social' => $obj->razon_social
                ];
            }
        ],
        [ 'db' => 'servicio', 'dt' => 'servicio' ],
        [ 'db' => 'numeroFactura', 'dt' => 'numeroFactura' ],
        [
            'db' => 'valorCobrar',
            'dt' => 'valorCobrar',
            'formatter' => function($data, $row) {
                $objMonedaCLP = new MonedaModel(1);
                return Formato::Precio($data, $objMonedaCLP->decimales, $objMonedaCLP->simbolo);
            }
        ],
        [ 'db' => 'con_movimiento', 'dt' => 'con_movimiento' ],
        [
            'db' => 'fechaCobro',
            'dt' => 'fechaCobro',
            'formatter' => function($data, $row) {
                return Formato::Fecha($data);
            }
        ],
        [
            'db' => 'fechaVencimiento',
            'dt' => 'fechaVencimiento',
            'formatter' => function($data, $row) {
                return Formato::Fecha($data);
            }
        ],
        [
            'db' => 'idStatus',
            'dt' => 'Status',
            'formatter' => function($data, $row) {
                $obj = new StatusFacturaModel($data);
                return [
                    'id' => $obj->id,
                    'nombre' => $obj->nombre
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
    $rowMontoTotal = Conexion::db()->getOne('facturas', 'SUM(valorCobrar) as monto_total')['monto_total'];
    if($rowMontoTotal == NULL) $rowMontoTotal = 0;
    $objMonedaCLP = new MonedaModel(1);
    $response['monto_total'] = Formato::Precio($rowMontoTotal, $objMonedaCLP->decimales, $objMonedaCLP->simbolo);
    echo json_encode($response);
}

function registrar() {
    $idEmpresa = Input::post('idEmpresa', TRUE);
    $objEmpresa = new EmpresaModel($idEmpresa);

    $con_movimiento = boolval( Input::post('tipo_plan', TRUE) );

    $objMonedaCLP = new MonedaModel(1);

    $idServicio = Input::post('servicio', TRUE);
    $objServicio = new ServicioModel( $idServicio );

    $valorCobrar = Input::post('valorCobrar', TRUE);
    $numeroFactura = Input::post('numeroFactura', TRUE);
    $fechaCobro = Input::post('fechaCobro', TRUE);
    $fechaVencimiento = Input::post('fechaVencimiento', TRUE);

    $idPeriodoContable = Input::post('periodoCobro', TRUE);
    $objPeriodoContable = new PeriodoContableModel($idPeriodoContable);

    $observacion = Input::post('observacion', TRUE);
    $idCentroCosto = Input::post('centroCosto', TRUE);
    $objCentroCosto = new CentroCostoModel($idCentroCosto);

    if($valorCobrar < 0) throw new Exception('El valor a cobrar no puede ser negativo.');
    if($numeroFactura == "") throw new Exception("Debe colocar le numero de factura.");
    if(!validarFecha($fechaVencimiento, 'Y-m-d')) throw new Exception("Formato de la fecha de vencimiento invalida.");

    $idPlan = NULL;
    $valorPlan = NULL;
    if($objEmpresa->idPlan_sinMovimiento != NULL && !$con_movimiento) {
        $objPlan = new PlanModel($objEmpresa->idPlan_sinMovimiento);
        $objMoneda = new MonedaModel($objPlan->idMoneda);
        $idPlan = $objPlan->id;
        $valorPlan = bcdiv($objPlan->monto * $objMoneda->precioCLP, '1', $objMonedaCLP->decimales);
    }
    else {
        $objPlan = new PlanModel($objEmpresa->idPlan);
        $objMoneda = new MonedaModel($objPlan->idMoneda);
        $idPlan = $objPlan->id;
        $valorPlan = bcdiv($objPlan->monto * $objMoneda->precioCLP, '1', $objMonedaCLP->decimales);
    }
    
    $idEmpresa = $objEmpresa->id;
    $idPeriodoContable = $objPeriodoContable->id;
    $valorCobrar = $valorCobrar;
    $con_movimiento = (int) $con_movimiento;
    $idServicio = $objServicio->id;
    $servicio = $objServicio->nombre;
    $numeroFactura = $numeroFactura;
    $fechaCobro = $fechaCobro;
    $fechaVencimiento = $fechaVencimiento;
    $observacion = $observacion;
    $idCentroCosto = $objCentroCosto->id;
    
    // Cobros adicionales
    $cobros_adicionales = [];
    $cobros = CobrosAdicionalModel::Buscar(['empresa_id' => $idEmpresa]);
    foreach($cobros as $key => $cobro) {
        $periodos = CobrosAdicionalModel::Periodos($cobro['id']);
        if(!boolval($cobro['es_fijo']) && !in_array($idPeriodoContable, $periodos)) continue;

        array_push($cobros_adicionales, [
            'id' => $cobro['id'],
            'descripcion' => $cobro['descripcion'],
            'monto' => $cobro['monto'],
        ]);
    }
    $cobros_adicionales = json_encode( $cobros_adicionales );
    
    $idFactura = FacturasModel::registrar(
        $idEmpresa,
        $idPlan,
        $idPeriodoContable,
        $valorPlan,
        $cobros_adicionales,
        $valorCobrar,
        $con_movimiento,
        $idServicio,
        $servicio,
        $numeroFactura,
        $fechaCobro,
        $fechaVencimiento,
        $observacion,
        $idCentroCosto
    );

    sendJson([
        'Ok' => TRUE,
        'idFactura' => $idFactura
    ]);
}

function modificar() {
    $idFactura = Input::post('idFactura', TRUE);
    $objFactura = new FacturaModel($idFactura);

    if(!($objFactura->idStatus == 1 OR $objFactura->idStatus == 2)) {
        throw new Exception('Las facturas solo pueden modificarse cuando estan en status "PENDIENTE" o "VENCIDO".');
    }

    $idServicio = Input::post('servicio', TRUE);
    $objServicio = new ServicioModel( $idServicio );
    
    $valorCobrar = Input::post('valorCobrar', TRUE);
    $numeroFactura = Input::post('numeroFactura', TRUE);
    $fechaCobro = Input::post('fechaCobro', TRUE);
    $fechaVencimiento = Input::post('fechaVencimiento', TRUE);
    $observacion = Input::post('observacion', TRUE);
    $idCentroCosto = Input::post('centroCosto', TRUE);
    $objCentroCosto = new CentroCostoModel($idCentroCosto);

    if($valorCobrar < 0) {
        throw new Exception('El valor a cobrar no puede ser negativo.');
    }
    if($numeroFactura == "") {
        throw new Exception('El numero de factura no puede estar vacio.');
    }
    if($fechaCobro == "") {
        throw new Exception('La fecha de cobro no puede estar vacia.');
    }
    if($fechaVencimiento == "") {
        throw new Exception('La fecha de vencimiento no puede estar vacia.');
    }

    $data = [];
    $data['idServicio'] = $objServicio->id;
    $data['servicio'] = $objServicio->nombre;
    if($valorCobrar != $objFactura->valorCobrar) {
        $data['valorCobrar'] = $valorCobrar;
    }
    if($numeroFactura != $objFactura->numeroFactura) {
        $data['numeroFactura'] = $numeroFactura;
    }
    if($fechaCobro != $objFactura->fechaCobro) {
        $data['fechaCobro'] = $fechaCobro;
    }
    if($fechaVencimiento != $objFactura->fechaVencimiento) {
        $data['fechaVencimiento'] = $fechaVencimiento;
    }
    if($observacion != $objFactura->observacion) {
        $data['observacion'] = $observacion;
    }
    if($objCentroCosto->id != $objFactura->idCentroCosto) {
        $data['idCentroCosto'] = $objCentroCosto->id;
    }

    if(sizeof($data) > 0) {
        Conexion::db()->startTransaction();
        $objFactura->Modificar($data);
        Conexion::Db()->commit();
    }

    sendJson([
        'idFactura' => $objFactura->id,
        'ok' => TRUE
    ]);
}

function anular() {
    $idFactura = Input::post('idFactura', TRUE);
    $objFactura = new FacturaModel($idFactura);
    $observacion = Input::post('observacion', TRUE);

    if($observacion == "") {
        throw new Exception("El campo de 'observación es obligatorio.");
    }
    if(!($objFactura->idStatus == 1 OR $objFactura->idStatus == 2)) {
        throw new Exception('Las facturas solo pueden anularse cuando estan en status "PENDIENTE" o "VENCIDO".');
    }

    Conexion::db()->startTransaction();
    $objFactura->Anular($observacion);
    Conexion::Db()->commit();

    sendJson([
        'idFactura' => $objFactura->id,
        'ok' => TRUE
    ]);
}

function dicom() {
    $idFactura = Input::post('idFactura', TRUE);
    $objFactura = new FacturaModel($idFactura);
    $observacion = Input::post('observacion', TRUE);

    if($observacion == "") {
        throw new Exception("El campo de 'observación es obligatorio.");
    }
    if(!($objFactura->idStatus == 1 OR $objFactura->idStatus == 2)) {
        throw new Exception('Las facturas solo pueden cambiar a dicom cuando estan en status "PENDIENTE" o "VENCIDO".');
    }

    Conexion::db()->startTransaction();
    $objFactura->Dicom($observacion);
    Conexion::Db()->commit();

    sendJson([
        'idFactura' => $objFactura->id,
        'ok' => TRUE
    ]);
}


function pagar() {
    $idFactura = Input::post('idFactura', TRUE);
    $objFactura = new FacturaModel($idFactura);

    $idMetodoPago = Input::post('idMetodoPago', TRUE);
    $objMetodoPago = new MetodoPagoModel($idMetodoPago);
    $fechaPago= Input::post('fechaPago', TRUE);

    if(!($objFactura->idStatus == 1 OR $objFactura->idStatus == 2)) {
        throw new Exception('Las facturas solo pueden pagarse cuando estan en status "PENDIENTE" o "VENCIDO".');
    }
    
    Conexion::db()->startTransaction();
    $objFactura->Pagar($objMetodoPago->id, $fechaPago);
    Conexion::Db()->commit();

    sendJson([
        'idFactura' => $objFactura->id,
        'ok' => TRUE
    ]);
}

function empresas() {
    $table = 'empresas';
    $primaryKey = 'idEmpresa';
    $where = "";

    $filtros = $_GET['filtros'];
    if( isset($filtros['incluir']) && $filtros['incluir'] != "" )
    {
        $id = $filtros['incluir'];
        Conexion::db()->where('idPeriodoContable', $id);
        $rows = Conexion::db()->get('facturas', NULL, 'DISTINCT(idEmpresa)');
        $ids = "";
        foreach($rows as $row) {
            if($ids != "") $ids .= ",";
            $ids .= $row['idEmpresa'];
        }

        if($ids == "") $ids = 0;
        if($where != "") $where .= " AND ";
        $where .= "idEmpresa IN ({$ids})";
    }
    if( isset($filtros['excluir']) && $filtros['excluir'] != "" )
    {
        $id = $filtros['excluir'];
        Conexion::db()->where('idPeriodoContable', $id);
        $rows = Conexion::db()->get('facturas', NULL, 'DISTINCT(idEmpresa)');
        $ids = "";
        foreach($rows as $row) {
            if($ids != "") $ids .= ",";
            $ids .= $row['idEmpresa'];
        }

        if($ids != "") {
            if($where != "") $where .= " AND ";
            $where .= "idEmpresa NOT IN ({$ids})";
        }
    }

    $columns = array(
        [ 'db' => 'idEmpresa', 'dt' => 'id' ],
        [ 'db' => 'rut', 'dt' => 'rut' ],
        [ 'db' => 'razon_social', 'dt' => 'razon_social' ],
        [ 'db' => 'correo', 'dt' => 'correo' ],
        [
            'db' => 'idPlan', 'dt' => 'plan',
            'formatter' => function($d, $row) {
                try {
                    $objPlan = new PlanModel($d);
                    return [
                        'id' => $objPlan->id,
                        'codigo' => $objPlan->codigo,
                        'nombre' => $objPlan->nombre,
                    ];
                } catch(Exception $e) {
                    return NULL;
                }
            }
        ],
    );

    // SQL server connection information
    $sql_details = ARRAY_BASE_DATOS;

    $response = SSP::complex( $_GET, $sql_details, $table, $primaryKey, $columns, $where );
    echo json_encode($response);
}