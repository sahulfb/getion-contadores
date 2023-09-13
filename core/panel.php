<?php
require_once(BASE_DIR."/vendor/autoload.php");
IncluirCarpeta(BASE_DIR."/core/utils");
IncluirCarpeta(BASE_DIR."/core/models");

Conexion::conectar();
Sesion::Iniciar();
Peticion::Analizar();

FacturasModel::VerificarFechaVencimiento();
TareasModel::VerificarFechaVencimiento();

$controlador = Peticion::getControlador();
$metodo = Peticion::getMetodo();
$parametros = Peticion::getParametros();

$accesoSesion = Sesion::Validar();

if($accesoSesion === FALSE && $controlador != "login") {
    header('Location: '.BASE_URL."/Login/");
}

if($controlador == 'login' && $accesoSesion) {
    header('Location: '.BASE_URL);
}

if( ExistePagina($controlador, $metodo) === FALSE ) {
    echo "La pagina no existe.";
    exit;
}

$controlador = new Controlador();
$controlador->$metodo($parametros);