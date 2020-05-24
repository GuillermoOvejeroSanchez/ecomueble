<?php
require('./includes/Producto.php');
require('./includes/Categoria.php');
require('./includes/Transaccion.php');
require('./includes/Reserva.php');
require('./includes/Reporte.php');
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
        if( $product->idEstado == 0){
           $estado= "En venta";
        }
       else if( $product->idEstado == 1){
            $estado= "No disponible";
         }
        else if( $product->idEstado == 2){
            $estado= "Reservado";
         }
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
                    $reserva = Reserva:: getidComprador($id);
                    $ownReserva = ($_SESSION['idUsuario'] == $reserva->idComprador);
                    $messageDelete = '¿Seguro que quieres borrar el producto?';
                    $jscodeDelete = 'confirmAction('.json_encode($messageDelete).');';
                    $messageBuy = 'Este producto vale ' . $product->precio . ' puntos ¿Desea confimar la compra?' ;
                    $jscodeBuy = 'confirmAction('.json_encode($messageBuy).');';
                    $messageReserva= 'Este producto vale ' . $product->precio . ' puntos ¿Desea reservarlo?' ;
                    $jscodeReserva= 'confirmAction('.json_encode($messageReserva).');';
                    if($product->idEstado !=1){ //No esta vendido o reservado
                        if($ownProduct){
                            echo '<div><button class="btn b_margen" onclick="return '.htmlspecialchars($jscodeDelete).'" type="submit" name="borrarProducto">Eliminar artículo</button>';
                            echo" <button class='btn b_margen' type='submit' name='editarProducto'>Editar artículo</button></div>"; //TODO Editar P3
                      
                        }else{ //Si no lo es mostrar comprar/contactar
                            if($product->idEstado == 2) {
                                if($ownReserva) {
                                    echo '<div><button class="btn b_margen" onclick="return '.htmlspecialchars($jscodeBuy).'" type="submit" name="comprarProducto">Comprar</button>';  
                                }
                            }
                            else {
                                echo '<div><button class="btn b_margen" onclick="return '.htmlspecialchars($jscodeBuy).'" type="submit" name="comprarProducto">Comprar</button>';
                            }
                               
                            echo "<button class='btn b_margen' type='submit' name='contactar'>Contactar</button>";
                            if(!isset($_SESSION['admin'])) echo "<div><button class='btn b_margen' type='submit' name='reportar'>Reportar producto</button>";
                            if($product->idEstado !=2) {
                                echo '<button class="btn b_margen" onclick="return '.htmlspecialchars($jscodeReserva).'" type="submit" name="reservarProducto">Reservar</button>';
                            }
                            elseif ($ownReserva) {
                                echo '<button class="btn b_margen" onclick="return  type="submit" name="anularReserva">Anular Reserva</button>';
                            }
                        }
                    }

                    if(isset($_SESSION['admin'])){
                        echo '<div><button class="btn b_margen" onclick="return '.htmlspecialchars($jscodeDelete).'" type="submit" name="borrarProducto">Eliminar artículo</button>';
                        echo "<button class='btn b_margen' type='submit' name='resolverReporte'>Resolver reporte</button>";
                        echo "<div class='reporte'>";
                        Reporte:: showReports($id);
                        echo "</div>";
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
            }
            elseif (isset($_POST['reservarProducto'])) {
                reservarProducto();
            }
            elseif (isset($_POST['anularReserva'])) {
                AnularReserva();
            }
            elseif (isset($_POST['contactar'])) {
                //Contactar
                ?>
                <script type="text/javascript">
                window.location.href = "/usuario?id=<?php echo $vendedor->idUsuario;?>";
                </script>
                <?php
                //header("Location: /usuario?id=$vendedor->idUsuario");
            }
            elseif (isset($_POST['reportar'])) {
                ?>
                <div class='reporte'>
                <form action="" method="post" >
                <fieldset>
                <legend> Reportar producto </legend>
                <div><label>Motivo: </label> <input type="text" name="motivo"  /></div>
                <div><button type="submit" name="submit_reportar">Reportar</button></div>
                </fieldset>
                </form>
                </div>
                <?php
                
            }
            if(isset($_POST['submit_reportar'])) {
                reportar($_POST['motivo']);
            }
            elseif (isset($_POST['resolverReporte'])) {
                ?>
                <div class="reporte">
                <form action="" method="post" >
                <fieldset>
                <legend> Resolver reporte </legend>
                <div><label>ID reporte: </label> <input type="text" name="idReporte"  /></div>
                <div><label>Resolución: </label> <input type="text" name="resolucion"  /></div>
                <div><button type="submit" name="submit_resolver">Resolver</button></div>
                </fieldset>
                </form>
                </div>
                <?php
                
            }
            if(isset($_POST['submit_resolver'])) {
                $reporte = Reporte::getReporte($_POST['idReporte']);
                if(!empty($_POST['resolucion'])){
                    $reporte->resolucion = $_POST['resolucion'];
                }
                $ok = $reporte->updateReporte();
                if($ok){
                    ?>
                    <script type="text/javascript">
                    window.location.href = "/articulo?id=<?php echo $id;?>";
                    </script>
                    <?php
                }
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
    if($_SESSION['saldo'] >= $product->precio && $product->idEstado != 1){
       
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

        $ok = Reserva:: borrarReserva($id); 
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
    $app = Aplicacion::getSingleton();
    $conn = $app->conexionBd();
    $conn->autocommit(FALSE);
    $failed = FALSE;
    $id = $_GET['id']; //Cogemos id articulo para realizar consulta
    $product = Producto::getProduct($id);
    $reserva = new Reserva($id, $_SESSION['idUsuario']); 
    $ok = Producto::changeStatus($id, RESERVADO);
    if($product->idEstado == 0){
        if(!$ok){
            if(!$failed)
                $failed = TRUE;
            $conn->rollback();
        }
    }
    $ok = $reserva->newReserva();
    if(!$ok){
        if(!$failed)
            $failed = TRUE;
        $conn->rollback();
    }
    if(!$failed){
        $conn->commit();
    }
    else {
        $conn->rollback();
    }
    ?>
    <script type="text/javascript">
    window.location.href = "/articulo?id=<?php echo $id;?>";
    </script>
    <?php
}
function AnularReserva(){
    $app = Aplicacion::getSingleton();
    $conn = $app->conexionBd();
    $conn->autocommit(FALSE);
    $failed = FALSE;
    $id = $_GET['id']; //Cogemos id articulo para realizar consulta
    $product = Producto::getProduct($id);
   
    $ok = Producto::changeStatus($id, EN_VENTA);
    if($product->idEstado == 0){
        if(!$ok){
            if(!$failed)
                $failed = TRUE;
            $conn->rollback();
        }
    } 
    $ok = Reserva:: borrarReserva($id); 
    if(!$ok){
        if(!$failed)
            $failed = TRUE;
        $conn->rollback();
    }
    if(!$failed){
        $conn->commit();
    }
    else {
        $conn->rollback();
    }
    ?>
    <script type="text/javascript">
    window.location.href = "/articulo?id=<?php echo $id;?>";
    </script>
    <?php
}
function reportar($motivo) {
    $app = Aplicacion::getSingleton();
    $conn = $app->conexionBd();
    $conn->autocommit(FALSE);
    $failed = FALSE;
    $id = $_GET['id'];
    $reporte = new Reporte($motivo, $id, $_SESSION['idUsuario'], date('Y-m-d H:i:s')); 
    $ok = $reporte->newReporte();
    if(!$ok){
        if(!$failed)
            $failed = TRUE;
        $conn->rollback();
    }
    if(!$failed){
        $conn->commit();
    }
    else {
        $conn->rollback();
    }
    ?>
    <script type="text/javascript">
    window.location.href = "/articulo?id=<?php echo $id;?>";
    </script>
    <?php
}