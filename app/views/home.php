<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require('./includes/common/head.php')?>
    <title>Ecomueble</title>
</head>

<body>
    <?php
        require('./includes/common/cabecera.php');
        //require('./controllers/home.php'); Si dais el visto bueno borramos este script
        require('./includes/Producto.php');
        require('./includes/Usuario.php');

        echo"
        <table class='per'>
            <tr>
                <th class='ini'> Productos </th>
                <th class='ini'> Usuarios </th> 
            </tr> 
            <tr> 
                <th class='productosInicio'>";
                echo Producto::mostrarXProductos(12);
                echo 
                " </th> 

                <th  class='usuariosInicio'>";
                echo Usuario::mostrarXUsuarios(20);                
                " </th>
            </tr> 
        </table>
    ";
        ?>
</body>

</html>