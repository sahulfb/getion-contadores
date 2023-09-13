<?php

class controlador
{
    /**
     * Index
     */
    public function index() {
        $roles = RolesModel::Buscar();
        Incluir::template('templates/index.tpl', [], [
            'js' => ["public/js/index.js"]
        ]);
    }

    /**
     * CRUD
     */
    public function crud($parametros = []) {
        setHandlerJson();

        if(!isset($parametros[0])) throw new Exception('No se ha enviado la acción.');
        $accion = strtoupper($parametros[0]);

        switch($accion)
        {
            case 'CONSULTAR':
                $table = 'servicios';
                $primaryKey = 'id';
                
                $columns = array(
                    [ 'db' => 'id', 'dt' => 'id' ],
                    [ 'db' => 'nombre', 'dt' => 'nombre' ],
                    [ 'db' => 'observacion', 'dt' => 'observacion' ],
                );
                
                // SQL server connection information
                $sql_details = ARRAY_BASE_DATOS;

                $response = SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns );
                echo json_encode($response);
            break;

            case 'REGISTRAR':
                $nombre = Input::post('nombre', TRUE);
                $observacion = Input::post('observacion', TRUE);
            
                if(ServiciosModel::ExisteNombre($nombre)) {
                    throw new Exception("El servicio <b>{$nombre}</b> ya esta registrado.");
                }
            
                Conexion::db()->startTransaction();
                $id = ServiciosModel::Registrar($nombre, $observacion);
                Conexion::db()->commit();
            
                sendJson([
                    'id' => $id
                ]);
            break;

            case 'MODIFICAR':
                $id = Input::post('id', TRUE);
                $objServicio = new ServicioModel($id);
            
                $nombre = Input::post('nombre', TRUE);
                $observacion = Input::post('observacion', TRUE);
            
                $data = [];
                if($nombre != $objServicio->nombre) {
                    if(ServiciosModel::ExisteNombre($nombre, $objServicio->id)) {
                        throw new Exception("El servicio <b>{$nombre}</b> ya esta registrado.");
                    }
            
                    $data['nombre'] = $nombre;
                }
                if($observacion != $objServicio->observacion) {
                    $data['observacion'] = $observacion;
                }
            
                if(sizeof($data) > 0) {
                    Conexion::db()->startTransaction();
                    $objServicio->Modificar($data);
                    Conexion::db()->commit();
                }
            
                sendJson([
                    'id' => $objServicio->id
                ]);
            break;

            case 'ELIMINAR':
                $id = Input::post('id', TRUE);
                $objServicio = new ServicioModel($id);

                Conexion::db()->startTransaction();
                $objServicio->Eliminar();
                Conexion::db()->commit();
            
                sendJson([
                    'id' => $objServicio->id
                ]);
            break;

            default:
                throw new Exception('Acción invalida.');
            break;
        }
    }
}