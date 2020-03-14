<?php
session_start();
require_once('../bd.php'); //Connect to db

//Campos introducidos en el form
$username = $form['username']; 
$email = $form['email'];
$tlfn = $form['tlfn'];
$password = $form['password'];
$imagen = $form['imagen'];

//Comprobar si existe user,email,tlfn
$sql1 = "SELECT nombre, email, telefono FROM usuario WHERE nombre = '$username' OR email = '$email' OR telefono = '$tlfn'";
$existe = FALSE;

if ($resultado = $conn->query($sql1)) { 
    if ($resultado->num_rows > 0 and $resultado->num_rows === 1) {
        $existe = TRUE;
        $msg = "Ya existe un usuario con ese ";
        //Comprobar cuales son los repetidos
        $user_fetched = $resultado->fetch_assoc();
        if($user_fetched['nombre'] == $username) $msg .= "nombre ";
        if($user_fetched['email'] == $email) $msg .= "email ";
        if($user_fetched['telefono'] == $tlfn) $msg .= "telefono";
    } 
}
//Mensajes de alerta saber que campo falla

//Query SQL
$sql = "INSERT INTO usuario (nombre, email, password, telefono, imagen)
VALUES ('$username', '$email', '$password', '$tlfn', '$imagen')";


if(!$existe && $conn->query($sql) === TRUE){
    $_SESSION['registrado'] = TRUE;
}
else{
    $_SESSION['fail_msg'] = $msg;
}

$conn->close();

?>