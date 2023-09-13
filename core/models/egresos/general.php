<?php

class EgresosModel
{
    public static function Buscar($condicionales = []) {
        foreach($condicionales as $key => $value) {
            Conexion::db()->where($value);
        }

        $datos = Conexion::db()->get('egresos');
        return $datos;
    }

    public static function Registrar($fecha, $detalle, $montoCLP, $idCentroCosto, $observacion) {
        $idUsuario = Sesion::Usuario()->id;
        $idStatus = 1;
        $data = [
            'fecha' => $fecha,
            'detalle' => $detalle,
            'montoCLP' => $montoCLP,
            'idCentroCosto' => $idCentroCosto,
            'idUsuario' => $idUsuario,
            'observacion' => $observacion,
            'idStatus' => $idStatus
        ];
        $idEgreso = Conexion::db()->insert('egresos', $data);
        if(!$idEgreso) {
            throw new Exception('Ocurrio un error al intentar registrar el egreso.');
        }

        return $idEgreso;
    }
}