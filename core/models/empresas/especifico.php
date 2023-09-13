<?php

class EmpresaModel
{
    
    public $id;
    public $rut;
    public $razon_social;
    public $correo;
    public $idPlan;
    public $idPlan_sinMovimiento;
    public $fecha_registro;
    public $fecha_modificacion;
    public $isDeleted;

    public function __construct($id) {
        Conexion::db()->where('idEmpresa', $id);
        $datos = Conexion::db()->get('empresas');
        if(sizeof($datos) <= 0) {
            throw new Exception("Empresa ID: {$id} no existe.");
        }

        $this->id = $datos[0]['idEmpresa'];
        $this->rut = $datos[0]['rut'];
        $this->razon_social = $datos[0]['razon_social'];
        $this->correo = $datos[0]['correo'];
        $this->idPlan = $datos[0]['idPlan'];
        $this->idPlan_sinMovimiento = $datos[0]['idPlan_sinMovimiento'];
        $this->fecha_registro = $datos[0]['fecha_registro'];
        $this->fecha_modificacion = $datos[0]['fecha_modificacion'];
        $this->isDeleted = boolval($datos[0]['isDeleted']);
    }

    /**
     * 
     */
    public function Modificar($data) {
        Conexion::db()->where('idEmpresa', $this->id);
        $resp = Conexion::db()->update('empresas', $data);
        if(!$resp) {
            throw new Exception('Ocurrio un error al intentar modificar la empresa.');
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
        Conexion::db()->where('idEmpresa', $this->id);
        $cantidad = Conexion::db()->getValue('cobros', 'count(*)');
        // Si la empresa tiene relación ocultamos
        if($cantidad > 0) {
            Conexion::db()->where('idEmpresa', $this->id);
            $resp = Conexion::db()->update('empresas', ['isDeleted' => '1']);
            if(!$resp) {
                throw new Exception('Ocurrio un error al intentar ocultar la empresa.');
            }
        }
        // Si no eliminamos
        else {
            Conexion::db()->where('idEmpresa', $this->id);
            $resp = Conexion::db()->delete('empresas');
            if(!$resp) {
                throw new Exception('Ocurrio un error al intentar eliminar la empresa.');
            }
        }
    }
}