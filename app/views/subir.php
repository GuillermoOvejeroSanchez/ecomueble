<?php
require_once('./includes/FormularioSubir.php');
?> 

<!DOCTYPE html>
<html>

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
                $form = new FormularioSubir();
                $form->gestiona();


            ?>

            <!--
		    -->
            </form>

        </div>
    </div> <!-- Fin del contenedor -->
</body>

</html>