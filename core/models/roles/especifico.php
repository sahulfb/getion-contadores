<?php

class RolModel
{
    public $id;
    public $nombre;
    public $descripcion;
    public $fecha_registro;
    public $fecha_modificacion;

    public function __construct($id) {
        Conexion::db()->where('idRol', $id);
        $datos = Conexion::db()->get('roles');
        if(sizeof($datos) <= 0) {
            throw new Exception("Rol ID: {$id} no existe.");
        }

        $this->id = $datos[0]['idRol'];
        $this->nombre = $datos[0]['nombre'];
        $this->descripcion = $datos[0]['descripcion'];
        $this->fecha_registro = $datos[0]['fecha_registro'];
        $this->fecha_modificacion = $datos[0]['fecha_modificacion'];
    }

    /**
     * 
     */
    public function Modificar($data) {
        Conexion::db()->where('idRol', $this->id);
        $resp = Conexion::db()->update('roles', $data);
        if(!$resp) {
            throw new Exception('Ocurrio un error al intentar modificar el rol.');
        }
        
        foreach($data as $key => $value) {
            if(isset($this->$key)) {
                $this->$key = $value;
            }
        }
    }

    /**
     * 
     */
    public function Eliminar($idRolSustituto) {
        Conexion::db()->where('idRol', $this->id);
        $resp = Conexion::db()->update('usuarios', ['idRol' => $idRolSustituto]);
        if(!$resp) {
            throw new Exception('Ocurrio un error al intentar sustituir el rol sustituto.');
        }

        Conexion::db()->where('idRol', $this->id);
        $resp = Conexion::db()->delete('roles');
        if(!$resp) {
            throw new Exception('Ocurrio un error al intentar eliminar el rol.');
        }
    }
}