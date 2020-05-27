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
                //Comprobamos que el nombre de usuario cumpla los requisitos mínimos
                if ( usernameCheck($("#username").val()) ) {
                    //Comprobamos que no exista un usuario con ese nombre
                    var url="./controllers/comprobaciones.php?username=" + $("#username").val();
                    $.get(url, function(response, status) {
                        if(response != "") {
                            alert("Error: " + response);
                            $("#ok1").hide();
                            $("#error1").show();
                            $("#username").focus();
                            $usernameOk = false;
                        }
                        else {
                            $("#error1").hide();
                            $("#ok1").show();
                            $usernameOk = true;
                        }
                    });
                }
            });

            $("#email").change(function() {
                //Comprobamos que el email cumpla los requisitos mínimos
                if ( emailCheck($("#email").val()) ) {
                    //Comprobamos que no exista un usuario con ese email
                    var url="./controllers/comprobaciones.php?email=" + $("#email").val();
                    $.get(url, function(response, status) {
                        if(response != "") {
                            alert("Error: " + response);
                            $("#ok2").hide();
                            $("#error2").show();
                            $("#email").focus();
                            $emailOk = false;
                        } else {
                            $("#error2").hide();
                            $("#ok2").show();
                            $emailOk = true;
                        }
                    });
                }
            });

            $("#tlfn").change(function() {
                //Comprobamos que el teléfono cumpla los requisitos mínimos
                if ( telefonoCheck($("#tlfn").val()) ) {
                    //Comprobamos que no exista un usuario con ese teléfono
                    var url="./controllers/comprobaciones.php?tlfn=" + $("#tlfn").val();
                    $.get(url, function(response, status) {
                        if(response != "") {
                            alert("Error: " + response);
                            $("#ok3").hide();
                            $("#error3").show();
                            $("#tlfn").focus();
                            $tlfnOk = false;
                        } else {
                            $("#error3").hide();
                            $("#ok3").show();
                            $tlfnOk = true;
                        }
                    });
                }
            });

            $("#pass").change(function() {
                //Comprobamos que la password cumpla los requisitos mínimos
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
