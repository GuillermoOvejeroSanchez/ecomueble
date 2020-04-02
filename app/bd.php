<?php
function connBD()
{
    $conn = new mysqli(SERVERNAME, USER, PASS, DB) or die("Connection failed");
    return $conn;
}
?>