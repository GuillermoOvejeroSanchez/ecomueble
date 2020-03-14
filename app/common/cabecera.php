<div class="logo"><a href="./index.php"><img src="./img/logo.jpg" alt="Logo"></a></div>

<div class="status">
   <form action="./status_redirect.php" method="post">
    <?php 
    if(isset($_SESSION['login'])){
        $user = $_SESSION['username'];
        $saldo = $_SESSION['saldo'];
        $imagen = $_SESSION['imagen'];
        
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
        <li><a href="./index.php">Inicio</a></li>
        <li><a href="./catalogo.php">Catalogo</a></li>
        <li><a href="./chat.php">Chat</a></li>
        <li><a href="./perfil.php">Perfil</a></li>
        <li><a href="./about.php">Sobre nosotros</a></li>
    </ul>
</nav>