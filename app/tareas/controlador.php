<?php

class controlador
{
    public function index() {
        Incluir::template('templates/index.html', [
            'estados' => EstadosTareasModel::Buscar(),
            'empresas' => EmpresasModel::Buscar(['isDeleted' => 0]),
            'usuarios' => UsuariosModel::Buscar(['isDeleted' => 0, 'activo' => 1]),
        ], [
            'js' => ["public/index.js"]
        ]);
    }

    public function ver($parametros = []) {
        if(!isset($parametros[0])) throw new Exception('No se ha enviado el ID de la tarea.');
        $objTarea = new TareaModel($parametros[0]);

        $cambios = $objTarea->getHistorial();
        foreach($cambios as $key => $cambio) {
            $cambios[$key]['usuario'] = new UsuarioModel($cambio['usuario_id']);
        }

        Incluir::template('templates/ver.html', [
            'empresas' => EmpresasModel::Buscar(['isDeleted' => 0]),
            'usuarios' => UsuariosModel::Buscar(['isDeleted' => 0, 'activo' => 1]),
            'tarea' => $objTarea,
            'objEmpresa' => new EmpresaModel($objTarea->empresa_id),
            'objUsuario' => new UsuarioModel($objTarea->usuario_id),
            'estado' => new EstadoTareaModel($objTarea->estado_id),
            'cambios' => $cambios,
            'json_cambios' => str_replace('\\', '\\\\', json_encode($json_cambios)),
        ], [
            'js' => ["public/ver.js"]
        ]);
    }

