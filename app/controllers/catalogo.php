<!-- PENDIENTE DE HACER //VICTOR -->
    <!-- Carrusel categorias -->
<!-- 

    <div>
        <div>
            <div><img src="../img/armarioicon.png"></div>
            <div><img src="./img/armarioicon.png"></div>
            <div><img src="./img/armarioicon.png"></div>
        </div>
    </div>
    
-->
    <!-- /Carrusel categorias -->    
<?php
    require('./includes/Producto.php');
    require('./includes/Categoria.php');

    $arrayTags = Categoria::getAllTags();

    echo " <div class='container'> ";
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
            <div><label> Busca un producto por su nombre: </label><input type="text" name="nombreProducto"/>
            <button class='btn' type="submit" name="submit_buscarNombre">Buscar</button></div>
        </form>
        </div>
    <?php
        echo "<div class='productosInicio'>";
            if(!isset($_POST['nombreProducto'])) Producto::mostrarProductos();
            else {
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
        echo '</div> 
    </div>';
    
?>