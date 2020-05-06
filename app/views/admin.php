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
        <div id="contenido">
    <?php
		if (!isset($_SESSION['admin'])) {
			echo "<h1>¡Acceso denegado!</h1>";
			echo "<p>No tienes permisos suficientes para administrar la web.</p>";
	    } else {
	?>
		<h1>Consola de administración</h1>
	<?php
        }
        require('./controllers/admin.php');
    ?>
        
        <?php
            echo "<div class='productos'>";
                if(isset($_POST['nombreUsuario'])) {
                    if (Usuario::mostrarUsuariosBuscados() == null) {
                        echo "<h3> Lo sentimos, ningún usuario coincide con su búsqueda.\n </h3>";
                    }
                }
                else if (isset($_POST['nombreProducto'])) {
                    if (Producto::mostrarProductosBuscados() == null) {
                        echo "<h3> Lo sentimos, ningún producto coincide con su búsqueda.\n </h3>";
                    }
                } 
                else {
                    echo '</div> 
                    </div>';   
                    ?>


                    <table class='per'>
                        <tr>
                            <th class='ini'> Usuarios </th>
                        </tr>
                        <tr>
                        
                            <th class="buscar">
                                <form method="POST"> 
                                    <div class='b'><label> Busca un usuario por su nombre: </label><input type="text" name="nombreUsuario"/>
                                    <button  type="submit" name="submit_buscarNombre">Buscar</button></div>
                                </form>
                            </th>

                        </tr>
                        <tr>
                    
                            <th  class='usuariosInicio'> <?php
                                mostrarXUsuarios(20);
                                ?>
                            </th>                 
                        </tr> 
                        <tr> 
                            <th class='ini'> Productos </th> 
                        </tr>
                        <tr>

                            <th class="buscar">
                                <form method="POST"> 
                                    <div class='b'><label> Busca un producto por su nombre: </label><input type="text" name="nombreProducto"/>
                                    <button  type="submit" name="submit_buscarNombre">Buscar</button></div>
                                </form>
                            </th>
                        </tr>
                        <tr>

                            <th class='productosInicio'> <?php
                                mostrarXProductos(10);
                } ?>
                </th> 
            </tr> 
        </table>
	</div>
          
</body>

</html>