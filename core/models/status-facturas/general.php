<?php

class StatusFacturasModel
{
    /**
     * 
     */
    public static function Buscar($condicionales = []) {
        foreach($condicionales as $key => $value) {
            Conexion::db()->where($key, $value);
        }

        $datos = Conexion::db()->get('status_facturas');
        return $datos;
    }
}