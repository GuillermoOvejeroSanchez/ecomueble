<?php
require_once('./includes/FormularioRegistro.php');
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
            $("#ok3").hide();
            $("#error3").hide();
            $("#ok4").hide();
            $("#error4").hide();
            $usernameOk = false;
            $emailOk = false;
            $tlfnOk = false;
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

            $("#email").change(function() {
                if ( emailCheck($("#email").val()) ) {
                    $("#error2").hide();
                    $("#ok2").show();
                    $emailOk = true;
                } else {
                    $("#ok2").hide();
                    $("#error2").show();
                    $("#email").focus();
                    $emailOk = false;
                }
            });

            $("#tlfn").change(function() {
                if ( telefonoCheck($("#tlfn").val()) ) {
                    $("#error3").hide();
                    $("#ok3").show();
                    $tlfnOk = true;
                } else {
                    $("#ok3").hide();
                    $("#error3").show();
                    $("#tlfn").focus();
                    $tlfnOk = false;
                }
            });

            $("#pass").change(function() {
                if ( passwordCheck($("#pass").val()) ) {
                    $("#error4").hide();
                    $("#ok4").show();
                    $passOk = true;
                } else {
                    $("#ok4").hide();
                    $("#error4").show();
                    $("#pass").focus();
                    $passOk = false;
                }
            });
            
            $("#submit_registrar").click(function( event ) {
                if($usernameOk && $emailOk && $tlfnOk && $passOk){
                    $.post("registrar.php", $('form#formRegistro').serialize());
                }
                else {
                    alert("Corrija los campos erróneos.");
                    event.preventDefault();
                }
            });
        });
    </script>

    <title>Registrar</title>
</head>

<body>
   
        <?php
            require("./includes/common/cabecera.php");
        ?>
        <div class="contenido">
            <?php
                if (isset($_SESSION['fail_msg'])) {
                    echo '<div>'.$_SESSION['fail_msg'].'</div>';
                }
                unset($_SESSION['fail_msg']);
                formularioRegistro();
                ?>

        </div>
  
</body>
