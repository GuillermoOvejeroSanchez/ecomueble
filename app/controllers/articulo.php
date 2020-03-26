<?php
require('./models/Producto.php');
require_once('./bd.php');

isset($_SESSION['login']) ? logged($conn) : not_logged();
$conn->close(); //Importante cerrar siempre la conexion

function logged($conn)
{
    $product = new Producto(); //Usuario vacio
    $id = $_GET['id']; //Cogemos nombre user para realizar consulta
    $sql = $product->getProduct($id);
    $resultado = $conn->query($sql);
    $product->createProduct($resultado->fetch_assoc()); //Creamos un objeto user con los datos de la consulta

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
                </table>
          

        <div class='bperfil'><button type='submit' name='borrarProducto'>Borrar</button>
        <button type='submit' name='editarProducto'>Editar Perfil</button></div>";//botones
        ?>
    </div>
    <?php
    if (isset($_POST['borrarProducto'])) {
        $sql1 = Producto::deleteProduct($id);
        $conn->query($sql1); 
        header("Location: /perfil");
    }
}

function not_logged()
{
    ?>
    <div class="noReg">
    <img src="img/warning.png" alt="Atención"><p>¡Regístrate o inicia sesión para acceder!</p>
    </div>
    <?php
}
?>













