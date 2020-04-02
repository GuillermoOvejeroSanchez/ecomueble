<?php
session_start();
require_once('./bd.php'); //Connect to db
require('Usuario.php');

//Campos introducidos en el form
$user = new Usuario();
$user->nombre = $form['username'];
$user->password = $form['password'];

//Comprobar si existe user,email,tlfn
$sql = $user->logUser();

if ($resultado = $conn->query($sql)) { 
    if ($resultado->num_rows > 0 and $resultado->num_rows === 1) {
        $user_fetched = $resultado->fetch_assoc();
        $ok = password_verify($user->password, $user_fetched['password']); 
        if ($ok) {
            $_SESSION['login'] = TRUE;
            $_SESSION['username'] = $user_fetched['nombre'];
            $_SESSION['saldo'] = $user_fetched['saldo'];
            $_SESSION['profile_pic'] = $user_fetched['imagen'];
            $_SESSION['idUsuario'] = $user_fetched['idUsuario'];
            
            if ($user_fetched['tipoUsuario'] == 1) {
                $_SESSION['admin'] = TRUE;
            }
        }
    } 
}

$conn->close();

?>