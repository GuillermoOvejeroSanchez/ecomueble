<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require('./includes/common/head.php')?>
    <title>Perfil <?php echo getName();?></title>
</head>

<body>
    <?php
        require('./includes/common/cabecera.php');
        require('./controllers/perfil.php');
    ?>

</body>

</html>

<?php

function getName()
{
    return isset($_SESSION['username']) ? $_SESSION['username'] : "";
}
