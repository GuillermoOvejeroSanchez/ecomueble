<?php
require_once __DIR__.'/Aplicacion.php';
//session_start();

ini_set('default_charset', 'UTF-8');
setLocale(LC_ALL, 'es_ES.UTF.8');
date_default_timezone_set('Europe/Madrid');


//TODO Cambiar puerto y usarlo mas adelante
const PORT = 3000;

const SERVERNAME = 'vm19.db.swarm.test';
const USER = 'ecomuebledb';
const PASS = 'ecomuebledb';
CONST DB = 'ecomuebledb';

const APP_DIR = __DIR__ . DIRECTORY_SEPARATOR;
const LOCAL = SERVERNAME . ":" . PORT . DIRECTORY_SEPARATOR;

CONST EN_VENTA = 0;
CONST VENDIDO = 1;
CONST RESERVADO = 2;

$app = Aplicacion::getSingleton();
$app->init(array('host'=>SERVERNAME, 'bd'=>DB, 'user'=>USER, 'pass'=>PASS));

register_shutdown_function(array($app, 'shutdown'));