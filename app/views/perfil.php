<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require('./common/head.php')?>
    <title>Perfil <?php echo getName();?></title>
</head>

<body>
    <?php
        require('./common/cabecera.php');
    ?>
    <div class="perfil"> 
        <?php
        $imagen = "../profile_img/" . $_SESSION['profile_pic'];
        $nombre = $_SESSION['username'];//estas variables hay que cambiarlo por las que obtienes del modelo
                                        // y añadir las que faltan
       
        
        echo" <table> <tr> <th class='imagen'> <img src='$imagen' alt='imagen'></th> 
                            <th class='datos'><p>Nombre: $nombre</p>
                                            <p>Email: </p>
                                            <p>Teléfono: </p></th>
              </tr> </table>
           ";//Imagen de perfil y datos informativos

        echo "<div class='bperfil'><button type='submit' name='subirProducto'>Subir Producto</button>
        <button type='submit' name='editarPerfil'>Editar Perfil</button></div>";//botones
       
        echo "<h3>Mis articulos</h3>" //articulos  Cuando tengamos producto subidos hay que añadir que se muestren.
        ?>
    </div>  
</body>

</html>



<?php

function getName()
{
    return isset($_SESSION['username']) ? $_SESSION['username'] : "";
}

?>
