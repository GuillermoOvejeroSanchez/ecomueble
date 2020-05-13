<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require('./includes/common/head.php')?>
    <title>Administrar</title>
</head>

<body>
    <?php
        require('./includes/common/cabecera.php');
    ?>    
    
    <div class="container" id="contenido">
        <?php
            if (!isset($_SESSION['admin'])) {
                echo "<h1>¡Acceso denegado!</h1>";
                echo "<p>No tienes permisos suficientes para administrar la web.</p>";
            } else {
        ?>
            <h1>Consola de administración</h1>
    <?php
        }
        require('./includes/Producto.php');
        require('./includes/Usuario.php');
    ?>
    <div>

        <?php
            echo "<div class='productosInicio'>";
            if(isset($_POST['nombreUsuario'])) {
                $map = Usuario::mostrarUsuariosBuscados();
                if ($map !== null) {
                    foreach ($map as $link => $product_img) {
                        ?>
                            <a href=<?php echo "'$link'"?>> <img src=<?php echo "'$product_img'"?> alt='imagen'></a>
                            <?php
                        }
                    }else{
                        echo "<h3> Lo sentimos, ningún usuario coincide con su búsqueda.\n </h3>";
                    }
                }
                else if (isset($_POST['nombreProducto'])) {
                    $map = Producto::mostrarProductosBuscados();
                    if ($map !== null) {
                        foreach ($map as $link => $product_img) {
                            ?>
                            <a href=<?php echo "'$link'"?>> <img src=<?php echo "'$product_img'"?> alt='imagen'></a>
                            <?php
                            } 
                        }else{
                            echo "<h3> Lo sentimos, ningún producto coincide con su búsqueda.\n </h3>";
                        }
                    } 
                    else {
                        echo '</div> 
                        </div>';   
                        ?>

</div>

<table class='container'>
    <tr>
        <th class='ini'> Usuarios </th>
    </tr>
    <tr>
        
        <th class="buscar">
            <form method="POST"> 
                <div><label> Busca un usuario por su nombre: </label><input type="text" name="nombreUsuario"/>
                <button class="btn" type="submit" name="submit_buscarNombre">Buscar</button></div>
            </form>
        </th>
        
    </tr>
    <tr>
        
        <th  class='usuariosInicio'> <?php
                                echo Usuario::mostrarTodosUsuarios();
                                ?>
                            </th>                 
                        </tr> 
                        <tr> 
                            <th class='ini'> Productos </th> 
                        </tr>
                        <tr>

                            <th class="buscar">
                                <form method="POST"> 
                                    <div><label> Busca un producto por su nombre: </label><input type="text" name="nombreProducto"/>
                                    <button class="btn" type="submit" name="submit_buscarNombre">Buscar</button></div>
                                </form>
                            </th>
                        </tr>
                        <tr>

                            <th class='productosInicio'> <?php
                                echo Producto::mostrarXProductos(10);
                } ?>
                </th> 
            </tr> 
        </table>
	</div>
          
</body>

</html>