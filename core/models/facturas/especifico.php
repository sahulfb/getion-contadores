<?php

class FacturaModel
{
    public $id;
    public $idUsuario;
    public $idEmpresa;
    public $idPlan;
    public $idPeriodoContable;
    public $idCentroCosto;
    public $valorPlan;
    public $cobros_adicionales;
    public $valorCobrar;
    public $con_movimiento;
    public $idServicio;
    public $servicio;
    public $numeroFactura;
    public $fechaCobro;
    public $fechaVencimiento;
    public $idStatus;
    public $observacion;
    public $idMetodoPago;
    public $fechaPago;
    public $fecha_registro;
    public $fecha_modificacion;

    public function __construct($id) {
        Conexion::db()->where('idFactura', $id);
        $datos = Conexion::db()->get('facturas');
        if(sizeof($datos) <= 0) {
            throw new Exception("Factura ID: {$id} no existe.");
        }

        $this->id = $datos[0]['idFactura'];
        $this->idUsuario = $datos[0]['idUsuario'];
        $this->idEmpresa = $datos[0]['idEmpresa'];
        $this->idPlan = $datos[0]['idPlan'];
        $this->idPeriodoContable = $datos[0]['idPeriodoContable'];
        $this->idCentroCosto = $datos[0]['idCentroCosto'];
        $this->valorPlan = $datos[0]['valorPlan'];
        $this->cobros_adicionales = $datos[0]['cobros_adicionales'];
        $this->valorCobrar = $datos[0]['valorCobrar'];
        $this->con_movimiento = $datos[0]['con_movimiento'];
        $this->idServicio = $datos[0]['idServicio'];
        $this->servicio = $datos[0]['servicio'];
        $this->numeroFactura = $datos[0]['numeroFactura'];
        $this->fechaCobro = $datos[0]['fechaCobro'];
        $this->fechaVencimiento = $datos[0]['fechaVencimiento'];
        $this->idStatus = $datos[0]['idStatus'];
        $this->observacion = $datos[0]['observacion'];
        $this->idMetodoPago = $datos[0]['idMetodoPago'];
        $this->fechaPago = $datos[0]['fechaPago'];
        $this->fecha_registro = $datos[0]['fecha_registro'];
        $this->fecha_modificacion = $datos[0]['fecha_modificacion'];
    }
    
    public function Modificar($data) {
        Conexion::db()->where('idFactura', $this->id);
        $resp = Conexion::db()->update('facturas', $data);
        if(!$resp) {
            throw new Exception('Ocurrio un error al intentar modificar el factura.');
        }
        
        foreach($data as $key => $value) {
            if(isset($this->$key)) {
                $this->$key = $value;
            }
        }
    }

    public function Anular($observacion) {
        $data = [
            'idStatus' => '3',
            'observacion' => $observacion
        ];
        Conexion::db()->where('idFactura', $this->id);
        $resp = Conexion::db()->update('facturas', $data);
        if(!$resp) {
            throw new Exception('Ocurrio un error al intentar anular el factura.');
        }
    }

    
    public function Pagar($idMetodoPago, $fechaPago) {
        $data = [
            'idStatus' => '4',
            'idMetodoPago' => $idMetodoPago,
            'fechaPago' => $fechaPago
        ];
        Conexion::db()->where('idFactura', $this->id);
        $resp = Conexion::db()->update('facturas', $data);
        if(!$resp) {
            throw new Exception('Ocurrio un error al intentar pagar el factura.');
        }
    }

    public function Dicom($observacion) {
        $data = [
            'idStatus' => '5',
            'observacion' => $observacion
        ];
        Conexion::db()->where('idFactura', $this->id);
        $resp = Conexion::db()->update('facturas', $data);
        if(!$resp) {
            throw new Exception('Ocurrio un error al intentar colocar en status dicom la factura.');
        }
    }
}