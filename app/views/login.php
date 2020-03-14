<?php

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
            if (isset($_SESSION['fail_msg'])) {
                echo '<h2>'.$_SESSION['fail_msg'].'</h2>';
            }
            unset($_SESSION['fail_msg']);
        ?>
        <div class="contenido">
            <form action='../controllers/login.php' method="post">
                <div><input type='text' name='username' placeholder='nombre usuario o email' required /></div>
                <div><input type='password' name='password' placeholder='contraseña' required /></div>
                <div> <button type='submit' name='submit_login'>Entrar</button></div>
            </form>

        </div>
    </div> <!-- Fin del contenedor -->
</body>
