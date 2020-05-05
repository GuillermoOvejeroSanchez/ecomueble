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
            <div class='b'><label> Busca un producto por su nombre: </label><input type="text" name="nombre"/>
            <button  type="submit" name="submit_buscarNombre">Buscar</button></div>
        </form>
        </div>
    <?php
        echo "<div class='productos'>";
            if(!isset($_POST['nombre'])) mostrarProductos();
            else mostrarProductosBuscados();
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
    function mostrarProductosBuscados()
    {
        $existe = TRUE;
        if(isset($_POST['submit_buscarNombre'])){
           
            //idCategoria para insertar en producto
            $nombre = $_POST['nombre'];
            if($nombre != "")
                $map = Producto::getAllProductsFromNombre($nombre);
            else
                $existe = FALSE;
            
            if($existe){
                foreach ($map as $link => $product_img) {
                    ?>
                <a href=<?php echo "'$link'"?>> <img src=<?php echo "'$product_img'"?> alt='imagen'></a>
                <?php
                }  
            }     
        }    
    }
?>