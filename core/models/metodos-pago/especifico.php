<?php

class MetodoPagoModel
{
    public $id;
    public $nombre;
    public $descripcion;
    public $fecha_registro;
    public $fecha_modificacion;
    public $isDeleted;

    public function __construct($id) {
        Conexion::db()->where('idMetodoPago', $id);
        $datos = Conexion::db()->get('metodos_pago');
        if(sizeof($datos) <= 0) {
            throw new Exception("Metodo de pago ID: {$id} no existe.");
        }

        $this->id = $datos[0]['idMetodoPago'];
        $this->nombre = $datos[0]['nombre'];
        $this->descripcion = $datos[0]['descripcion'];
        $this->fecha_registro = $datos[0]['fecha_registro'];
        $this->fecha_modificacion = $datos[0]['fecha_modificacion'];
        $this->isDeleted = boolval($datos[0]['isDeleted']);
    }

    /**
     * 
     */
    public function Modificar($data) {
        Conexion::db()->where('idMetodoPago', $this->id);
        $resp = Conexion::db()->update('metodos_pago', $data);
        if(!$resp) {
            throw new Exception('Ocurrio un error al intentar modificar el metodo de pago.');
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
        // Verificamos si tiene alguna relacion en cobros
        Conexion::db()->where("idMetodoPago", $this->id);
        $cantidad = Conexion::db()->getValue('cobros', 'count(*)');
        // Si el usuario tiene relación ocultamos
        if($cantidad > 0) {
            Conexion::db()->where('idMetodoPago', $this->id);
            $resp = Conexion::db()->update('metodos_pago', ['isDeleted' => '1']);
            if(!$resp) {
                throw new Exception('Ocurrio un error al intentar ocultar el metodo de pago.');
            }
        }
        // Si no eliminamos
        else {
            Conexion::db()->where('idMetodoPago', $this->id);
            $resp = Conexion::db()->delete('metodos_pago');
            if(!$resp) {
                throw new Exception('Ocurrio un error al intentar eliminar el metodo de pago.');
            }
        }
    }
}