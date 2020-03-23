<?php
    require('./models/Producto.php');
    require_once('./bd.php');

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
        <!--Yo no pondría que se puedan añadir categorias nuevas, para que esto sea mas sencillo
        dejaria unas cuantas y una que sea "otros", cambiaria los nombres porque estas no tienen 
        sentido pero dejaria unas y ya.-->
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
        if(!isset($_GET['categoria']))
          $sql =  Producto::getAllProducts();
        
        else{
            $categoria = new Categoria($_GET['categoria']);
        
            //idCategoria para insertar en producto
            $idCategoria = $categoria->getIDCategoria();

            if($resultado = $conn->query($idCategoria)) {
            $cat_fetched = $resultado->fetch_assoc();
            $sql = Producto::getAllProductsFromCategoria($cat_fetched['idCategoria']);}
            }
        
        if($resultado = $conn->query($sql)){
            if($resultado->num_rows > 0){
            while ($fila = $resultado->fetch_assoc()) {
                $product_img = "../product_img/" . $fila['imagen'];
                    ?>
                    <img src=<?php echo "'$product_img'"?> alt='imagen'>
                    <?php
            }
            }
        
        }
    }

?>