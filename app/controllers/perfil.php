<?php
require('./models/Usuario.php');
require_once('./bd.php');

isset($_SESSION['login']) ? logged() : not_logged();

function logged()
{
    $user = new Usuario("", "", "" , "");
    $p = $_SESSION['username'];
    $slq = $user->getUser($p);
    $resultado = $GLOBALS['conn']->query($slq); //he puesto la variable conn global en la bd porque sino no me dejaba usarla aqui no se por qué:(
    $usu = $resultado->fetch_assoc();

    $imagen = "../profile_img/" . $usu['imagen'];

    ?>
    <div class="perfil"> 
    <form action="status" method="post">
        <?php
       
        echo" <table> <tr> <th class='imagen'> <img src='$imagen' alt='imagen'></th> 
                            <th class='datos'><p>Nombre: <strong>$usu[nombre]</strong></p> 
                                            <p>Email: <strong>$usu[email]</strong></p>
                                            <p>Teléfono: <strong>$usu[telefono]</strong> </p></th>
              </tr> </table>
           ";//Imagen de perfil y datos informativos

        echo "<div class='bperfil'><button type='submit' name='subirProducto'>Subir Producto</button>
        <button type='submit' name='editarPerfil'>Editar Perfil</button></div>";//botones
       
        echo "<h3>Mis articulos</h3>" //articulos  Cuando tengamos producto subidos hay que añadir que se muestren.
        ?>
    </div>
    <?php
}

function not_logged(Type $var = null)
{
    echo 'No disponible, registrate';
}

function getUser($username)
{
    return 'paco';
}

?>