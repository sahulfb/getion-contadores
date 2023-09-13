<?php

class EstadosTareasModel
{
    public static function Buscar($condicionales = []) {
        foreach($condicionales as $key => $value) {
            Conexion::db()->where($key, $value);
        }

        $roles = Conexion::db()->get('estados_tareas');
        return $roles;
    }
}