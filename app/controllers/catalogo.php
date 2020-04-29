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
        
    <?php
        echo "<div class='productos'>";
            mostrarProductos();
        echo '</div> 
    </div>';

    function mostrarProductos()
    {

        $existe = TRUE;
        if(!isset($_GET['categoria']))
          $map =  Producto::getAllProducts();
        else {
            $categoria = new Categoria($_GET['categoria']);
        
            //idCategoria para insertar en producto
            $idCategoria = $categoria->getIDCategoria();
            if($idCategoria != "")
                $map = Producto::getAllProductsFromCategoria($idCategoria);
            else
                $existe = FALSE;
            }  
            if($existe){
                foreach ($map as $link => $product_img) {
                    ?>
                <a href=<?php echo "'$link'"?>> <img src=<?php echo "'$product_img'"?> alt='imagen'></a>
                <?php
            }       
        }
        
    }
?>