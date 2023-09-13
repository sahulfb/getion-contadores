<?php

class CentrosCostoModel
{
    public static function Buscar($condicionales = []) {
        foreach($condicionales as $key => $value) {
            Conexion::db()->where($key, $value);
        }

        $datos = Conexion::db()->get('centros_costo');
        return $datos;
    }

    public static function ExisteNombre($nombre) {
        Conexion::db()->where('nombre', $nombre);
        $datos = Conexion::db()->get('centros_costo');
        if(sizeof($datos) > 0) return TRUE;
        else return FALSE;
    }

    public static function Registrar($nombre) {
        $data = [
            'nombre' => $nombre
        ];

        $id = Conexion::db()->insert('centros_costo', $data);
        if(!$id) {
            throw new Exception('Ocurrio un error al intentar registrar el centro de costo.');
        }

        return $id;
    }
}