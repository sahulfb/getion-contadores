<?php

class ServiciosModel
{
    public static function Buscar($condicionales = []) {
        foreach($condicionales as $key => $value) {
            Conexion::db()->where($key, $value);
        }

        $servicios = Conexion::db()->get('servicios');
        return $servicios;
    }

    public static function ExisteNombre($nombre, $id = NULL) {
        if($id != NULL) Conexion::db()->where('id', $id, '<>');
        Conexion::db()->where('nombre', $nombre);
        $servicios = Conexion::db()->get('servicios');
        if(sizeof($servicios) > 0) return TRUE;
        else return FALSE;
    }

    public static function Registrar($nombre, $observacion) {
        $data = [
            'nombre' => $nombre,
            'observacion' => $observacion
        ];

        $id = Conexion::db()->insert('servicios', $data);
        if(!$id) {
            throw new Exception('Ocurrio un error al intentar registrar el servicio.');
        }

        return $id;
    }
}