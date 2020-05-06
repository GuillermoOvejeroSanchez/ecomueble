<?php
require_once('./includes/FormularioRegistro.php');
?>  

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require('./includes/common/head.php')?>
    <title>Registrar</title>
</head>

<body>
   
        <?php
            require("./includes/common/cabecera.php");
        ?>
        <div class="contenido">
            <?php
                if (isset($_SESSION['fail_msg'])) {
                    echo '<div>'.$_SESSION['fail_msg'].'</div>';
                }
                unset($_SESSION['fail_msg']);
                $form = new FormularioRegistro();
                $form->gestiona();
            ?>
        </div>
  
</body>
