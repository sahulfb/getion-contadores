<?php

function setHandlerJson() {
    set_exception_handler("ExceptionAJAX");
    set_error_handler("ErrorAJAX");
}

/*--------------------------------------------------------------------------------
 * Exception
--------------------------------------------------------------------------------*/
function ExceptionAJAX($exception)
{
    $codigo = $exception->getCode();
    $mensaje = $exception->getMessage();
    $archivo = $exception->getFile();
    $linea = $exception->getLine();
    $trazas = $exception->getTrace();

    showErrorJSON($codigo, $mensaje, $archivo, $linea, $trazas);
}

/*--------------------------------------------------------------------------------
 * Error
--------------------------------------------------------------------------------*/
function ErrorAJAX($codigo, $mensaje, $archivo = "", $linea = "", $context = "")
{
    showErrorJSON($codigo, $mensaje, $archivo, $linea, []);
}

/*--------------------------------------------------------------------------------
 * Mostrar errores en forma de JSON
--------------------------------------------------------------------------------*/
function showErrorJSON($codigo, $mensaje, $archivo, $linea, $trazas) {
    $respuesta = [
        "error" => [
            "status" => TRUE,
            "mensaje" => $mensaje
        ],
        "body" => [
            "codigo" => $codigo,
            "mensaje" => $mensaje,
            "archivo" => $archivo,
            "linea" => $linea,
            "trazas" => $trazas
        ]
    ];

    echo json_encode( $respuesta );
    exit;
}