<?php
    //Doble seguridad: unset + destroy
    unset($_SESSION["login"]);
    unset($_SESSION["esAdmin"]);
    unset($_SESSION["nombre"]);
    unset($_SESSION['username']);
    unset($_SESSION['login']);
    unset($_SESSION['saldo']);
    unset($_SESSION['profile_pic']);
    unset($_SESSION['idUsuario']);
    session_destroy();
    //header("Location: /");
?>

<!DOCTYPE html>
<html lang="es">
<head>
<link rel="stylesheet" type="text/css" href="new.css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>¡Vuelve pronto!</title>
</head>

    <body>

    <?php
        require("./includes/common/cabecera.php");

        //header("refresh:2;url=/");
        ?>
        <script type="text/javascript">
        setTimeout(function(){ window.location.href= '/';}, 1500);
        </script>
        <?php
        ?>

        <div class="per">
            <h1>¡Hasta pronto!</h1>

        </div>



    </body>
</html>