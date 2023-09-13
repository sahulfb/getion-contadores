<?php

class MonedasModel
{
    public static function Buscar($condicionales = []) {
        foreach($condicionales as $key => $value) {
            Conexion::db()->where($key, $value);
        }

        $monedas = Conexion::db()->get('monedas');
        return $monedas;
    }
}