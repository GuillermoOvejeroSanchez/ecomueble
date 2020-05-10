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
    ?>
        <div class='container'>
                <div class='ini'> Productos </div>
                <div class='productosInicio'>
                    <?php echo Producto::mostrarXProductos(20); ?>
                </div> 
        </div> 
        <div class="container"> 
                <div class='ini'> Usuarios </div> 

                <div class='usuariosInicio'>
                    <?php echo Usuario::mostrarXUsuarios(20); ?>             
                </div>
        </div> 


</body>

</html>