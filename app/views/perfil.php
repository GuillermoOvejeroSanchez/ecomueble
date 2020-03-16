<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require('./common/head.php')?>
    <title>Perfil <?php echo getName();?></title>
</head>

<body>
    <?php
        require('./common/cabecera.php');
        require('./controllers/perfil.php');
    ?>
  
</body>

</html>

<?php

function getName()
{
    return isset($_SESSION['username']) ? $_SESSION['username'] : "";
}

?>
