<?php
require_once('config.php');
$GLOBALS['conn'] = new mysqli(SERVERNAME, USER, PASS, DB) or die("Connection failed");
//echo "Connected";
?>