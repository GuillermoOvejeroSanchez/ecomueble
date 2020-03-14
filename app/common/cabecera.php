<div class="logo"><a href="/"><img src="./img/logo.jpg" alt="Logo"></a></div>

<div class="status">
   <form action="./status_redirect.php" method="post">
    <?php 
    if(isset($_SESSION['login'])){
        $user = $_SESSION['username'];
        $saldo = $_SESSION['saldo'];
        $imagen = "../profile_img/" . $_SESSION['profile_pic'];

        //TODO Poner todas las fotos del mismo tamaño ej (124x124 px)
        echo  "<img src='$imagen' alt='imagen''>";
        echo '<span>'. $user . ' Saldo actual: '.$saldo.'</span>
        <div class="b"><button type="submit" name="logout_btn">Logout</button></div>';
    }else{
        echo '
        <div class="b"><button type="submit" name="login_btn">Login</button>
        <button type="submit" name="registrar_btn">Registrar</button></div>';
    }
    ?>
    </form>
</div>



<nav>
    <ul>
        <li><a href="/">Inicio</a></li>
        <li><a href="catalogo">Catalogo</a></li>
        <li><a href="chat">Chat</a></li>
        <li><a href="perfil">Perfil</a></li>
        <li><a href="about">Sobre nosotros</a></li>
    </ul>
</nav>