<?php
require('./includes/FormularioLogin.php');
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require('./includes/common/head.php')?>
    <title>Login</title>
</head>

<body>
    
        <?php
            require("./includes/common/cabecera.php");
        ?>
        <div class="contenido">
                <?php
                    $form= new FormularioLogin();
                    $form->gestiona();
                ?>
        </div>
    
</body>
