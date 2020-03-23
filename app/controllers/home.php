<?php
    require('./models/Producto.php');
    require('./models/Usuario.php');
    require_once('./bd.php');

    echo"<table>
            <tr>
                <th class='ini'> Productos </th>
                <th class='ini'> Usuarios </th> 
            </tr> 
            <tr> 
                <th class='productosInicio'>";
                mostrarXProductos($conn, 10);
                echo " </th> 

                <th  class='usuariosInicio'>";
                mostrarXUsuarios($conn,10);
                echo " </th>
            </tr> 
        </table>
    ";



    function mostrarXUsuarios($conn, $num)
    {
        $sql =  Usuario::getAllUsers();
        
        if($resultado = $conn->query($sql)){
            if($resultado->num_rows > 0){
                while ($num >0 && $fila = $resultado->fetch_assoc()  ) {
                    $product_img = "../profile_img/" . $fila['imagen'];
                    ?>
                <img src=<?php echo "'$product_img'"?> alt='imagen'>
                <?php
                $num--;
                }
            }
    
        } 
    }
           
    function mostrarXProductos($conn, $num)
    {
        $sql =  Producto::getAllProducts();
        
        if($resultado = $conn->query($sql)){
            if($resultado->num_rows > 0){
                while ($num >0 && $fila = $resultado->fetch_assoc()  ) {
                    $product_img = "../product_img/" . $fila['imagen'];
                    ?>
                <img src=<?php echo "'$product_img'"?> alt='imagen'>
                <?php
                $num--;
                }
            }
    
        } 
    }

?>