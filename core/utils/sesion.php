<?php

/*================================================================================
 *--------------------------------------------------------------------------------
 *
 *	Sesión
 *
 *--------------------------------------------------------------------------------
================================================================================*/
class Sesion
{
    /*============================================================================
	 *
	 *	Atributos
	 *
    ============================================================================*/
    private const KEY = SISTEMA['key_sesion'];
    private static $usuario;
    private static $ip;

    /*============================================================================
	 *
	 *	Getter
	 *
    ============================================================================*/
    public static function getKey() {
        return self::$key;
    }

    public static function Usuario() {
        return self::$usuario;
    }

    public static function getIp() {
        return self::$ip;
    }

    /*============================================================================
	 *
	 *	Iniciar
	 *
    ============================================================================*/
    public static function Iniciar()
    {
        session_start();
    }

    /*============================================================================
	 *
	 *	Crear
	 *
    ============================================================================*/
    public static function Crear($idUsuario)
    {
        $ip = IP_CLIENTE;
        $string = "{$idUsuario}-{$ip}";
        $_SESSION[self::KEY] = $string;
    }

    /*============================================================================
	 *
	 *	Cerrar
	 *
    ============================================================================*/
    public static function Cerrar()
    {
        $_SESSION[self::KEY] = "";
        unset($_SESSION[self::KEY]);
    }

    /*============================================================================
	 *
	 *	Validar
	 *
    ============================================================================*/
    public static function Validar()
    {
        if(!isset($_SESSION[self::KEY])) {
            return FALSE;
        }
        
        $contentText = $_SESSION[self::KEY];
        $contentArray = explode("-", $contentText);

        if(sizeof($contentArray) != 2) {
            return FALSE;
        }

        $idUsuario = $contentArray[0];
        $ip = $contentArray[1];

        self::$ip = $ip;

        try {
            $objUsuario = new UsuarioModel($idUsuario);
            self::$usuario = $objUsuario;
        } catch(Exception $e) {
            return FALSE;
        }

        if(!$objUsuario->activo) {
            return FALSE;
        }

        if($ip !== IP_CLIENTE) {
            return FALSE;
        }

        return TRUE;
    }
}