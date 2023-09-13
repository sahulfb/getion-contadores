<?php

class PlanModel
{
    public $id;
    public $codigo;
    public $nombre;
    public $idFrecuenciaCobro;
    public $monto;
    public $detalle;
    public $idMoneda;
    public $fecha_registro;
    public $fecha_modificacion;
    public $isDeleted;

    public function __construct($id) {
        Conexion::db()->where('idPlan', $id);
        $datos = Conexion::db()->get('planes');
        if(sizeof($datos) <= 0) {
            throw new Exception("Plan ID: {$id} no existe.");
        }

        $this->id = $datos[0]['idPlan'];
        $this->codigo = $datos[0]['codigo'];
        $this->nombre = $datos[0]['nombre'];
        $this->idFrecuenciaCobro = $datos[0]['idFrecuenciaCobro'];
        $this->monto = $datos[0]['monto'];
        $this->detalle = $datos[0]['detalle'];
        $this->idMoneda = $datos[0]['idMoneda'];
        $this->fecha_registro = $datos[0]['fecha_registro'];
        $this->fecha_modificacion = $datos[0]['fecha_modificacion'];
        $this->isDeleted = boolval($datos[0]['isDeleted']);
    }

    /**
     * 
     */
    public function Modificar($data) {
        Conexion::db()->where('idPlan', $this->id);
        $resp = Conexion::db()->update('planes', $data);
        if(!$resp) {
            throw new Exception('Ocurrio un error al intentar modificar el plan.');
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
        Conexion::db()->where('idPlan', $this->id);
        $resp = Conexion::db()->delete('planes');
        if(!$resp) {
            throw new Exception('Ocurrio un error al intentar eliminar el plan.');
        }
    }
}