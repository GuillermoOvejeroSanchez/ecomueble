<?php
    require('../includes/config.php');
    require('../includes/Usuario.php');
    
    $result = "";

    /***** COMPROBACIONES AL REGISTRAR USUARIO *****/
    if(isset($_REQUEST["usernameReg"])) {
        $usernameCheck = $_REQUEST["usernameReg"];
        //Comprobar si existe user
        if(Usuario::checkUsername($usernameCheck, "reg") != "") {   
            $result = Usuario::checkUsername($usernameCheck, "reg"); 
        }
    }

    if(isset($_REQUEST["emailReg"])) {
        $emailCheck = $_REQUEST["emailReg"];
        //Comprobar si existe email
        if(Usuario::checkEmail($emailCheck, "reg") != "") {
            $result = Usuario::checkEmail($emailCheck, "reg"); 
        }
    }

    if(isset($_REQUEST["tlfnReg"])) {
        $tlfnCheck = $_REQUEST["tlfnReg"];
        //Comprobar si existe tlfn
        if(Usuario::checkTlfn($tlfnCheck, "reg") != "") {
            $result = Usuario::checkTlfn($tlfnCheck, "reg"); 
        }
    }

    /***** COMPROBACIONES AL EDITAR PERFIL *****/
    if(isset($_REQUEST["usernameEdit"])) {
        $usernameCheck = $_REQUEST["usernameEdit"];
        //Comprobar si existe user
        if(Usuario::checkUsername($usernameCheck, "edit") != "") {   
            $result = Usuario::checkUsername($usernameCheck, "edit"); 
        }
    }

    if(isset($_REQUEST["emailEdit"])) {
        $emailCheck = $_REQUEST["emailEdit"];
        //Comprobar si existe email
        if(Usuario::checkEmail($emailCheck, "edit") != "") {
            $result = Usuario::checkEmail($emailCheck, "edit"); 
        }
    }

    if(isset($_REQUEST["tlfnEdit"])) {
        $tlfnCheck = $_REQUEST["tlfnEdit"];
        //Comprobar si existe tlfn
        if(Usuario::checkTlfn($tlfnCheck, "edit") != "") {
            $result = Usuario::checkTlfn($tlfnCheck, "edit"); 
        }
    }

    echo $result;
