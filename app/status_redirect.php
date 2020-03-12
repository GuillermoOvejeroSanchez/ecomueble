<?php

if(isset($_REQUEST['login_btn'])) {
    header("Location: ./login.php");
}

elseif (isset($_REQUEST['registrar_btn'])) {
    header("Location: ./registrar.php");
}

elseif (isset($_REQUEST['logout_btn'])) {
    session_start();
    unset($_SESSION['username']);
    unset($_SESSION['login']);
    session_destroy();
    header("Location: ./index.php");
}
die();
?>