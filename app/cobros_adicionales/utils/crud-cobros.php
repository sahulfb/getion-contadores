<?php

switch($accion)
{
    /**
     * DataTable
     */
    case 'datatable':
        $table = 'cobros_adicionales';
        $primaryKey = 'id';
        
        $columns = array(
            [ 'db' => 'id', 'dt' => 'id' ],
            [
                'db' => 'empresa_id', 'dt' => 'empresa',
                'formatter' => function($d, $row) {
                    try {
                        $objEmpresa = new EmpresaModel($d);
                        return $objEmpresa;
                    } catch(Exception $e) {
                        return NULL;
                    }
                }
            ],
            [ 'db' => 'descripcion', 'dt' => 'descripcion' ],
            [
                'db' => 'monto', 'dt' => 'monto',
                'formatter' => function($d, $row) {
                    return floatval($d);
                }
            ],
            [
                'db' => 'es_fijo', 'dt' => 'es_fijo',
                'formatter' => function($d, $row) {
                    return boolval($d);
                }
            ],
            [
                'db' => 'id', 'dt' => 'periodos_id',
                'formatter' => function($d, $row) {
                    return CobrosAdicionalModel::Periodos($d);
                }
            ]
        );
        
        // SQL server connection information
        $sql_details = ARRAY_BASE_DATOS;

        $response = SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns );
        echo json_encode($response);
    break;

    /**
     * Registrar
     */
    case 'registrar':
        $empresa_id = Input::post('empresa_id', TRUE);
        $descripcion = Input::post('descripcion', TRUE);
        $monto = floatval( Input::post('monto', TRUE) );
        $periodos_id = Input::post('periodos_id', FALSE);
        $es_fijo = Input::post('es_fijo', FALSE) != NULL;

        $objEmpresa = new EmpresaModel( $empresa_id );
        if( empty($descripcion) ) throw new Exception("La descripción no puede estar vacia.");
        if( $monto < 0 ) throw new Exception("El monto debe ser un valor positivo.");

        Conexion::db()->startTransaction();
        $empresa_id = CobrosAdicionalModel::Registrar($objEmpresa->id, $descripcion, $monto, $es_fijo, $periodos_id);
        Conexion::db()->commit();

        sendJson([ 'ok' => TRUE ]);
    break;

    /**
     * Modificar
     */
    case 'modificar':
        $cobro_adicional_id = Input::post('cobro_adicional_id', TRUE);
        $descripcion = Input::post('descripcion', TRUE);
        $monto = floatval( Input::post('monto', TRUE) );
        $periodos_id = Input::post('periodos_id', FALSE);
        $es_fijo = Input::post('es_fijo', FALSE) != NULL;
        
        if(!is_array($periodos_id)) $periodos_id = [];
        if($es_fijo) $periodos_id = [];

        $objCobroAdicional = new CobroAdicionalModel( $cobro_adicional_id );
        $objEmpresa = new EmpresaModel( $objCobroAdicional->empresa_id );
        if( empty($descripcion) ) throw new Exception("La descripción no puede estar vacia.");

        Conexion::db()->startTransaction();

        $objCobroAdicional->Modificar([
            'descripcion' => $descripcion,
            'monto' => $monto,
            'es_fijo' => $es_fijo,
        ]);
        
        $objCobroAdicional->ModificarPeriodos( $periodos_id );
        
        Conexion::db()->commit();

        sendJson([ 'ok' => TRUE ]);
    break;

    /**
     * Eliminar
     */
    case 'eliminar':
        $cobro_adicional_id = Input::post('cobro_adicional_id', TRUE);

        $objCobroAdicional = new CobroAdicionalModel( $cobro_adicional_id );

        Conexion::db()->startTransaction();
        
        $objCobroAdicional->Eliminar();
        
        Conexion::db()->commit();

        sendJson([ 'ok' => TRUE ]);
    break;
    
    /**
     * Defecto
     */
    default: throw new Exception('Acción invalida.');
}