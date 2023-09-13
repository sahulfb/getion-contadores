<?php
/**
 * Incluir los elementos de una carpeta
 */
function IncluirCarpeta($ruta)
{
    if($ruta[ strlen($ruta) - 1 ] != "/") $ruta .= "/";
    
	$directorio = opendir($ruta);
	while($archivo = readdir($directorio))
	{
		if($archivo == '.' || $archivo == '..')
			continue;

		if(is_dir($ruta.$archivo))
		{
			IncluirCarpeta($ruta.$archivo."/");
			continue;
		}

		require_once($ruta.$archivo);
	}
}

/**
 * Verificar si la pagina (Controlador y metodo) existen
 */
function ExistePagina($controlador, $metodo)
{
	$pathControlador = BASE_DIR."/app/$controlador/controlador.php";
	if(!file_exists($pathControlador)) {
		return FALSE;
	}

	require_once($pathControlador);

	if(!class_exists("Controlador")) {
		return FALSE;
	}

	if(!method_exists("controlador", $metodo)) {
		return FALSE;
	}

	return TRUE;
}

/**
 * Enviar JSON con formato establecido
 */
function sendJson($data = []) {
	$json = [
		"error" => [
			"status" => FALSE,
			"mensaje" => ""
		],
		"body" => $data
	];
	echo json_encode($json);
}

/**
 * Validar fechas
 */
function validarFecha($date, $format = 'Y-m-d')
{
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) === $date;
}