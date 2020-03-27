<?php
require('./models/Producto.php');
require_once('./bd.php');

isset($_SESSION['login']) ? logged($conn) : not_logged();
$conn->close(); //Importante cerrar siempre la conexion

function logged($conn)
{
    $product = new Producto(); //Producto vacio
    $id = $_GET['id']; //Cogemos id articulo para realizar consulta
    $sql = $product->getProduct($id);
    $resultado = $conn->query($sql);
    if($resultado->num_rows > 0){
        
        //TODO Comprobar que el producto es nuestro
        $ownProduct = TRUE;
        if(FALSE){
            $ownProduct = FALSE;
        }

        $product->createProduct($resultado->fetch_assoc()); //Creamos un objeto Producto con los datos de la consulta
        
        $imagen = "../product_img/" . $product->imagen;
        
        ?>
<div class="perfil">
    <form action="" method="post">
        <?php
        echo"  
        <table> 
            <tr> 
                <th class='producto'> 
                    <img src='$imagen' alt='imagen'>
                </th> 

                <th class='datos'>
                    <p>Nombre: <strong>$product->nombre</strong></p> 
                    <p>Precio: <strong>$product->precio</strong></p>
                    <p>Descrición: <strong>$product->descripcion</strong> </p>
                </th>
            </tr> 
        </table>";
        $ownProduct = ($_SESSION['idUsuario'] == $product->idUsuario);
        if($ownProduct){
            echo "<div class='bperfil'><button type='submit' name='borrarProducto'>Borrar</button>
            <button type='submit' name='editarProducto'>Editar Articulo</button></div>";
        }else{ //Si no lo es mostrar comprar/contactar
            //TODO Implementar Comprar y Ver
            echo "<div class='bperfil'><button type='submit' name='comprarProducto'>Comprar</button>
            <button type='submit' name='verProducto'>Contactar</button></div>";
        }
?>
</div>
<?php
        if (isset($_POST['borrarProducto'])) {
            $sql1 = Producto::deleteProduct($id);
            $conn->query($sql1); 
            header("Location: /perfil");
        }   
    }else{ //Buscamos un articulo que no existe (poner un parametro a mano)
        ?>
        <div class="noReg">
        <img src="img/warning.png" alt="Atención">
        <p>El articulo que buscas no existe</p>
        </div>
        <?php
    }
}

function not_logged()
{
    ?>
<div class="noReg">
    <img src="img/warning.png" alt="Atención">
    <p>¡Regístrate o inicia sesión para acceder!</p>
</div>
<?php
}
?>