<?php
    //Comprobar campos
    if (isset($_POST['submit_login'])) {

        //Secure input
        if (!empty($_POST['username']) and !empty($_POST['password'])) {
            $username = secure_input($_POST['username']);
            $password = $_POST['password'];
        }

        //Enviar datos al modelo
        $form = array(
            "username" => $username,
            "password" => $password,
        );

        require_once("../models/login.php");

        //si nos registra correctamente va a index
        if (isset($_SESSION['login']) and $_SESSION['login'] == TRUE) {
            header("Location: /");
        }
        //si no vuelve a login para mostrar un mensaje de error
        else{
            header("Location: /login");
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