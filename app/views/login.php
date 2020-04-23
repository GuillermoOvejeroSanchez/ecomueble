<?php
require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/FormularioLogin';
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require('./common/head.php')?>
    <title>Login</title>
</head>

<body>
    <div id="contenedor">
        <?php
            require("./common/cabecera.php");
            
        ?>
        <div class="contenido">
            <form action='loginForm' method="post">
                <?php
                    $form=new FormularioLogin();
                    $form->gestiona();
                ?>
                <!--<div><input type='text' name='username' placeholder='nombre usuario o email' required /></div>
                <div><input type='password' name='password' placeholder='contraseña' required /></div>
                <div> <button type='submit' name='submit_login'>Entrar</button></div>-->
            </form>

        </div>
    </div> <!-- Fin del contenedor -->
</body>
