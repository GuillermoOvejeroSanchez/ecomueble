<?php
require('./includes/FormularioLogin.php');
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require('./includes/common/head.php')?>

    <script type="text/javascript" src="/js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="/js/functions.js"></script>
    <script type="text/javascript">   
        $(document).ready(function() {
            $("#ok1").hide();
            $("#error1").hide();
            $("#ok2").hide();
            $("#error2").hide();
            $usernameOk = false;
            $passOk = false;
            
            $("#username").change(function() {
                if ( usernameCheck($("#username").val()) ) {
                    $("#error1").hide();
                    $("#ok1").show();
                    $usernameOk = true;
                } else {
                    $("#ok1").hide();
                    $("#error1").show();
                    $("#username").focus();
                    $usernameOk = false;
                }
            });

            $("#pass").change(function() {
                if ( passwordCheck($("#pass").val()) ) {
                    $("#error2").hide();
                    $("#ok2").show();
                    $passOk = true;
                } else {
                    $("#ok2").hide();
                    $("#error2").show();
                    $("#pass").focus();
                    $passOk = false;
                }
            });
            
            $("#submit_login").click(function( event ) {
                if($usernameOk && $passOk){
                    $.post("login.php", $('form#loginForm').serialize());
                }
                else {
                    alert("Corrija los campos erróneos.");
                    event.preventDefault();
                }
            });
        });
    </script>

    <title>Login</title>
</head>

<body>
    
        <?php
            require("./includes/common/cabecera.php");
        ?>
        <div class="contenido">
            <?php
                formularioLogin();
            ?>
        </div>
    
</body>
