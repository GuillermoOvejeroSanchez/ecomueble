<div class="logo"><a href="index.php"><img src="img/logo.jpg" alt="Logo"></a></div>
<div class="status">
   <!-- <form action="login_form.php" method="post">-->
    <?php 
    /*if(isset($_SESSION['user'])){
        $user = $_SESSION['user'];
        echo '<span>'. $user .'</span>
        <button type="submit" name="logout">Logout</button>';
    }else{
        echo '
        <button type="submit" name="login">Login</button>
        <button type="submit" name="registrar">Registrar</button>';
    }*/
    if(isset($_SESSION['login'])) {
        Echo "<button type='/submit'/ name='/logout'/>Logout</button>'";
    }
    else {
        echo '
        <a href="./login_form.php">Login</a>
        <a href="./login_form.php">Registrar</a>'; //./ porque luego no estaremos en local:)
    }
    ?>
    </form>
</div>
<nav>
    <ul>
        <li><a href="index.php">Inicio</a></li>
        <li><a href="catalogo.php">Catalogo</a></li>
        <li><a href="chat.php">Chat</a></li>
        <li><a href="perfil.php">Perfil</a></li>
        <li><a href="about.php">Sobre nosotros</a></li>
    </ul>
</nav>