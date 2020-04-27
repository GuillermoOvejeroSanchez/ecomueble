<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require('./includes/common/head.php')?>
    <title>Subir producto</title>
</head>

<body>
    <div id="contenedor">
        <?php
            require("./includes/common/cabecera.php");
        ?>
        <div class="contenido">
            <?php
            echo '<form action="subirForm" method="post" enctype="multipart/form-data" id="product_form">';
                if (isset($_SESSION['fail_msg'])) {
                    echo '<div>'.$_SESSION['fail_msg'].'</div>';
                }
                unset($_SESSION['fail_msg']);
            ?>
            <div><input type='text' name='nombre' placeholder='Nombre del producto' required /></div>
            <div><input type='text' name='description' placeholder='Breve Descripcion' /></div>
            <div><input type='text' name='price' placeholder='Precio' required /></div>
            <div><input type='file' name='imagen' placeholder='Inserte imagen' /></div>
            <!--<div><input type='text' name='categoria' placeholder='Categoria' required /></div>-->
            <label for="categoria">Elige una categoria:</label>
            <select id="categoria" name="categoria" form="product_form">
            <?php
                require('./controllers/subir.php');
                $arrayTags = getTags();
                foreach ($arrayTags as $key => $value) {
                    echo '<option value="'.$key.'">'.$value.'</option>';
                }
                ?>
            </select>
            <div> <button type='submit' name='submit_producto'>Subir Producto</button></div>
            </form>

        </div>
    </div> <!-- Fin del contenedor -->
</body>

</html>