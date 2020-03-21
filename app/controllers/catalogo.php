<?php
    require('./models/Producto.php');
    require_once('./bd.php');

   
    echo " <div class='perfil'> ";
    ?>
        
        <div class="categorias">
            <ul>
            <li><a href="catalogo?categoria=silla">Sillas</a></li>
            <li><a href="catalogo?categoria=mesa">Mesas</a></li>
            <li><a href="catalogo?categoria=armario">Armarios</a></li>
            <li><a href="catalogo?categoria=estanteria">Estanterias</a></li>
            <li><a href="catalogo">todos </a></li>
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