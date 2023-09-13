<?php

class StatusFacturaModel
{
    public $id;
    public $nombre;
    public $fecha_registro;
    public $fecha_modificacion;

    public function __construct($id) {
        Conexion::db()->where('idStatus', $id);
        $datos = Conexion::db()->get('status_facturas');
        if(sizeof($datos) <= 0) {
            throw new Exception("El status ID: {$id} no existe.");
        }

        $this->id = $datos[0]['idStatus'];
        $this->nombre = $datos[0]['nombre'];
        $this->fecha_registro = $datos[0]['fecha_registro'];
        $this->fecha_modificacion = $datos[0]['fecha_modificacion'];
    }
}