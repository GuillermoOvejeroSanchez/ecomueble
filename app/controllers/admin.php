<?php
    require('./includes/Producto.php');
    require('./includes/Categoria.php');
    require('./includes/Usuario.php');

    function mostrarXUsuarios($num)
    {
        $map =  Usuario::getAllUsers();
        foreach ($map as $link => $product_img) {
            if($num == 0){
                break;
            }else{
                ?>
                <a href=<?php echo "'$link'"?>> <img src=<?php echo "'$product_img'"?> alt='imagen'></a>
                <?php
                $num--;
            }
        }
    }

    function mostrarXProductos($num)
    {
        $map =  Producto::getAllProducts();
            foreach ($map as $link => $product_img) {
                if($num == 0){
                    break;
                }else{
                    ?>
                    <a href=<?php echo "'$link'"?>> <img src=<?php echo "'$product_img'"?> alt='imagen'></a>
                    <?php
                    $num--;
                }
            }
    }