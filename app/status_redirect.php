<?php

if(isset($_REQUEST['login_btn'])) {
    header("Location: login");
}

elseif (isset($_REQUEST['registrar_btn'])) {
    header("Location: registrar");
}

elseif (isset($_REQUEST['logout_btn'])) {
    session_start();
    unset($_SESSION['username']);
    unset($_SESSION['login']);
    session_destroy();
    header("Location: /");
}
elseif (isset($_REQUEST['subirProducto'])) {
    header("Location: subir");
}
elseif (isset($_REQUEST['editarPerfil'])) {
    header("Location: editar");
}else {
    header("Location: 404");
}
die();
?>