<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require('head.php')?>
    <title>Login</title>
</head>

<body>
    <div id="contenedor">


        <?php
            require("cabecera.php");
        ?>


        <div id="contenido">
            <form action="../controllers/registrar.php" method="post">
                <div><input type='text' name='username' placeholder='Nombre usuario' required /></div>
                <div><input type='text' name='email' placeholder='Email' required /></div>
                <div><input type='text' name='tlfn' placeholder='Telefono' required /></div>
                <div><input type='password' name='password' placeholder='Contraseña' required /></div>
                <div> <button type='submit' name='submit_registrar'>Entrar</button></div>
            </form>

        </div>




    </div> <!-- Fin del contenedor -->



</body>