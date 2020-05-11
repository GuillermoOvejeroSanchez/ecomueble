<?php
require('./includes/Usuario.php');
require('./includes/Producto.php');
require('./includes/Categoria.php');

isset($_SESSION['login']) ? logged() : not_logged();

function logged()
{
    $p = $_SESSION['username']; //Cogemos nombre user para realizar consulta
    $user = Usuario::getUser($p);

    $imagen = "../profile_img/" . $user->imagen;

    if(isset($_GET['upload'])){
    ?>
        <script>
            swalUpload();
        </script>
    <?php
       }
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

        echo "<div><button class='btn b_margen' type='submit' name='subirProducto'>Subir Producto</button>
        <button class='btn b_margen' type='submit' name='editarPerfil'>Editar Perfil</button></div>";//botones
       
        echo "<h3>Mis articulos</h3>"; //articulos  Cuando tengamos producto subidos hay que añadir que se muestren.
        //echo "<div class='bperfil'><button type='submit' name='edit_btn'>Editar Productos</button>";

        echo "<div class='productosInicio'>";
            echo Producto::mostrarProductosUser($_SESSION['idUsuario']);

        echo "</div>";
        ?>
    </div>
    <?php
}

?>