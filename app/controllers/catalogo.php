<?php
    require('./models/Producto.php');
    require_once('./bd.php');

   
    echo " <div class='perfil'> ";
       
        echo "<div class='productos'>";
            mostrarProductos( $conn);
        echo '</div> 
    </div>';

    function mostrarProductos( $conn)
    {
        $sql =  Producto::getAllProducts();
        
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