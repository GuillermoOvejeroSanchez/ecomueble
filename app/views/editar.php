<?php
require_once('./includes/FormularioEditar.php');
require_once('./includes/Usuario.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require('./includes/common/head.php')?>
    <title>Editar</title>
</head>

<body>
    <?php
        require('./includes/common/cabecera.php');
        $logged;
        $logged = isset($_SESSION['login']) ? TRUE : FALSE;

        if($logged){
            $form = new FormularioEditar();
            $form->gestiona();
        }
        ?>
</body>

</html>