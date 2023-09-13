<?php

class CobroAdicionalModel
{
    public $id;
    public $empresa_id;
    public $descripcion;
    public $monto;
    public $es_fijo;
    public $created_at;
    public $updated_at;

    public function __construct($id) {
        Conexion::db()->where('id', $id);
        $datos = Conexion::db()->get('cobros_adicionales');
        if(sizeof($datos) <= 0) throw new Exception("Cobro adicional ID: {$id} no existe.");

        $this->id = $datos[0]['id'];
        $this->empresa_id = $datos[0]['empresa_id'];
        $this->descripcion = $datos[0]['descripcion'];
        $this->monto = $datos[0]['monto'];
        $this->es_fijo = boolval( $datos[0]['es_fijo'] );
        $this->created_at = $datos[0]['created_at'];
        $this->updated_at = $datos[0]['updated_at'];
    }

    /**
     * 
     */
    public function Modificar($data) {
        Conexion::db()->where('id', $this->id);
        $resp = Conexion::db()->update('cobros_adicionales', $data);
        if(!$resp) throw new Exception('Ocurrio un error al intentar modificar el cobro adicional.');
        
        foreach($data as $key => $value) {
            if(isset($this->$key)) {
                $this->$key = $value;
            }
        }
    }

    /**
     * 
     */
    public function ModificarPeriodos($periodos_id) {
        if(!is_array($periodos_id)) return;
        Conexion::db()->where('cobro_adicional_id', $this->id);
        Conexion::db()->delete('cobros_adicionales_periodos');

        foreach($periodos_id as $periodo_id) {
            $resp = Conexion::db()->insert('cobros_adicionales_periodos', [
                'cobro_adicional_id' => $this->id,
                'periodo_id' => $periodo_id,
            ]);
            if(!$resp) throw new Exception('Error al intentar modificar los periodos del cobro adicional.');
        }
    }

    /**
     * 
     */
    public function Eliminar() {
        Conexion::db()->where('id', $this->id);
        $resp = Conexion::db()->delete('cobros_adicionales');
        if(!$resp) throw new Exception('Ocurrio un error al intentar eliminar el cobro adicional.');
        
        Conexion::db()->where('cobro_adicional_id', $this->id);
        $resp = Conexion::db()->delete('cobros_adicionales_periodos');
        if(!$resp) throw new Exception('Ocurrio un error al intentar eliminar los periodos de los cobros adicionales.');
    }
}