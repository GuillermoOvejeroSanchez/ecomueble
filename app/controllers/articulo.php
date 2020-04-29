<?php
require('./includes/Producto.php');
require('./includes/Categoria.php');
require('./includes/Transaccion.php');
require('./includes/Usuario.php');

$app = Aplicacion::getSingleton();
$conn = $app->conexionBd();
isset($_SESSION['login']) ? logged() : not_logged();
//$conn->close(); //Importante cerrar siempre la conexion

function logged()
{
    $id = $_GET['id']; //Cogemos id articulo para realizar consulta
    $product = Producto::getProduct($id);

    if($product->nombre != ""){
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
                            echo "<div class='bperfil'><button type='submit' name='comprarProducto'>Comprar</button>";
                            echo "<button type='submit' name='contactar'>Contactar</button></div>";
                        }
                    }
                ?>
        </div>


        <?php
            //Obtener id, saldo del vendedor
            $vendedor = Usuario::getUserbyId($product->idUsuario);
            //? ROLLBACK IF FAILED

            if (isset($_POST['borrarProducto'])) {
                $ok = Producto::deleteProduct($id);
                header("Location: /perfil");
            } elseif (isset($_POST['comprarProducto'])) {
                
            }elseif (isset($_POST['contactar'])) {
                //Contactar
                header("Location: /usuario?id=$vendedor->idUsuario");
            }
    }
    else{ //Buscamos un articulo que no existe (poner un parametro a mano)
        ?>
        <div class="noReg">
            <img src="img/warning.png" alt="Atención">
            <p>El artículo que buscas no existe</p>
        </div>
        <?php
    }
}

function comprarProducto()
{
    //TODO daba errores de que faltaban parametros al ponerlo aqui
    //Transaccion
    $transaccion = new Transaccion($id, $_SESSION['idUsuario'], date(DATE_W3C)); //World Wide Web Consortium (ejemplo: 2005-08-15T15:52:01+00:00)

    //Comprobar si tenemos monedas (monedas >= precio)
    if($_SESSION['saldo'] >= $product->precio && $product->idEstado == 0){
        //TODO cambiar a una Transaccion de SQL (poder hacer ROLLBACK y COMMIT por si algo sale mal)

        //? START TRANSACTION
        //Restar monedas comprador
        $ok = Usuario::updateSaldo($_SESSION['saldo'], -$product->precio, $_SESSION['idUsuario']);
        if(!$ok){
            return;
        }
        $_SESSION['saldo'] -= $product->precio;
        
        //Sumar monedas 
        //? ROLLBACK IF FAILED
        $ok = Usuario::updateSaldo($vendedor->saldo, $product->precio, $vendedor->idUsuario);
        if(!$ok){
            return;
        }
        //Eliminar producto (cambiar status a vendido)
        //? ROLLBACK IF FAILED
        $ok = Producto::changeStatus($id, VENDIDO);
        if(!$ok){
            return;
        }
        //Realizar transaccion
        //? ROLLBACK IF FAILED
        $ok = $transaccion->newTransaction();
        if(!$ok){
            return;
        }
        //? COMMIT

        header("Location: /articulo?id=$id");
    }
}
?>