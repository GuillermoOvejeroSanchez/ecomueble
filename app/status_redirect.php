<?php
if(isset($_REQUEST['login_btn'])) {
    header("Location: login");
}

elseif (isset($_REQUEST['registrar_btn'])) {
    header("Location: registrar");
}


elseif (isset($_REQUEST['logout_btn'])) {
   /* session_start();
    unset($_SESSION['username']);
    unset($_SESSION['login']);
    unset($_SESSION['saldo']);
    unset($_SESSION['profile_pic']);
    unset($_SESSION['idUsuario']);
    session_destroy();*/
    header("Location: logout");
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