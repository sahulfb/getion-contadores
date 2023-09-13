<?php

class RolesModel
{
    public static function Buscar($condicionales = []) {
        foreach($condicionales as $key => $value) {
            Conexion::db()->where($key, $value);
        }

        $roles = Conexion::db()->get('roles');
        return $roles;
    }

    public static function ExisteNombre($nombre) {
        Conexion::db()->where('nombre', $nombre);
        $roles = Conexion::db()->get('roles');
        if(sizeof($roles) > 0) return TRUE;
        else return FALSE;
    }

    public static function Registrar($nombre, $descripcion) {
        $data = [
            'nombre' => $nombre,
            'descripcion' => $descripcion
        ];

        $id = Conexion::db()->insert('roles', $data);
        if(!$id) {
            throw new Exception('Ocurrio un error al intentar registrar el rol.');
        }

        return $id;
    }
}