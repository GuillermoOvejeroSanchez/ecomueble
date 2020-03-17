<?php
session_start();
require_once('../bd.php'); //Connect to db

//Campos introducidos en el form
$username = $form['username']; 
$email = $form['email'];
$tlfn = $form['tlfn'];
$password = $form['password'];

//Validar email & tlfn
$valid = TRUE;
$msg = "";
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $valid = FALSE;
    $msg .= "email no valido\n";
}


//Comprobar si existe user,email,tlfn
$sql1 = "SELECT nombre, email, telefono FROM usuario WHERE nombre = '$username' OR email = '$email' OR telefono = '$tlfn'";
$existe = FALSE;

if ($valid and $resultado = $conn->query($sql1)) { 
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

if($valid){

    //Guardar img en server y session de la imagen
    $imgPath = saveImg("../profile_img/" , $username);
    $imgPath = empty($imgPath) ? "default_profile.jpg" : $imgPath; //Si no ponemos imagen o no es valida, nos selecciona una por defecto
    $user->imagen = $imgPath;
    //Query SQL
    $sql = $user->createUser();
    
    //Query SQL
    $sql = "INSERT INTO usuario (nombre, email, password, telefono, imagen)
        VALUES ('$username', '$email', '$password', '$tlfn', '$imgPath')";


    if(!$existe && $conn->query($sql) === TRUE){
        $_SESSION['registrado'] = TRUE;
        $_SESSION['profile_pic'] = $imgPath;

    }
}else{
    //Mensajes de alerta saber que campo falla
    $_SESSION['fail_msg'] = $msg;
}

$conn->close();

?>