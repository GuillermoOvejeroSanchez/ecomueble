<?php
require('../includes/config.php');

$user = USER;
$pass = PASS;
$host = SERVERNAME;
$db_name = DB;
$script_path = __DIR__;

$command = 'mysql'
    . ' --host=' . $host
    . ' --user=' . $user
    . ' --password=' 
    . ' --database=' . $db_name
    . ' --execute="SOURCE ' . $script_path
;


$conn = new mysqli(SERVERNAME, USER, PASS) or die("Connection failed");

$conn->query("DROP DATABASE ecomueble");
$conn->query("CREATE DATABASE ecomueble");


$conn = new mysqli(SERVERNAME, USER, PASS, DB) or die("Connection failed");
$output = shell_exec($command . '/ecomueble.sql'); //Crear BD
$output = shell_exec($command . '/populate_ecomueble.sql'); //Poblar BD

$conn->close();