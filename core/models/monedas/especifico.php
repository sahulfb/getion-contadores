<?php

class MonedaModel
{
    public $id;
    public $nombre;
    public $simbolo;
    public $decimales;
    public $precioCLP;
    public $fecha_registro;
    public $fecha_modificacion;

    public function __construct($id) {
        Conexion::db()->where('idMoneda', $id);
        $datos = Conexion::db()->get('monedas');
        if(sizeof($datos) <= 0) {
            throw new Exception("Moneda ID: {$id} no existe.");
        }

        $this->id = $datos[0]['idMoneda'];
        $this->nombre = $datos[0]['nombre'];
        $this->simbolo = $datos[0]['simbolo'];
        $this->decimales = $datos[0]['decimales'];
        $this->precioCLP = $datos[0]['precioCLP'];
        $this->fecha_registro = $datos[0]['fecha_registro'];
        $this->fecha_modificacion = $datos[0]['fecha_modificacion'];
    }

    /**
     * 
     */
    public function Modificar($data) {
        Conexion::db()->where('idMoneda', $this->id);
        $resp = Conexion::db()->update('monedas', $data);
        if(!$resp) {
            throw new Exception('Ocurrio un error al intentar modificar la moneda.');
        }
        
        foreach($data as $key => $value) {
            if(isset($this->$key)) {
                $this->$key = $value;
            }
        }
    }
}