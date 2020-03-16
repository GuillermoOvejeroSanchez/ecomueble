<?php


isset($_SESSION['login']) ? logged() : not_logged();

function logged()
{
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