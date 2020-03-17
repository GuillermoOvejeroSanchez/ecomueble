<?php
session_start();
require_once('../bd.php'); //Connect to db
require('Usuario.php');

//Campos introducidos en el form
$user = new Usuario();
$user->nombre = $form['username'];
$user->password = $form['password'];

echo $user->nombre;

//Comprobar si existe user,email,tlfn
$sql = $user->logUser();
$existe = FALSE;

if ($resultado = $conn->query($sql)) { 
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