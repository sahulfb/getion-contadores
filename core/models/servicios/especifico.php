<?php

class ServicioModel
{
    public $id;
    public $nombre;
    public $observacion;
    public $created_at;
    public $updated_at;

    public function __construct($id) {
        Conexion::db()->where('id', $id);
        $datos = Conexion::db()->get('servicios');
        if(sizeof($datos) <= 0) {
            throw new Exception("Rol ID: {$id} no existe.");
        }

        $this->id = $datos[0]['id'];
        $this->nombre = $datos[0]['nombre'];
        $this->observacion = $datos[0]['observacion'];
        $this->created_at = $datos[0]['created_at'];
        $this->updated_at = $datos[0]['updated_at'];
    }

    /**
     * 
     */
    public function Modificar($data) {
        Conexion::db()->where('id', $this->id);
        $resp = Conexion::db()->update('servicios', $data);
        if(!$resp) {
            throw new Exception('Ocurrio un error al intentar modificar el servicio.');
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
    public function Eliminar() {
        Conexion::db()->where('id', $this->id);
        $resp = Conexion::db()->delete('servicios');
        if(!$resp) {
            throw new Exception('Ocurrio un error al intentar eliminar el servicio.');
        }
    }
}