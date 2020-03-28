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
        

        $product->createProduct($resultado->fetch_assoc()); //Creamos un objeto Producto con los datos de la consulta
        $estado = $product->idEstado ? "No Disponible" : "En Venta";
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
                    <p>Descripción: <strong>$product->descripcion</strong> </p>
                    <p>Estado: <strong>$estado</strong> </p>
                </th>
            </tr> 
        </table>";

        $ownProduct = ($_SESSION['idUsuario'] == $product->idUsuario);
        if(!$product->idEstado){ //No esta vendido o reservado
            if($ownProduct){
                echo "<div class='bperfil'><button type='submit' name='borrarProducto'>Borrar</button>";
                //echo" <button type='submit' name='editarProducto'>Editar Articulo</button></div>"; //TODO Editar P3
            }else{ //Si no lo es mostrar comprar/contactar
                //TODO Implementar Comprar y Contactar
                echo "<div class='bperfil'><button type='submit' name='comprarProducto'>Comprar</button>";
                echo "<button type='submit' name='verProducto'>Contactar</button></div>";
            }
        }
?>
</div>
<?php
        if (isset($_POST['borrarProducto'])) {
            $sql1 = Producto::deleteProduct($id);
            $conn->query($sql1); 
            header("Location: /perfil");
        } elseif (isset($_POST['comprarProducto'])) {
            require('./models/Transaccion.php');
            require('./models/Usuario.php');

            //Transaccion
            $transaccion = new Transaccion($id, $_SESSION['idUsuario'], date(DATE_W3C)); //World Wide Web Consortium (ejemplo: 2005-08-15T15:52:01+00:00)

            //Comprobar si tenemos monedas (monedas >= precio)
            if($_SESSION['saldo'] >= $product->precio && $product->idEstado == 0){
                //TODO cambiar a una Transaccion de SQL (poder hacer ROLLBACK y COMMIT por si algo sale mal)
        
                //? START TRANSACTION
                
                //Restar monedas comprador
                $sql = Usuario::updateSaldo($_SESSION['saldo'], -$product->precio, $_SESSION['idUsuario']);
                //? ROLLBACK IF FAILED
                $conn->query($sql);
                $_SESSION['saldo'] -= $product->precio;
                
                //Obtener id, saldo del vendedor
                $vendedor = new Usuario();
                $sql = Usuario::getUserbyId($product->idUsuario);
                //? ROLLBACK IF FAILED
                $resultado = $conn->query($sql);
                $vendedor->createUser($resultado->fetch_assoc());
                //Sumar monedas 
                //? ROLLBACK IF FAILED
                $conn->query(Usuario::updateSaldo($vendedor->saldo, $product->precio, $vendedor->idUsuario));
            
                //Eliminar producto (cambiar status a vendido)
                //? ROLLBACK IF FAILED
                $conn->query(Producto::changeStatus($id, 1));

                //Realizar transaccion
                //? ROLLBACK IF FAILED
                $conn->query($transaccion->newTransaction());

                //? COMMIT
                header("Location: /articulo?id=$id");
            }
        }elseif (isset($_POST['verProducto'])) {
            //TODO Contactar
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

function comprarProducto()
{
    //TODO daba errores de que faltaban parametros al ponerlo aqui
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