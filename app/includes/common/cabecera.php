<?php
    $map = getButtons();
?>

<cabecera>
    <div class="logo"><a href="/"><img src="./img/logo.png" alt="Logo"></a></div>
    <?php
            if($map['logged']){        ?>
                <div class="proficon">
                <?php
                    echo $map['img'];
                    echo $map['saldo'];
                ?>
                </div>
                <?php }else{}  ?>
</cabecera>

<nav_header>

    <ul class="nav_bar">
        <li><a href="/">Inicio</a></li>
        <li><a href="catalogo">Catálogo</a></li>
        <li><a href="perfil">Perfil</a></li>
        <li><a href="about">Sobre nosotros</a></li>
        <li>
            <?php
            if(isset($_SESSION['admin'])){
                echo '<a href="admin">Administrar</a>';
            }
            ?>
        </li>
    </ul>

    <form action="status" method="post">
        <?php
            if($map['logged']){
                echo $map['logout'];
            }else{
                echo $map['login'];

            }
        ?>
    </form>


</nav_header>
    

<?php
function getButtons()
{

    $map = [];

    if(isset($_SESSION['login'])){
        $user = $_SESSION['username'];
        $saldo = $_SESSION['saldo'];
        $imagen = "../profile_img/" . $_SESSION['profile_pic'];
        
        $message = '¿Quieres salir?';
        $jscode = 'confirmAction('.json_encode($message).');';
    
        $map['logged'] = TRUE;
        $map['img'] =  "<div class='imgprofile'><a href='perfil'><img src='$imagen' alt='imagen''></a></div>";
        $map ['saldo'] = "<div class='textprofile'> <span> $user - Saldo actual: $saldo</span> </div>";
        $map['logout'] = '<div><button class="btn" onclick="return '.htmlspecialchars($jscode).'" type="submit" name="logout_btn">Logout</button></div>';
    }else{
        $map['logged'] = FALSE;
        $map['login'] = '<div><button class="btn" type="submit" name="login_btn">Login</button><button class="btn" type="submit" name="registrar_btn">Registrar</button></div>';
    }

    return $map;
}
