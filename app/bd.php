<?php
require_once('config.php');
$conn = new mysqli(SERVERNAME, USER, PASS, DB) or die("Connection failed");
//$GLOBALS['conn'] = $conn;
?>