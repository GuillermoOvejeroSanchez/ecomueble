<?php
require('./includes/Usuario.php');
require('./includes/Producto.php');
require('./includes/Categoria.php');
require('./includes/Transaccion.php');

isset($_SESSION['login']) ? logged() : not_logged();



function logged()
{
    $p = $_GET['id']; //Cogemos id user para realizar consulta
    $user = Usuario::getUserbyId($p);
    $imagen = "../profile_img/" . $user->imagen;

    ?>
    
    <div class="container">
    <form action="status" method="post">
        <?php
        echo"<div class='contenido_perfil'> 
                <div class='perfil img'> <img src='$imagen' alt='imagen'></div> 
                <div class='datos'>
                    <p>Nombre: <strong>$user->nombre</strong></p> 
                    <p>Email: <strong>$user->email</strong></p>
                    <p>Teléfono: <strong>$user->telefono</strong> </p>
                </div>
            </div>";//Imagen de perfil y datos informativos

        if($_SESSION['idUsuario'] == $user->idUsuario){
            echo "<div><button class='btn b_margen' type='submit' name='subirProducto'>Subir Producto</button>
            <button class='btn b_margen' type='submit' name='editarPerfil'>Editar Perfil</button></div>";//botones
        }
        ?>
    </form>
    <form action="" method="post">
        <?php
        if(isset($_SESSION['admin'])){
            $messageDelete = '¿Seguro que quieres borrar el usuario?';
            $jscodeDelete = 'confirmAction('.json_encode($messageDelete).');';           
            echo '<div><button class="btn b_margen" onclick="return '.htmlspecialchars($jscodeDelete).'" type="submit" name="borrarUsuario">Eliminar usuario</button>';
            if($user->bloq == 0) {   
                $messageBloq = '¿Seguro que quieres bloquear al usuario?';
                $jscodeBloq = 'confirmAction('.json_encode($messageBloq).');';
               echo '<button class="btn b_margen" onclick="return '.htmlspecialchars($jscodeBloq).'" type="submit" name="bloqUsuario">Bloquear usuario</button></div>';
            } else {
                $messageBloq = '¿Seguro que quieres desbloquear al usuario?';
                $jscodeBloq = 'confirmAction('.json_encode($messageBloq).');';
                echo '<button class="btn b_margen" onclick="return '.htmlspecialchars($jscodeBloq).'" type="submit" name="DesbloqUsuario">Desbloquear usuario</button></div>';
            }

            if (isset($_POST['borrarUsuario'])) {
                $ok = Usuario::deleteUser($p);
                ?>
                <script type="text/javascript">
                window.location.href = "/admin";
                </script>
                <?php
                //header("Location: /admin");                
            } 
            else if (isset($_POST['bloqUsuario'])) {
                $ok = Usuario::bloqUser($p);
                ?>
                <script type="text/javascript">
                window.location.href = "/usuario?id=<?php echo $p;?>";
                </script>
                <?php
                //header("Location: /usuario?id=".$p);
            }
            else if (isset($_POST['DesbloqUsuario'])) {
                $ok = Usuario::bloqUser($p);
                ?>
                <script type="text/javascript">
                window.location.href = "/usuario?id=<?php echo $p;?>";
                </script>
                <?php
                //header("Location: /usuario?id=".$p);

            }   

        }
        
        echo "<h3>Mis artículos</h3>";

        echo "<div class='productosInicio'>";
            echo Producto::mostrarProductosUser($_GET['id']);
        echo "</div>";

        echo"<h3>Artículos comprados</h3>";

        echo "<div class='productosInicio'>";
            echo Producto::mostrarProductosComprador($_GET['id']);
        echo"</div>";
        ?>
    </div>
    <?php
    


}    
