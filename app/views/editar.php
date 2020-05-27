<?php
require_once('./includes/FormularioEditar.php');
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
            $("#ok5").hide();
            $("#error5").hide();
            $("#ok6").hide();
            $("#error6").hide();
            $usernameOk = true;
            $emailOk = true;
            $tlfnOk = true;
            $oldPassOk = false;
            $pass1Ok = false;
            $pass2Ok = false;

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

            $("#oldPass").change(function() {
                //Comprobamos que la password cumpla los requisitos mínimos
                if ( passwordCheck($("#oldPass").val()) ) {
                    $("#error4").hide();
                    $("#ok4").show();
                    $oldPassOk = true;
                } else {
                    $("#ok4").hide();
                    $("#error4").show();
                    $("#oldPass").focus();
                    $oldPassOk = false;
                }
            });

            $("#newpass1").change(function() {
                //Comprobamos que la password cumpla los requisitos mínimos
                if ( passwordCheck($("#newpass1").val()) ) {
                    $("#error5").hide();
                    $("#ok5").show();
                    $pass1Ok = true;
                } else {
                    $("#ok5").hide();
                    $("#error5").show();
                    $("#newpass1").focus();
                    $pass1Ok = false;
                }
            });

            $("#newpass2").change(function() {
                //Comprobamos que la password cumpla los requisitos mínimos
                if ( passwordCheck($("#newpass2").val()) && newPasswordCheck($("#newpass1").val(), $("#newpass2").val())) {
                    $("#error6").hide();
                    $("#ok6").show();
                    $pass2Ok = true;
                } else {
                    $("#ok6").hide();
                    $("#error6").show();
                    $("#newpass2").focus();
                    $pass2Ok = false;
                }
            });
            
            $("#submit_editar").click(function( event ) {
                if($usernameOk && $emailOk && $tlfnOk && $oldPassOk && $pass1Ok && $pass2Ok){
                    $.post("editar.php", $('form#formEditar').serialize());
                }
                else {
                    alert("Corrija los campos erróneos.");
                    event.preventDefault();
                }
            });
        });
    </script>

    <title>Editar</title>
</head>

<body>
    <?php
        require('./includes/common/cabecera.php');
        $logged;
        $logged = isset($_SESSION['login']) ? TRUE : FALSE;
        ?>
        <div class="contenido"> <?php
        if($logged){
            formularioEditar();
        }
        ?>
        </div>
</body>

</html>