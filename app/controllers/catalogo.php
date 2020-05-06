<?php
    require('./includes/Producto.php');
    require('./includes/Categoria.php');

    $arrayTags = Categoria::getAllTags();

    echo " <div class='perfil'> ";
    ?>
        <div class="categorias">
            <ul>
                <li><a href="catalogo">Todos los Productos </a></li>
                <?php
                    foreach ($arrayTags as $key => $value) {
                        echo '<li><a href="catalogo?categoria='. $key .'">'. $value .'</a></li>';
                    }
                ?>
            </ul>
        </div>

        <div class="buscar">
        <form method="POST"> 
            <div class='b'><label> Busca un producto por su nombre: </label><input type="text" name="nombreProducto"/>
            <button  type="submit" name="submit_buscarNombre">Buscar</button></div>
        </form>
        </div>
    <?php
        echo "<div class='productos'>";
            if(!isset($_POST['nombreProducto'])) Producto::mostrarProductos();
            else {
                if(Producto::mostrarProductosBuscados() == null){
                    echo "<h3> Lo sentimos, ningún producto coincide con su búsqueda.\n </h3>";
                }
            }
        echo '</div> 
    </div>';
    
?>