<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require('./common/head.php')?>
    <title>Subir producto</title>
</head>

<body>
<div id="contenedor">
        <?php
            require("./common/cabecera.php");
        ?>
        <div class="contenido">
        <?php
            echo '<form action="../controllers/subir.php" method="post" enctype="multipart/form-data">';
                if (isset($_SESSION['fail_msg'])) {
                    echo '<div>'.$_SESSION['fail_msg'].'</div>';
                }
                unset($_SESSION['fail_msg']);
            ?>
                <div><input type='text' name='productname' placeholder='Nombre del producto' required /></div>
                <div><input type='text' name='description' placeholder='Breve Descripcion'/></div>
                <div><input type='text' name='price' placeholder='Precio' required /></div>
                <div><input type='text' name='categoria' placeholder='Categoria' required /></div>
                <div><input type='file' name='imagen' placeholder='Inserte imagen'/></div>
                <div> <button type='submit' name='submit_producto'>Entrar</button></div>
            </form>

        </div>
    </div> <!-- Fin del contenedor -->
</body>

</html>