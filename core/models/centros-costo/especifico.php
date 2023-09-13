<?php

class CentroCostoModel
{
    public $id;
    public $nombre;
    public $fecha_registro;
    public $fecha_modificacion;
    public $isDeleted;

    public function __construct($id) {
        Conexion::db()->where('idCentroCosto', $id);
        $datos = Conexion::db()->get('centros_costo');
        if(sizeof($datos) <= 0) {
            throw new Exception("Centro de costo ID: {$id} no existe.");
        }

        $this->id = $datos[0]['idCentroCosto'];
        $this->nombre = $datos[0]['nombre'];
        $this->fecha_registro = $datos[0]['fecha_registro'];
        $this->fecha_modificacion = $datos[0]['fecha_modificacion'];
        $this->isDeleted = boolval($datos[0]['isDeleted']);
    }

    /**
     * 
     */
    public function Modificar($data) {
        Conexion::db()->where('idCentroCosto', $this->id);
        $resp = Conexion::db()->update('centros_costo', $data);
        if(!$resp) {
            throw new Exception('Ocurrio un error al intentar modificar el centro de costo.');
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
        // Verificamos si tiene alguna relacion en facturas
        Conexion::db()->where("idCentroCosto", $this->id);
        $cantidad = Conexion::db()->getValue('facturas', 'count(*)');
        // Si el usuario tiene relación ocultamos
        if($cantidad > 0) {
            Conexion::db()->where('idCentroCosto', $this->id);
            $resp = Conexion::db()->update('centros_costo', ['isDeleted' => '1']);
            if(!$resp) {
                throw new Exception('Ocurrio un error al intentar ocultar el centro de costo.');
            }
        }
        // Si no eliminamos
        else {
            Conexion::db()->where('idCentroCosto', $this->id);
            $resp = Conexion::db()->delete('centros_costo');
            if(!$resp) {
                throw new Exception('Ocurrio un error al intentar eliminar el centro de costo.');
            }
        }
    }
}