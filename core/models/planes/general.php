<?php

class PlanesModel
{
    /**
     * 
     */
    public static function Buscar($condicionales = []) {
        foreach($condicionales as $key => $value) {
            Conexion::db()->where($key, $value);
        }

        $roles = Conexion::db()->get('planes');
        return $roles;
    }

    /**
     * 
     */
    public static function ExisteCodigo($codigo) {
        Conexion::db()->where('codigo', $codigo);
        $planes = Conexion::db()->get('planes');
        if(sizeof($planes) > 0) return TRUE;
        else return FALSE;
    }

    /**
     * 
     */
    public static function Registrar($codigo, $nombre, $idFrecuenciaCobro, $monto, $detalle, $idMoneda) {
        $data = [
            'codigo' => $codigo,
            'nombre' => $nombre,
            'idFrecuenciaCobro' => $idFrecuenciaCobro,
            'monto' => $monto,
            'detalle' => $detalle,
            'idMoneda' => $idMoneda
        ];

        $id = Conexion::db()->insert('planes', $data);
        if(!$id) {
            throw new Exception('Ocurrio un error al intentar registrar el plan.');
        }

        return $id;
    }
}