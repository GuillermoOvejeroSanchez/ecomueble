<?php

if(isset($_REQUEST['login_btn'])) {
    header("Location: ./views/login.php");
}

elseif (isset($_REQUEST['registrar_btn'])) {
    header("Location: ./views/registrar.php");
}

elseif (isset($_REQUEST['logout_btn'])) {
    session_start();
    unset($_SESSION['user']);
    session_destroy();
    header("Location: ./index.php");
}
die();
?>