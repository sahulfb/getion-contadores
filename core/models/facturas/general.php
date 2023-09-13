<?php

class FacturasModel
{
    public static function registrar($idEmpresa, $idPlan, $idPeriodoContable, $valorPlan, $cobros_adicionales, $valorCobrar, $con_movimiento, $idServicio, $servicio, $numeroFactura, $fechaCobro, $fechaVencimiento, $observacion, $idCentroCosto) {
        $idUsuario = Sesion::Usuario()->id;
        $idStatus = 1;
        $idMetodoPago = NULL;
        $fechaPago = NULL;

        $data = [
            'idUsuario' => $idUsuario,
            'idEmpresa' => $idEmpresa,
            'idPlan' => $idPlan,
            'idPeriodoContable' => $idPeriodoContable,
            'idCentroCosto' => $idCentroCosto,
            'valorPlan' => $valorPlan,
            'cobros_adicionales' => $cobros_adicionales,
            'valorCobrar' => $valorCobrar,
            'con_movimiento' => $con_movimiento,
            'idServicio' => $idServicio,
            'servicio' => $servicio,
            'numeroFactura' => $numeroFactura,
            'fechaCobro' => $fechaCobro,
            'fechaVencimiento' => $fechaVencimiento,
            'idStatus' => $idStatus,
            'observacion' => $observacion,
            'idMetodoPago' => $idMetodoPago,
            'fechaPago' => $fechaPago
        ];

        $id = Conexion::db()->insert('facturas', $data);
        if(!$id) {
            throw new Exception('Ocurrio un error al intentar registrar la factura.');
        }

        return $id;
    }

    public static function Buscar($condicionales = []) {
        foreach($condicionales as $condicional) {
            Conexion::db()->where($condicional);
        }

        $datos = Conexion::db()->get('facturas');
        return $datos;
    }

    public static function VerificarFechaVencimiento() {
        $fechaActual = date('Y-m-d');

        Conexion::db()->where("fechaVencimiento < '{$fechaActual}' AND idStatus = '1'");
        $facturasVencidas = Conexion::db()->get('facturas');
        if(sizeof($facturasVencidas) > 0) {
            Conexion::db()->where("fechaVencimiento < '{$fechaActual}' AND idStatus = '1'");
            Conexion::db()->update('facturas', ['idStatus' => '2']);
        }
    }
}