<?php session_start(); ?>


<?php

//Login prueba, acceder a base de datos segun el caso
    $username = "username";
    $password = "password";
    Echo "<form method='POST' action='./index.php'>";
    Echo "<div><input type='text' name=$username value='user'/></div>";
    Echo "<div><input type='text' name=$password value='userpass'/></div>";
    Echo "<div> <button type='submit' name='submit2' value='Enviar form.'> Entrar  </button></div>";

/*if(isset($_REQUEST['login'])) {
    $_SESSION['user'] = 'User';
}

elseif (isset($_REQUEST['registrar'])) {
    $_SESSION['user'] = 'Admin';
}

elseif (isset($_REQUEST['logout'])) {
    unset($_SESSION['user']);
    session_destroy();
}
*/
//header("Location: ./index.php"); 
die();
?>