    public function api($parametros = []) {
        setHandlerJson();
        if(!isset($parametros[0])) throw new Exception('No se ha enviado la acción.');
        $accion = strtolower($parametros[0]);
        switch($accion)
        {
            case 'datatable':
                $table = 'tareas';
                $primaryKey = 'id';
                $where = "";

                if( isset($_GET['filtros']) )
                {
                    if( isset($_GET['filtros']['estado']) AND $_GET['filtros']['estado'] != "" ) {
                        $estado = $_GET['filtros']['estado'];
                        if($where != "") $where .= " AND ";
                        $where .= "estado_id = '{$estado}'";
                    }
                    if( isset($_GET['filtros']['empresa']) AND $_GET['filtros']['empresa'] != "" ) {
                        $empresa = $_GET['filtros']['empresa'];
                        if($where != "") $where .= " AND ";
                        $where .= "empresa_id = '{$empresa}'";
                    }
                    if( isset($_GET['filtros']['usuario']) AND $_GET['filtros']['usuario'] != "" ) {
                        $usuario = $_GET['filtros']['usuario'];
                        if($where != "") $where .= " AND ";
                        $where .= "usuario_id = '{$usuario}'";
                    }
                }
                
                $columns = array(
                    [ 'db' => 'id', 'dt' => 'id' ],
                    [
                        'db' => 'estado_id', 'dt' => 'estado',
                        'formatter' => function($d, $row) {
                            return new EstadoTareaModel($d);
                        }
                    ],
                    [
                        'db' => 'empresa_id', 'dt' => 'empresa',
                        'formatter' => function($d, $row) {
                            return new EmpresaModel($d);
                        }
                    ],
                    [ 'db' => 'descripcion', 'dt' => 'descripcion' ],
                    [
                        'db' => 'fecha_vencimiento', 'dt' => 'fecha_vencimiento',
                        'formatter' => function($d, $row) {
                            return date_format( date_create($d), 'd/m/Y' );
                        }
                    ],
                    [
                        'db' => 'created_at', 'dt' => 'fecha_registro',
                        'formatter' => function($d, $row) {
                            return date_format( date_create($d), 'd/m/Y' );
                        }
                    ],
                );
                
                // SQL server connection information
                $sql_details = ARRAY_BASE_DATOS;

                $response = SSP::complex( $_GET, $sql_details, $table, $primaryKey, $columns, $where );
                echo json_encode($response);
            break;

            case 'registrar':
                $empresa_id = Input::post('empresa', TRUE);
                $usuario_id = Input::post('usuario', TRUE);
                $descripcion = Input::post('descripcion', TRUE);
                $fecha_vencimiento = Input::post('fecha_vencimiento', TRUE);

                $objEmpresa = new EmpresaModel($empresa_id);
                $objUsuario = new UsuarioModel($usuario_id);
                if($descripcion == "") throw new Exception('El detalle no puede estar vacio.');

                Conexion::db()->startTransaction();
                $id = TareasModel::Registrar($objEmpresa->id, $objUsuario->id, $descripcion, $fecha_vencimiento);
                Conexion::db()->commit();

                sendJson([ 'ok' => TRUE ]);
            break;

            case 'modificar':
                $id = Input::post('id', TRUE);
                $empresa_id = Input::post('empresa', TRUE);
                $usuario_id = Input::post('usuario', TRUE);
                $descripcion = Input::post('descripcion', TRUE);
                $fecha_vencimiento = Input::post('fecha_vencimiento', TRUE);
                
                $objTarea = new TareaModel($id);
                $objEmpresa = new EmpresaModel($empresa_id);
                $objUsuario = new UsuarioModel($usuario_id);
                if($descripcion == "") throw new Exception('El detalle no puede estar vacio.');

                $data = [];
                $data['empresa_id'] = $objEmpresa->id;
                $data['usuario_id'] = $objUsuario->id;
                $data['descripcion'] = $descripcion;
                $data['fecha_vencimiento'] = $fecha_vencimiento;

                Conexion::db()->startTransaction();
                $objTarea->Modificar($data);
                $objTarea->addHistorial(
                    $usuario_id = Sesion::Usuario()->id,
                    $comentario = 'Se ha actualizado la tarea.'
                );
                Conexion::db()->commit();

                sendJson([ 'ok' => TRUE ]);
            break;

            case 'estado':
                $id = Input::post('id', TRUE);
                $estado_id = Input::post('estado_id', TRUE);
                
                $objTarea = new TareaModel($id);
                $objEstado = new EstadoTareaModel($estado_id);

                $data = [];
                $data['estado_id'] = $objEstado->id;

                Conexion::db()->startTransaction();
                $objTarea->Modificar($data);
                $objTarea->addHistorial(
                    $usuario_id = Sesion::Usuario()->id,
                    $comentario = "Se ha cambiado el estado de la tarea a <b>{$objEstado->nombre}</b>",
                );
                Conexion::db()->commit();

                sendJson([ 'ok' => TRUE ]);
            break;

            case 'anular':
                $id = Input::post('id', TRUE);
                $justificacion = Input::post('justificacion', TRUE);

                if($justificacion == "") throw new Exception('La justificación no puede estar vacia.');
                
                $objTarea = new TareaModel($id);
                $objEstado = new EstadoTareaModel('3');

                $data = [];
                $data['estado_id'] = $objEstado->id;

                Conexion::db()->startTransaction();
                $objTarea->Modificar($data);
                $objTarea->addHistorial(
                    $usuario_id = Sesion::Usuario()->id,
                    $comentario = "Se ha cambiado el estado de la tarea a <b>{$objEstado->nombre}</b> por:<br>{$justificacion}",
                );
                Conexion::db()->commit();

                sendJson([ 'ok' => TRUE ]);
            break;

            default: throw new Exception('Acción invalida.');
        }
    }
    
    public function api_historial($parametros = []) {
        setHandlerJson();
        if(!isset($parametros[0])) throw new Exception('No se ha enviado la acción.');
        $accion = strtolower($parametros[0]);
        switch($accion)
        {
            case 'registrar':
                $id = Input::post('id', TRUE);
                $comentario = Input::post('comentario', TRUE);

                $objTarea = new TareaModel($id);
                if($comentario == "") throw new Exception('El comentario no puede estar vacio.');

                Conexion::db()->startTransaction();
                $objTarea->addHistorial(
                    $usuario_id = Sesion::Usuario()->id,
                    $comentario
                );
                Conexion::db()->commit();

                sendJson([ 'ok' => TRUE ]);
            break;
            
            case 'anular':
                $id = Input::post('id', TRUE);

                Conexion::db()->startTransaction();

                Conexion::db()->where('id', $id);
                Conexion::db()->update('historial_tareas', ['anulado' => '1']);

                Conexion::db()->commit();

                sendJson([ 'ok' => TRUE ]);
            break;

            default: throw new Exception('Acción invalida.');
        }
    }
}