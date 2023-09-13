<?php

class UsuarioModel
{
    public $id;
    public $nombre;
    public $correo;
    public $clave;
    public $idRol;
    public $activo;
    public $fecha_registro;
    public $fecha_modificacion;
    public $isDeleted;

    public $objRol = NULL;
    
    public function __construct($id) {
        Conexion::db()->where('idUsuario', $id);
        $datos = Conexion::db()->get('usuarios');
        if(sizeof($datos) <= 0) {
            throw new Exception("EL usuario ID: {$id} no existe.");
        }

        $this->id = $datos[0]['idUsuario'];
        $this->nombre = $datos[0]['nombre'];
        $this->correo = $datos[0]['correo'];
        $this->clave = $datos[0]['clave'];
        $this->idRol = $datos[0]['idRol'];
        $this->activo = boolval($datos[0]['activo']);
        $this->fecha_registro = $datos[0]['fecha_registro'];
        $this->fecha_modificacion = $datos[0]['fecha_modificacion'];
        $this->isDeleted = boolval($datos[0]['isDeleted']);
    }

    public function Rol() {
        if($this->objRol == NULL) {
            $this->objRol = new RolModel($this->idRol);
        }

        return $this->objRol;
    }

    /**
     * data: Array(Column => value)
     */
    public function Modificar($data) {
        Conexion::db()->where('idUsuario', $this->id);
        $resp = Conexion::db()->update('usuarios', $data);
        if(!$resp) {
            throw new Exception('Ocurrio un error al intentar modificar el usuario.');
        }

        foreach($data as $key => $value) {
            if(isset($this->$key)) {
                if($key == "activo") {
                    $value = boolval($value);
                }

                $this->$key = $value;
            }
        }
    }

    /**
     * valor: Boolean
     */
    public function Activar($valor) {
        $valor = (int) $valor;

        $data = [ 'activo' => $valor ];
        Conexion::db()->where('idUsuario', $this->id);
        $resp = Conexion::db()->update('usuarios', $data);
        if(!$resp) {
            throw new Exception('Ocurrio un error al intentar activar/desactivar el usuario');
        }

        $this->activo = boolval($valor);
    }

    /**
     * 
     */
    public function Eliminar() {
        // Verificamos si tiene alguna relacion en cobros
        Conexion::db()->where('idUsuario', $this->id);
        $cantidad = Conexion::db()->getValue('cobros', 'count(*)');
        // Si el usuario tiene relación ocultamos
        if($cantidad > 0) {
            Conexion::db()->where('idUsuario', $this->id);
            $resp = Conexion::db()->update('usuarios', ['isDeleted' => '1']);
            if(!$resp) {
                throw new Exception('Ocurrio un error al intentar ocultar el usuario.');
            }
        }
        // Si no eliminamos
        else {
            Conexion::db()->where('idUsuario', $this->id);
            $resp = Conexion::db()->delete('usuarios');
            if(!$resp) {
                throw new Exception('Ocurrio un error al intentar eliminar el usuario.');
            }
        }
    }
}