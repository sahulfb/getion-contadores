<?php

class EgresoModel
{
    public $id;
    public $fecha;
    public $detalle;
    public $montoCLP;
    public $idCentroCosto;
    public $idUsuario;
    public $observacion;
    public $idStatus;
    public $fecha_registro;
    public $fecha_modificacion;

    public function __construct($id) {
        Conexion::db()->where('idEgreso', $id);
        $datos = Conexion::db()->get('egresos');
        if(sizeof($datos) <= 0) {
            throw new Exception("Egresos ID: {$id} no existe.");
        }
        
        $this->id = $datos[0]['idEgreso'];
        $this->fecha = $datos[0]['fecha'];
        $this->detalle = $datos[0]['detalle'];
        $this->montoCLP = $datos[0]['montoCLP'];
        $this->idCentroCosto = $datos[0]['idCentroCosto'];
        $this->idUsuario = $datos[0]['idUsuario'];
        $this->observacion = $datos[0]['observacion'];
        $this->idStatus = $datos[0]['idStatus'];
        $this->fecha_registro = $datos[0]['fecha_registro'];
        $this->fecha_modificacion = $datos[0]['fecha_modificacion'];
    }

    /**
     * 
     */
    public function Modificar($data) {
        Conexion::db()->where('idEgreso', $this->id);
        $resp = Conexion::db()->update('egresos', $data);
        if(!$resp) {
            throw new Exception('Ocurrio un error al intentar modificar el egreso.');
        }
        
        foreach($data as $key => $value) {
            if(isset($this->$key)) {
                $this->$key = $value;
            }
        }
    }
}