<?php

/*================================================================================
 *--------------------------------------------------------------------------------
 *
 *	Formato
 *
 *--------------------------------------------------------------------------------
================================================================================*/
class Formato
{
	/*============================================================================
	 *
	 *	Numero
	 *
	============================================================================*/
	public static function Numero($numero, $decimales = 0)
	{
		$salida = number_format($numero, $decimales, ",", ".");
		return $salida;
	}

	/*============================================================================
	 *
	 *	Clave
	 *
	============================================================================*/
	public static function Clave($text)
	{
		$salida = "";
		for($I=0; $I<strlen($text); $I++)
		{
			$salida .= "*";
		}

		return $salida;
	}

	/*============================================================================
	 *
	 *	Boolean to Text
	 *
	============================================================================*/
	public static function bool2text($valBool)
	{
		$salida = "";

		if($valBool) {

			$salida = "Si";

		} else {

			$salida = "No";

		}

		return $salida;
	}

	/*============================================================================
	 *
	 *	Fecha
	 *
	============================================================================*/
	public static function Fecha($fecha)
	{
		$array = explode(" ", $fecha);
		$arrayFecha = explode("-", $array[0]);

		if(sizeof($array) == 1) {
			$salida = $arrayFecha[2] ."/". $arrayFecha[1] ."/". $arrayFecha[0];
		} else {
			$salida = $arrayFecha[2] ."/". $arrayFecha[1] ."/". $arrayFecha[0];
			$salida .= ' a las ';
			$salida .= $array[1];
		}
		
		return $salida;
	}

	/*============================================================================
	 *
	 *	Precio
	 *
	============================================================================*/
	public static function Precio($monto, $decimales = 2, $simbolo = "")
	{
		$precio = Formato::Numero($monto, $decimales);
		return $precio." ".$simbolo;
	}
}