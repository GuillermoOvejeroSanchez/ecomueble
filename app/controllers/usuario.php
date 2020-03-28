<?php
require('./models/Usuario.php');
require('./models/Producto.php');
require_once('./bd.php');

isset($_SESSION['login']) ? logged($conn) : not_logged();
$conn->close(); //Importante cerrar siempre la conexion



function logged($conn)
{
    $user = new Usuario(); //Usuario vacio
    $p = $_GET['id']; //Cogemos id user para realizar consulta
    $sql = $user->getUserbyId($p);
    $resultado = $conn->query($sql);
    $user->createUser($resultado->fetch_assoc()); //Creamos un objeto user con los datos de la consulta

    $imagen = "../profile_img/" . $user->imagen;

    ?>
    <div class="perfil"> 
    <form action="status" method="post">
        <?php
        echo" <table> <tr> <th class='imagen'> <img src='$imagen' alt='imagen'></th> 
                            <th class='datos'><p>Nombre: <strong>$user->nombre</strong></p> 
                                            <p>Email: <strong>$user->email</strong></p>
                                            <p>Teléfono: <strong>$user->telefono</strong> </p></th>
              </tr> </table>
           ";//Imagen de perfil y datos informativos

        if($_SESSION['idUsuario'] == $user->idUsuario){
            echo "<div class='bperfil'><button type='submit' name='subirProducto'>Subir Producto</button>
            <button type='submit' name='editarPerfil'>Editar Perfil</button></div>";//botones
        }
        
        echo "<h3>Mis articulos</h3>"; //articulos  Cuando tengamos producto subidos hay que añadir que se muestren.
        //echo "<div class='bperfil'><button type='submit' name='edit_btn'>Editar Productos</button>";
        echo "<div class='productos'>";
            mostrarProductos($_GET['id'], $conn);
        echo "</div>";
        ?>
    </div>
    <?php
}


function mostrarProductos($idUsuario, $conn)
{
    $sql =  Producto::getAllProductsFromUser($idUsuario);
    if($resultado = $conn->query($sql)){
        if($resultado->num_rows > 0){
         while ($fila = $resultado->fetch_assoc()) {
             $product_img = "../product_img/" . $fila['imagen'];
             $nose = "./articulo?id=" .  $fila['idProducto']; 
             
                 ?>
                  <a href=<?php echo "'$nose'"?>><img src=<?php echo "'$product_img'"?> alt='imagen' ></a>
                 <?php
         }
        }
     
    }
}

function not_logged()
{
    ?>
    <div class="noReg">
    <img src="img/warning.png" alt="Atención"><p>¡Regístrate o inicia sesión para acceder!</p>
    </div>
    <?php
}
?>