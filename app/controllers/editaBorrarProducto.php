<?php
    require('./models/Producto.php');
    require_once('./bd.php');
?>

    <?php
    echo " <div class='perfil'> ";
       
        echo "<div class='productos'>";
            mostrarProductos($_SESSION['idUsuario'], $conn);
        echo '</div> 
    </div>';

    function mostrarProductos($idUsuario, $conn)
    {
        $sql =  Producto::getAllProductsFromUser($idUsuario);
        $array = array();
        $contador = 0; 
        if($resultado = $conn->query($sql)){
            if($resultado->num_rows > 0){
            while ($fila = $resultado->fetch_assoc()) {
                $product_img = "../product_img/" . $fila['imagen'];
                $nombre_producto = $fila['nombre']; 
                $precio = $fila['precio']; 
                $idProducto = $fila['idProducto'];
                array($contador => $idProducto);
                    ?>
                <table> <tr> <th class='imagen'><img src=<?php echo "'$product_img'"?> alt='imagen'></th> 
                                <th class='datos'>
                                    <p>Nombre: <strong> <?php echo "$nombre_producto"?></strong></p> 
                                    <p>precio: <strong><?php echo "$precio"?></strong></p>
                                    <p>ID: <strong><?php echo "$idProducto"?></strong></p>
                         </tr> 
                </table>

                <form action="" method="post">
                    <div class='bperfil'>
                    <button type='submit' name='eliminarProducto' value=<?= $contador?>>Eliminar</button>
                    <button type='submit' name='modificarProducto'>Modificar</button>
                    </div>
                </form> 
                    <?php
                
                $contador = $contador +1; 
            }
            
            }
        
        }

        if(isset($_POST['eliminarProducto'])){
                //echo var_dump($array[$_POST['eliminarProducto']]);
            $sql1 = Producto::deleteProduct($idProducto);
            $conn->query($sql1);
        }
        /*
        PROBLEMA: el boton en "value" guardaba el id del producto directamente por lo que se guardaba el del ultimo 
        que habia en el bucle y se eliminaba este. 

        POSIBLE SOLUCION: hacer un array el cual almacene el id de cada producto y al boton le pasamos un contador 
        el cual es la posicion del array asi solo tendriamos que acceder a esa posicion y sacar el id correspondiente. 
        
        
        */
    }

?>                       

