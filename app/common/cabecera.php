<div class="status">
   <form action="../status_redirect.php" method="post">
    <?php 
    if(isset($_SESSION['login'])){
        $user = $_SESSION['username'];
        $saldo = $_SESSION['saldo'];
        echo '<span>'. $user . ' Saldo actual: '.$saldo.'</span>
        <button type="submit" name="logout_btn">Logout</button>';
    }else{
        echo '
        <button type="submit" name="login_btn">Login</button>
        <button type="submit" name="registrar_btn">Registrar</button>';
    }
    ?>
    </form>
</div>

<div class="logo"><a href="../index.php"><img src="../img/logo.jpg" alt="Logo"></a></div>

<nav>
    <ul>
        <li><a href="../index.php">Inicio</a></li>
        <li><a href="../catalogo.php">Catalogo</a></li>
        <li><a href="../chat.php">Chat</a></li>
        <li><a href="../perfil.php">Perfil</a></li>
        <li><a href="../about.php">Sobre nosotros</a></li>
    </ul>
</nav>