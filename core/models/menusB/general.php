<?php

class MenusBModel
{
    public static function Buscar($condicionales = []) {
        foreach($condicionales as $key => $value) {
            Conexion::db()->where($key, $value);
        }

        $menus = Conexion::db()->get('menus_b');
        return $menus;
    }

    public static function BuscarPorRol($idRol, $idMenuA) {
        Conexion::db()->join("menus_b b", "a.idMenuB = b.idMenuB AND b.idMenuA = '{$idMenuA}' AND a.idRol = '{$idRol}'", "INNER");
        Conexion::db()->orderBy('idMenuB', 'ASC');
        $datos = Conexion::db()->get('menus_b_permisos a', NULL, 'b.*');
        return $datos;
    }

    public static function VerificarPermiso($idRol, $idMenuB) {
        Conexion::db()->where('idRol', $idRol);
        Conexion::db()->where('idMenuB', $idMenuB);
        $datos = Conexion::db()->get('menus_b_permisos');

        if(sizeof($datos) > 0) return TRUE;
        else return FALSE;
    }

    public static function CambiarPermiso($idRol, $idMenu) {
        if(self::VerificarPermiso($idRol, $idMenu))
        {
            Conexion::db()->where('idRol', $idRol);
            Conexion::db()->where('idMenuB', $idMenu);
            $resp = Conexion::db()->delete('menus_b_permisos');
            if(!$resp) {
                throw new Exception("Ocurrio un error al intentar eliminar el permiso.");
            }
        }
        else
        {
            $data = ['idRol' => $idRol, 'idMenuB' => $idMenu];
            $id = Conexion::db()->insert('menus_b_permisos', $data);
            if(!$id) {
                throw new Exception("Ocurrio un error al intentar registrar el permiso.");
            }
        }
    }
}