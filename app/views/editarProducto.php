<?php
require_once('./includes/FormularioEditarProducto.php');
require_once('./includes/Producto.php');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require('./includes/common/head.php')?>
    <title>Editar Producto</title>
</head>

<body>
    <?php
        require('./includes/common/cabecera.php');
        $logged;
        $logged = isset($_SESSION['login']) ? TRUE : FALSE;
        ?>
        <div class="contenido"> <?php
        if($logged){

            $form = new FormularioEditarProducto($_GET['id']);
            $form->gestiona();
        }
        ?>
        </div>
</body>

</html>