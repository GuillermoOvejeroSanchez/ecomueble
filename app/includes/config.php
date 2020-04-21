<?php
session_start();

ini_set('default_charset', 'UTF-8');
setLocale(LC_ALL, 'es_ES.UTF.8');
date_default_timezone_set('Europe/Madrid');

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

?>