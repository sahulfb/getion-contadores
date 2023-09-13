<?php

class MetodosPagoModel
{
    public static function Buscar($condicionales = []) {
        foreach($condicionales as $key => $value) {
            Conexion::db()->where($key, $value);
        }

        $datos = Conexion::db()->get('metodos_pago');
        return $datos;
    }

    public static function ExisteNombre($nombre) {
        Conexion::db()->where('nombre', $nombre);
        $datos = Conexion::db()->get('metodos_pago');
        if(sizeof($datos) > 0) return TRUE;
        else return FALSE;
    }

    public static function Registrar($nombre, $descripcion) {
        $data = [
            'nombre' => $nombre,
            'descripcion' => $descripcion
        ];

        $id = Conexion::db()->insert('metodos_pago', $data);
        if(!$id) {
            throw new Exception('Ocurrio un error al intentar registrar el metodo de pago.');
        }

        return $id;
    }
}