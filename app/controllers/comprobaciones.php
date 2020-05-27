<?php
    require_once('../includes/config.php');
    require('../includes/Usuario.php');
    
    $result = "";

    if(isset($_REQUEST["username"])) {
        $usernameCheck = $_REQUEST["username"];
        //Comprobar si existe user
        if(Usuario::checkUsername($usernameCheck) != "") {   
            $result = Usuario::checkUsername($usernameCheck); 
        }
    }

    if(isset($_REQUEST["email"])) {
        $emailCheck = $_REQUEST["email"];
        //Comprobar si existe email
        if(Usuario::checkEmail($emailCheck) != "") {
            $result = Usuario::checkEmail($emailCheck); 
        }
    }

    if(isset($_REQUEST["tlfn"])) {
        $tlfnCheck = $_REQUEST["tlfn"];
        //Comprobar si existe tlfn
        if(Usuario::checkTlfn($tlfnCheck) != "") {
            $result = Usuario::checkTlfn($tlfnCheck); 
        }
    }

    echo $result;
