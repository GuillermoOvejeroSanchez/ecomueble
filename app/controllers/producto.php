<?php
require('./models/Producto.php');
require_once('./bd.php');

isset($_SESSION['login']) ? logged($conn) : not_logged();
$conn->close(); //Importante cerrar siempre la conexion

function logged($conn)
{
    $product = new Producto(); //Usuario vacio
    $p = $_SESSION['productname']; //Cogemos nombre user para realizar consulta
    $sql = $product->getProduct($p);
    $resultado = $conn->query($sql);
    $product->createProduct($resultado->fetch_assoc()); //Creamos un objeto user con los datos de la consulta

    $imagen = "../product_img/" . $product->imagen;

    ?>
    <div class="producto"> 
    <form action="status" method="post">
        <?php
        echo" <table> <tr> <th class='imagen'> <img src='$imagen' alt='imagen'></th> 
                            <th class='datos'><p>Nombre: <strong>$product->nombre</strong></p> 
                                            <p>Precio: <strong>$product->precio</strong></p>
                                            <p>Descrición: <strong>$product->descripcion</strong> </p></th>
              </tr> </table>
           ";//Imagen del producto y datos informativos

        echo "<div class='bproducto'><button type='submit' name='borrarProducto'>Borrar Producto</button>
        <button type='submit' name='editarProducto'>Editar Perfil</button></div>";//botones
        ?>
    </div>
    <?php
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













