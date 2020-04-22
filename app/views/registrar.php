<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require('./common/head.php')?>
    <title>Registrar</title>
</head>

<body>
    <div id="contenedor">
        <?php
            require("./common/cabecera.php");
        ?>
        <div class="contenido">
            <?php
            echo '<form action="registerForm" method="post" enctype="multipart/form-data">';
                if (isset($_SESSION['fail_msg'])) {
                    echo '<div>'.$_SESSION['fail_msg'].'</div>';
                }
                unset($_SESSION['fail_msg']);
            ?>
                <!--<div><input type='text' name='username' placeholder='Nombre usuario' required /></div>
                <div><input type='text' name='email' placeholder='Email' required /></div>
                <div><input type='text' name='tlfn' placeholder='Telefono' required /></div>
                <div><input type='password' name='password' placeholder='Contraseña' required /></div>
                <div><input type='file' name='imagen' placeholder='Inserte imagen' /></div>
                <div> <button type='submit' name='submit_registrar'>Entrar</button></div>-->
            </form>

        </div>
    </div> <!-- Fin del contenedor -->
</body>
