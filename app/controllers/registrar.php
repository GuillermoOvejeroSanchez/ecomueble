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

        header("Location: ../index.php");
    }

    function secure_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>