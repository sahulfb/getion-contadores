<?php
// Rutas
define("BASE_DIR", str_replace( "\\", "/", dirname(__DIR__) ));

// Datos del cliente
if(isset($_SERVER['REMOTE_ADDR'])) {
    define("IP_CLIENTE", ($_SERVER['REMOTE_ADDR'] == "::1") ? '127.0.0.1' : $_SERVER['REMOTE_ADDR']);
}

// Ruta del config.ini
define("CONFIG_INI", BASE_DIR."/config.ini");

/**
 * Definimos las constantes del archivo CONFIG.INI
 */

// Abrimos el archivo
try {
	$config = parse_ini_file(CONFIG_INI, TRUE);
} catch(Exception $e) {
	throw new Exception("Ocurrio un problema al intentar leer el archivo 'config.ini'.");
}

// Validamos
if(!isset($config['Sistema']['nombre'])) throw new Exception("[Config.ini] No existe [Sistema][nombre]");
if(!isset($config['Sistema']['version'])) throw new Exception("[Config.ini] No existe [Sistema][version]");
if(!isset($config['Sistema']['key_sesion'])) throw new Exception("[Config.ini] No existe [Sistema][key_sesion]");
if(!isset($config['Sistema']['produccion'])) throw new Exception("[Config.ini] No existe [Sistema][produccion]");

if(!isset($config['Desarrollo']['db.servidor'])) throw new Exception("[Config.ini] No existe [Desarrollo][db.servidor]");
if(!isset($config['Desarrollo']['db.puerto'])) throw new Exception("[Config.ini] No existe [Desarrollo][db.puerto]");
if(!isset($config['Desarrollo']['db.usuario'])) throw new Exception("[Config.ini] No existe [Desarrollo][db.usuario]");
if(!isset($config['Desarrollo']['db.clave'])) throw new Exception("[Config.ini] No existe [Desarrollo][db.clave]");
if(!isset($config['Desarrollo']['db.nombre'])) throw new Exception("[Config.ini] No existe [Desarrollo][db.nombre]");
if(!isset($config['Desarrollo']['base_url'])) throw new Exception("[Config.ini] No existe [Desarrollo][base_url]");

if(!isset($config['Produccion']['db.servidor'])) throw new Exception("[Config.ini] No existe [Produccion][db.servidor]");
if(!isset($config['Produccion']['db.puerto'])) throw new Exception("[Config.ini] No existe [Produccion][db.puerto]");
if(!isset($config['Produccion']['db.usuario'])) throw new Exception("[Config.ini] No existe [Produccion][db.usuario]");
if(!isset($config['Produccion']['db.clave'])) throw new Exception("[Config.ini] No existe [Produccion][db.clave]");
if(!isset($config['Produccion']['db.nombre'])) throw new Exception("[Config.ini] No existe [Produccion][db.nombre]");
if(!isset($config['Produccion']['base_url'])) throw new Exception("[Config.ini] No existe [Produccionlo][base_url]");

/*============================================================================
*
* Generamos
* 
============================================================================*/
try
{
    define("SISTEMA", [
        "nombre" => $config['Sistema']['nombre'],
        "version" => $config['Sistema']['version'],
        "key_sesion" => $config['Sistema']['key_sesion']
    ]);

    define("PRODUCCION", $config['Sistema']['produccion']);

    $fase = (PRODUCCION) ? 'Produccion' : 'Desarrollo';
    
    define('BASE_URL', $config[$fase]['base_url']);

    define("ARRAY_BASE_DATOS", [
        'host' => $config[$fase]['db.servidor'],
        'port' => $config[$fase]['db.puerto'],
        'username' => $config[$fase]['db.usuario'],
        'user' => $config[$fase]['db.usuario'],
        'password' => $config[$fase]['db.clave'],
        'pass' => $config[$fase]['db.clave'],
        'db' => $config[$fase]['db.nombre'],
        'charset' => 'utf8'
    ]);
}
catch(Exception $e)
{
    throw new Exception("Ocurrio un problema al definir las constantes: {$e->getMessage()}");
}