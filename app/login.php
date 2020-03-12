
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
                        
            <?php
               //Login prueba, acceder a base de datos segun el caso
                $username = "username";
                $password = "password";
                Echo "<form method='POST' action='./index.php'>";
                Echo "<div><input type='text' name=$username value='user'/></div>";
                Echo "<div><input type='text' name=$password value='userpass'/></div>";
                Echo "<div> <button type='submit' name='submit2' value='Enviar form.'> Entrar  </button></div>";
            ?>
        </div>


        

    </div> <!-- Fin del contenedor -->



</body>

