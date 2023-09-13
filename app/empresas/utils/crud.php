<?php

function consultar() {
    $table = 'empresas';
    $primaryKey = 'idEmpresa';
    $where = "isDeleted = '0'";
    
    $columns = array(
        [ 'db' => 'idEmpresa', 'dt' => 'idEmpresa' ],
        [ 'db' => 'rut', 'dt' => 'rut' ],
        [ 'db' => 'razon_social', 'dt' => 'razon_social' ],
        [ 'db' => 'correo', 'dt' => 'correo' ],
        [
            'db' => 'idPlan',
            'dt' => 'plan',
            'formatter' => function($d, $row) {
                try {
                    $objPlan = new PlanModel($d);
                    return [
                        'id' => $objPlan->id,
                        'codigo' => $objPlan->codigo,
                        'nombre' => $objPlan->nombre
                    ];
                } catch(Exception $e) {
                    return [
                        'id' => '-1',
                        'codigo' => '-1',
                        'nombre' => ''
                    ];
                }
            }
        ],
        [
            'db' => 'idPlan_sinMovimiento',
            'dt' => 'plan_sinMovimiento',
            'formatter' => function($d, $row) {
                try {
                    $objPlan = new PlanModel($d);
                    return [
                        'id' => $objPlan->id,
                        'codigo' => $objPlan->codigo,
                        'nombre' => $objPlan->nombre
                    ];
                } catch(Exception $e) {
                    return [
                        'id' => '-1',
                        'codigo' => '-1',
                        'nombre' => ''
                    ];
                }
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
    echo json_encode($response);
}

function registrar() {
    $rut = Input::post('rut', TRUE);
    $razon_social = Input::post('razon_social', TRUE);
    $correo = Input::post('correo', TRUE);
    $idPlan = Input::post('idPlan', FALSE);
    $idPlan_sinMovimiento = Input::post('idPlan_sinMovimiento', FALSE);

    if(EmpresasModel::ExisteRut($rut)) {
        throw new Exception("EL rut <b>{$rut}</b> ya esta registrado.");
    }

    $objPlan = new PlanModel($idPlan);
    $idPlan = $objPlan->id;
    
    if($idPlan_sinMovimiento == "") $idPlan_sinMovimiento = NULL;
    else {
        $objPlan_sinMovimiento = new PlanModel($idPlan_sinMovimiento);
        $idPlan_sinMovimiento = $objPlan_sinMovimiento->id;
    }

    Conexion::db()->startTransaction();
    // Registro
    $idEmpresa = EmpresasModel::Registrar( $rut, $razon_social, $correo, $idPlan, $idPlan_sinMovimiento );
    $objEmpresa = new EmpresaModel($idEmpresa);

    Conexion::db()->commit();

    sendJson([
        'idEmpresa' => $idEmpresa
    ]);
}

function modificar() {
    $idEmpresa = Input::post('idEmpresa');
    $objEmpresa = new EmpresaModel($idEmpresa);
    

    $rut = Input::post('rut', TRUE);
    $razon_social = Input::post('razon_social', TRUE);
    $correo = Input::post('correo', TRUE);
    $idPlan = Input::post('idPlan', TRUE);
    $idPlan_sinMovimiento = Input::post('idPlan_sinMovimiento', TRUE);

    $data = [];

    if($rut != $objEmpresa->rut) {
        if(EmpresasModel::ExisteRut($rut)) {
            throw new Exception("EL rut <b>{$rut}</b> ya esta registrado.");
        }
        $data['rut'] = $rut;
    }
    if($razon_social != $objEmpresa->razon_social) {
        $data['razon_social'] = $razon_social;
    }
    if($correo != $objEmpresa->correo) {
        $data['correo'] = $correo;
    }

    if($idPlan == "") throw new Exception('Debe seleccionar un plan con movimiento como minimo.');
    $objPlan = new PlanModel($idPlan);
    $data['idPlan'] = $objPlan->id;

    if($idPlan_sinMovimiento == "" && $objEmpresa->idPlan_sinMovimiento != NULL)
    {
        $data['idPlan_sinMovimiento'] = NULL;
    }
    elseif($idPlan_sinMovimiento != $objEmpresa->idPlan_sinMovimiento)
    {
        $objPlan = new PlanModel($idPlan_sinMovimiento);
        $data['idPlan_sinMovimiento'] = $objPlan->id;
    }
    

    if(sizeof($data) > 0) {
        Conexion::db()->startTransaction();
        $objEmpresa->Modificar($data);
        Conexion::db()->commit();
    }

    sendJson([
        'idEmpresa' => $objEmpresa->id
    ]);
}