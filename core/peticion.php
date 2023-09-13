<?php

/*================================================================================
 *--------------------------------------------------------------------------------
 *
 *  Clase petición encargada de analizar la solicitud de la URL
 *  {Controlador}/{Metodo}/{Parametro_1}/{Parametro_2}/.../{Parametro_N}
 *
 *--------------------------------------------------------------------------------
================================================================================*/
class Peticion
{
    /*============================================================================
	 *
	 *	Atributos
	 *
    ============================================================================*/
    private static $controlador;
    private static $metodo;
    private static $parametros;
    
    /*============================================================================
	 *
	 *	Iniciar el analisis de la petición
	 *
    ============================================================================*/
    public static function Analizar()
    {
        // Guardamos y separamos la URL solicitada
        $peticion = (isset($_GET['url'])) ? $_GET['url'] : "";
        $arrayPeticion = explode("/", trim($peticion, "/"));

        // Valores por defecto
        self::$controlador = "";
        self::$metodo = "";
        self::$parametros = [];

        switch(sizeof($arrayPeticion)) {
            case 0:
                // Nothing
            break;

            case 1:
                self::$controlador = $arrayPeticion[0];
            break;

            case 2:
                self::$controlador = $arrayPeticion[0];
                self::$metodo = $arrayPeticion[1];
            break;

            default:
                self::$controlador = $arrayPeticion[0];
                self::$metodo = $arrayPeticion[1];

                for($i=2; $i<sizeof($arrayPeticion); $i++) {
                    array_push(self::$parametros, $arrayPeticion[$i]);
                }
            break;
        }

        if(self::$controlador == "") self::$controlador = "dashboard";
        if(self::$metodo == "") self::$metodo = "index";

        self::$controlador = strtolower(self::$controlador);
        self::$metodo = strtolower(self::$metodo);
    }
    
    /*============================================================================
	 *
	 *	Getter
	 *
    ============================================================================*/    
    public static function getControlador() {
        return self::$controlador;
    }
    
    public static function getMetodo() {
        return self::$metodo;
    }
    
    public static function getParametros() {
        return self::$parametros;
    }
}