<?php
require('config.php');
$conn = new mysqli(SERVERNAME, USER, PASS, DB) or die("Connection failed");
echo "Connected";
?>