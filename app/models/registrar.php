<?php
session_start();
require_once('../bd.php'); //Connect to db
require('Usuario.php');

//Campos introducidos en el form
$user = new Usuario($form['username'], $form['email'], $form['tlfn'] , $form['password']);

//Validar email & tlfn
$valid = TRUE;
$msg = "";
if (!filter_var($user->email, FILTER_VALIDATE_EMAIL)) {
    $valid = FALSE;
    $msg .= "email no valido\n";
}


//Comprobar si existe user,email,tlfn
$sql = $user->checkUser(); 
$existe = FALSE;

if ($valid and $resultado = $conn->query($sql)) { 
    if ($resultado->num_rows > 0) {
        $existe = TRUE;
        $msg = "Ya existe un usuario con ese ";
        //Comprobar cuales son los repetidos
        $user_fetched = $resultado->fetch_assoc();
        if($user_fetched['nombre'] == $user->nombre) $msg .= "nombre ";
        if($user_fetched['email'] == $user->email) $msg .= "email ";
        if($user_fetched['telefono'] == $user->telefono) $msg .= "telefono";
    } 
}

//Es valido y no existe
if($valid and !$existe){
    //Guardar img en server y session de la imagen
    $imgPath = saveImg("../profile_img/" , $user->nombre);
    $imgPath = empty($imgPath) ? "default_profile.jpg" : $imgPath; //Si no ponemos imagen o no es valida, nos selecciona una por defecto
    $user->imagen = $imgPath;
    //Query SQL
    $sql = $user->insertUser();
    
    if(!$existe && $conn->query($sql) === TRUE){
        $_SESSION['registrado'] = TRUE;
    }
}
else{
    //Mensajes de alerta saber que campo falla
    $_SESSION['fail_msg'] = $msg;
}

$conn->close();

?>