<?php

/*================================================================================
 *--------------------------------------------------------------------------------
 *
 *	Conexion
 *
 *--------------------------------------------------------------------------------
================================================================================*/
class Conexion
{
    private static $db;

    public static function conectar() {
        $credenciales = ARRAY_BASE_DATOS;
        self::$db = new MysqliDb($credenciales);
    }

    public static function db() {
        return self::$db;
    }
}