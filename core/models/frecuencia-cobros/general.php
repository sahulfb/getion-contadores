<?php

class FrecuenciasCobroModel
{
    public static function Buscar($condicionales = []) {
        foreach($condicionales as $key => $value) {
            Conexion::db()->where($key, $value);
        }

        $periodos = Conexion::db()->get('frecuencia_cobro');
        return $periodos;
    }
}