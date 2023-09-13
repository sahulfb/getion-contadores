<?php

class MenusAModel
{
    public static function Buscar($condicionales = []) {
        foreach($condicionales as $key => $value) {
            Conexion::db()->where($key, $value);
        }

        $menus = Conexion::db()->get('menus_a');
        return $menus;
    }

    public static function BuscarPorRol($idRol) {
        Conexion::db()->join("menus_a b", "a.idMenuA = b.idMenuA AND a.idRol = '{$idRol}'", "INNER");
        Conexion::db()->orderBy('idMenuA', 'ASC');
        $datos = Conexion::db()->get('menus_a_permisos a', NULL, 'b.*');
        return $datos;
    }

    public static function VerificarPermiso($idRol, $idMenuA) {
        Conexion::db()->where('idRol', $idRol);
        Conexion::db()->where('idMenuA', $idMenuA);
        $datos = Conexion::db()->get('menus_a_permisos');

        if(sizeof($datos) > 0) return TRUE;
        else return FALSE;
    }

    public static function CambiarPermiso($idRol, $idMenu) {
        if(self::VerificarPermiso($idRol, $idMenu))
        {
            Conexion::db()->where('idRol', $idRol);
            Conexion::db()->where('idMenuA', $idMenu);
            $resp = Conexion::db()->delete('menus_a_permisos');
            if(!$resp) {
                throw new Exception("Ocurrio un error al intentar eliminar el permiso.");
            }
        }
        else
        {
            $data = ['idRol' => $idRol, 'idMenuA' => $idMenu];
            $id = Conexion::db()->insert('menus_a_permisos', $data);
            if(!$id) {
                throw new Exception("Ocurrio un error al intentar registrar el permiso.");
            }
        }
    }
}