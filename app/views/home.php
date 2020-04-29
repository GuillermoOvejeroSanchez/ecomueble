<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require('./includes/common/head.php')?>
    <title>Ecomueble</title>
</head>

<body>
    <?php
        require('./includes/common/cabecera.php');
        require('./controllers/home.php');

        echo"
        <table>
            <tr>
                <th class='ini'> Productos </th>
                <th class='ini'> Usuarios </th> 
            </tr> 
            <tr> 
                <th class='productosInicio'>";
                mostrarXProductos(10);
                echo " </th> 

                <th  class='usuariosInicio'>";
                mostrarXUsuarios(10);
                echo " </th>
            </tr> 
        </table>
    ";
        ?>
</body>

</html>