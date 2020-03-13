<?php

    //Comprobar campos
    if (isset($_POST['submit_registrar'])) {

        //Secure input
        if (!empty($_POST['username']) and !empty($_POST['password']) and !empty($_POST['email']) and !empty($_POST['tlfn'])) {
            $username = secure_input($_POST['username']);
            $email = secure_input($_POST['email']);
            $tlfn = secure_input($_POST['tlfn']);
            //Hash password   
            $password = sha1($_POST['password']);
        }

        //Enviar datos al modelo
        $form = array(
            "username" => $username,
            "email" => $email,
            "tlfn" => $tlfn,
            "password" => $password,
        );

        require_once("../models/registrar.php");
      
        //si nos registra correctamente va a index
        if (isset($_SESSION['registrado']) and $_SESSION['registrado'] == TRUE) {
            unset($_SESSION['registrado']);
            header("Location: ../index.php");
        }
        //si no vuelve a registrar para mostrar un mensaje de error
        else{
            header("Location: ../registrar.php");
        }
    }

    function secure_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>