<?php
$servername = 'localhost';
$user = 'root';
$pass = '';
$db = 'test';

$conn = new mysqli($servername, $user, $pass, $db) or die("Connection failed");
echo "Connected";
?>