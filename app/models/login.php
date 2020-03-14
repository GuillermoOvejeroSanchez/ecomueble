<?php
session_start();
require_once('../bd.php'); //Connect to db

//Campos introducidos en el form
$username = $form['username']; 
$password = $form['password'];

//Comprobar si existe user,email,tlfn
$sql1 = "SELECT idUsuario, nombre, tipoUsuario, saldo, imagen FROM usuario WHERE password = '$password' AND (nombre = '$username' OR email = '$username')";
$existe = FALSE;

if ($resultado = $conn->query($sql1)) { 
    if ($resultado->num_rows > 0 and $resultado->num_rows === 1) {
        $existe = TRUE;
        $user_fetched = $resultado->fetch_assoc();
        $_SESSION['login'] = TRUE;
        $_SESSION['username'] = $user_fetched['nombre'];
        $_SESSION['saldo'] = $user_fetched['saldo'];
        $_SESSION['profile_pic'] = $user_fetched['imagen'];
        
        if ($user_fetched['tipoUsuario'] == 1) {
            $_SESSION['admin'] = TRUE;
        }
    } 
}

$conn->close();

?>