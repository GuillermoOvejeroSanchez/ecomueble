<?php
require('./includes/Usuario.php');
require('./includes/Producto.php');
require('./includes/Categoria.php');

isset($_SESSION['login']) ? logged() : not_logged();



function logged()
{
    $p = $_GET['id']; //Cogemos id user para realizar consulta
    $user = Usuario::getUserbyId($p);
    $imagen = "../profile_img/" . $user->imagen;

    ?>
    <div class="perfil"> 
    <form action="status" method="post">
        <?php
        echo" <table class='per'> <tr> <th class='imagen'> <img src='$imagen' alt='imagen'></th> 
                            <th class='datos'><p>Nombre: <strong>$user->nombre</strong></p> 
                                            <p>Email: <strong>$user->email</strong></p>
                                            <p>Teléfono: <strong>$user->telefono</strong> </p></th>
              </tr> </table>
           ";//Imagen de perfil y datos informativos

        if($_SESSION['idUsuario'] == $user->idUsuario){
            echo "<div class='bperfil'><button type='submit' name='subirProducto'>Subir Producto</button>
            <button type='submit' name='editarPerfil'>Editar Perfil</button></div>";//botones
        }
        ?>
    </form>
    <form action="" method="post">
        <?php
        if(isset($_SESSION['admin'])){
            $messageDelete = '¿Seguro que quieres borrar el usuario?';
            $jscodeDelete = 'confirmAction('.json_encode($messageDelete).');';           
            echo '<div class="badmin"><button onclick="return '.htmlspecialchars($jscodeDelete).'" type="submit" name="borrarUsuario">Eliminar usuario</button>';
            if($user->bloq == 0) {   
                $messageBloq = '¿Seguro que quieres bloquear al usuario?';
                $jscodeBloq = 'confirmAction('.json_encode($messageBloq).');';
               echo '<button onclick="return '.htmlspecialchars($jscodeBloq).'" type="submit" name="bloqUsuario">Bloquear usuario</button></div>';
            } else {
                $messageBloq = '¿Seguro que quieres desbloquear al usuario?';
                $jscodeBloq = 'confirmAction('.json_encode($messageBloq).');';
                echo '<button onclick="return '.htmlspecialchars($jscodeBloq).'" type="submit" name="DesbloqUsuario">Desbloquear usuario</button></div>';
            }

            if (isset($_POST['borrarUsuario'])) {
                $ok = Usuario::deleteUser($p);
                header("Location: /admin");                
            } 
            else if (isset($_POST['bloqUsuario'])) {
                $ok = Usuario::bloqUser($p);
                header("Location: /usuario?id=".$p);
            }
            else if (isset($_POST['DesbloqUsuario'])) {
                $ok = Usuario::bloqUser($p);
                header("Location: /usuario?id=".$p);
            }

        }
        
        echo "<h3>Mis articulos</h3>"; //articulos  Cuando tengamos producto subidos hay que añadir que se muestren.
        //echo "<div class='bperfil'><button type='submit' name='edit_btn'>Editar Productos</button>";
        echo "<div class='productos'>";
            mostrarProductosUser($_GET['id']);
        echo "</div>";
        ?>
    </div>
    <?php
    


}


function mostrarProductosUser($idUsuario)
{
    $links_id = Producto::getAllProductsFromUser($idUsuario);
    if(count($links_id) != 0){
        foreach ($links_id as $key => $value) {
            echo "<a href='".$key."'><img src='".$value."' alt='imagen'></a>";
        }
    }else{
        echo "<label>Este usuario no tiene articulos</label>";
    }
}    
?>