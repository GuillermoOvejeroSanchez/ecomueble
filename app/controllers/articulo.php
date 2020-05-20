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

    if(isset($_GET['buy']) and isset($_GET['buy'])){
        if(password_verify($_GET['id'], $_GET['buy'])){
            ?>
        <script>
            swalBuy(true);
        </script>
        <?php
        }else{
            ?>
        <script>
            swalBuy(false);
        </script>
            <?php
        }
    }
    $id = $_GET['id']; //Cogemos id articulo para realizar consulta
    $product = Producto::getProduct($id);

    if($product->nombre != ""){
        $estado = $product->idEstado ? "No Disponible" : "En Venta" : "En Reserva"; 
        $imagen = "../product_img/" . $product->imagen;
        ?>
        <div class="container">
            <form action="" method="post">
                <?php
                    echo"  
                    <div class='contenido_perfil'> 
                        <div class='producto img'> 
                            <img src='$imagen' alt='imagen'>
                        </div> 

                        <div class='datos'>
                            <p>Nombre: <strong>$product->nombre</strong></p> 
                            <p>Precio: <strong>$product->precio</strong></p>
                            <p>Descripción: <strong>$product->descripcion</strong> </p>
                            <p>Estado: <strong>$estado</strong> </p>
                        </div>
                    </div>";

                    $ownProduct = ($_SESSION['idUsuario'] == $product->idUsuario);
                    $messageDelete = '¿Seguro que quieres borrar el producto?';
                    $jscodeDelete = 'confirmAction('.json_encode($messageDelete).');';
                    $messageBuy = 'Este producto vale ' . $product->precio . ' puntos ¿Desea confimar la compra?' ;
                    $jscodeBuy = 'confirmAction('.json_encode($messageBuy).');';
                    if(!$product->idEstado){ //No esta vendido o reservado
                        if($ownProduct){
                            echo '<div><button class="btn b_margen" onclick="return '.htmlspecialchars($jscodeDelete).'" type="submit" name="borrarProducto">Eliminar artículo</button>';
                            echo" <button class='btn b_margen' type='submit' name='editarProducto'>Editar artículo</button></div>"; //TODO Editar P3
                        }else{ //Si no lo es mostrar comprar/contactar
                            echo '<div><button class="btn b_margen" onclick="return '.htmlspecialchars($jscodeBuy).'" type="submit" name="comprarProducto">Comprar</button>';
                            echo "<button class='btn b_margen' type='submit' name='contactar'>Contactar</button></div>";
                        }
                    }

                    if(isset($_SESSION['admin'])){
                        echo '<div><button class="btn b_margen" onclick="return '.htmlspecialchars($jscodeDelete).'" type="submit" name="borrarProducto">Eliminar artículo</button>';
                    }
                ?>
        </div>


        <?php
        //Obtener id, saldo del vendedor
        $vendedor = Usuario::getUserbyId($product->idUsuario);
            //? ROLLBACK IF FAILED

            if (isset($_POST['borrarProducto'])) {
                $ok = Producto::deleteProduct($id);
                ?>
                <script type="text/javascript">
                window.location.href = "/perfil";
                </script>
                <?php
                //header("Location: /perfil");
            } 
            elseif (isset($_POST['editarProducto'])) {
                ?>
                <script type="text/javascript">
                window.location.href = "/editarProducto?id=<?php echo $id;?>";
                </script>
                <?php
                //header("Location: editarProducto?id=$id");
            }
            elseif (isset($_POST['comprarProducto'])) {
                comprarProducto();
            }elseif (isset($_POST['contactar'])) {
                //Contactar
                ?>
                <script type="text/javascript">
                window.location.href = "/usuario?id=<?php echo $vendedor->idUsuario;?>";
                </script>
                <?php
                //header("Location: /usuario?id=$vendedor->idUsuario");
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
    $id = $_GET['id']; //Cogemos id articulo para realizar consulta
    $product = Producto::getProduct($id);
    //Obtener id, saldo del vendedor
    $vendedor = Usuario::getUserbyId($product->idUsuario);
    //Transaccion
    $transaccion = new Transaccion($id, $_SESSION['idUsuario'], date('Y-m-d')); //World Wide Web Consortium (ejemplo: 2005-08-15T15:52:01+00:00)

    //Comprobar si tenemos monedas (monedas >= precio)
    if($_SESSION['saldo'] >= $product->precio && $product->idEstado == 0){
       
        //? START TRANSACTION            
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
        $conn->autocommit(FALSE);
        $failed = FALSE;
        
        //Restar monedas comprador
        $ok = Usuario::updateSaldo($_SESSION['saldo'], -$product->precio, $_SESSION['idUsuario']);
        if(!$ok){
            if(!$failed)
                $failed = TRUE;
            $conn->rollback();
        }
        
        //Sumar monedas 
        //? ROLLBACK IF FAILED
        $ok = Usuario::updateSaldo($vendedor->saldo, $product->precio, $vendedor->idUsuario);
        if(!$ok){
            if(!$failed)
                $failed = TRUE;
            $conn->rollback();
        }
        //Eliminar producto (cambiar status a vendido)
        //? ROLLBACK IF FAILED
        $ok = Producto::changeStatus($id, VENDIDO);
        if(!$ok){
            if(!$failed)
                $failed = TRUE;
            $conn->rollback();
        }
        //Realizar transaccion
        //? ROLLBACK IF FAILED
        $ok = $transaccion->newTransaction();
        if(!$ok){
            if(!$failed)
                $failed = TRUE;
            $conn->rollback();
        }
        //? COMMIT
        ?>
        <?php
        if(!$failed){
            $conn->commit();
            $_SESSION['saldo'] -= $product->precio;
            $idcompra = password_hash($product->idProducto, PASSWORD_BCRYPT);
            ?>
            <script type="text/javascript">
            window.location.href = "/articulo?id=<?php echo $id;?>&buy=<?php echo $idcompra;?>";
            </script>
            <?php
            //header("Location: /articulo?id=$id&buy=$idcompra");     
            die();
        }else{
            $conn->rollback();
            ?>
            <script type="text/javascript">
            window.location.href = "/articulo?id=<?php echo $id;?>&buy=0";
            </script>
            <?php
            //header("Location: /articulo?id=$id&buy=0");
            die(); 
        }
    }
}

function reservarProducto(){
    $id = $_GET['id']; //Cogemos id articulo para realizar consulta
    $product = Producto::getProduct($id);
    $ok = Producto::changeStatus($id, RESERVADO);
         if(!$ok){
            if(!$failed)
                $failed = TRUE;
            $conn->rollback();
        }
}
