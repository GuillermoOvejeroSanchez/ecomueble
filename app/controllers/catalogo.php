<?php
    require('./models/Producto.php');

    $conn = connBD();

    $sql = Categoria::getAllTags();
    $arrayTags;
    if($resultado = $conn->query($sql)){
        while ($fila = $resultado->fetch_assoc()) {
            $tipo = $fila['tipo'];
            $arrayTags[$tipo] = ucfirst($tipo) . 's'; //añadimos 's' pa que sea en plural
        }
    }

   
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
            mostrarProductos( $conn);
        echo '</div> 
    </div>';

    function mostrarProductos($conn)
    {
        $existe = TRUE;
        if(!isset($_GET['categoria']))
          $sql =  Producto::getAllProducts();
        
        else{
            $categoria = new Categoria($_GET['categoria']);
        
            //idCategoria para insertar en producto
            $idCategoria = $categoria->getIDCategoria();

            if($resultado = $conn->query($idCategoria)) {
                if ($resultado->num_rows > 0) {
                    $cat_fetched = $resultado->fetch_assoc();
                    $sql = Producto::getAllProductsFromCategoria($cat_fetched['idCategoria']);
                }else{
                    $existe = FALSE;
                }
            }  
        }
        
        if($existe and $resultado = $conn->query($sql)){
            if($resultado->num_rows > 0){
                while ($fila = $resultado->fetch_assoc()) {
                    if($fila['idEstado'] == 0){ //Solo si su idEstado es 0 -> En venta
                        $product_img = "../product_img/" . $fila['imagen'];
                        $nose = "./articulo?id=" .  $fila['idProducto']; 
                    ?>
                        <a href=<?php echo "'$nose'"?>> <img src=<?php echo "'$product_img'"?> alt='imagen'></a>
                    <?php
                    }
                }
            }
    
        } 
    }

?>