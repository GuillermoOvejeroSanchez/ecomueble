<?php
require_once __DIR__.'/Aplicacion.php';
//session_start();

ini_set('default_charset', 'UTF-8');
setLocale(LC_ALL, 'es_ES.UTF.8');
date_default_timezone_set('Europe/Madrid');

/*define('BD_HOST', 'localhost');
define('BD_NAME', 'root');
define('BD_USER', '');
define('BD_PASS', 'ecomueble');
*/
const APP_DIR = __DIR__ . DIRECTORY_SEPARATOR;
const PORT = 3000;
const SERVERNAME = 'localhost';
const LOCAL = SERVERNAME . ":" . PORT . DIRECTORY_SEPARATOR;
const USER = 'root';
const PASS = '';
CONST DB = 'ecomueble';
CONST EN_VENTA = 0;
CONST VENDIDO = 1;
CONST RESERVADO = 2;

$aplicacion = Aplicacion::getSingleton();
$aplicacion->init(array('host'=>SERVERNAME, 'bd'=>DB, 'user'=>USER, 'pass'=>PASS));

register_shutdown_function(array($aplicacion, 'shutdown'));
?>