<?php
    require('./includes/Producto.php');
    require('./includes/Categoria.php');

    $arrayTags = Categoria::getAllTags();

    echo " <div class='container'> ";
    ?>

<nav_categorias>
    <div class="nav_bar a">
        <ul>
            <li><a href="catalogo">Todos los Productos </a></li>
            <?php
                    foreach ($arrayTags as $key => $value) {
                        echo '<li><a href="catalogo?categoria='. $key .'">'. $value .'</a></li>';
                    }
                    ?>
            </ul>
        </div>
</nav_categorias>
        
        <div class="buscar">
        <form method="POST"> 
            <div><label> Busca un producto por su nombre: </label><input type="text" name="nombreProducto"/>
            <button class='btn' type="submit" name="submit_buscarNombre">Buscar</button></div>
        </form>
        </div>
    <?php
        echo "<div class='productosInicio padcat'>";
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


<!-- PENDIENTE DE HACER -->
    <!-- Carrusel categorias -->
 
<!-- 

    <div class="container-fluid">
        <div class="carrusel px-md-4">
            <div class="row carrusel text-center">
            <div class="col-md-2 product pt-md-5 pt-4">
                <img src="../img/armarioicon.png">
                <span class="border site-btn brn-span">ARMARIOS</span>
            </div>
            <div class="col-md-2 product pt-md-5 pt-4">
                <img src="../img/armarioicon.png">
                <span class="border site-btn brn-span">MESAS</span>
            </div>
            <div class="col-md-2 product pt-md-5 pt-4">
                <img src="../img/armarioicon.png">
                <span class="border site-btn brn-span">SILLAS</span>
            </div>
        </div>
    </div>
    
 -->
    <!-- /Carrusel categorias -->  