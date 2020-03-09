<?php

//Login prueba, acceder a base de datos segun el caso
session_start();

if(isset($_REQUEST['login'])) {
    $_SESSION['user'] = 'User';
}

elseif (isset($_REQUEST['registrar'])) {
    $_SESSION['user'] = 'Admin';
}

elseif (isset($_REQUEST['logout'])) {
    unset($_SESSION['user']);
    session_destroy();
}

header("Location: ./index.php");
die();
?>