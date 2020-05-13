<?php
if(isset($_REQUEST['login_btn'])) {
    //header("Location: login");
    ?>
    <script type="text/javascript">
    window.location.href = "/login";
    </script>
    <?php
}

elseif (isset($_REQUEST['registrar_btn'])) {
    //header("Location: registrar");
    ?>
    <script type="text/javascript">
    window.location.href = "/registrar";
    </script>
    <?php
}


elseif (isset($_REQUEST['logout_btn'])) {
    //header("Location: logout");
    ?>
    <script type="text/javascript">
    window.location.href = "/logout";
    </script>
    <?php
}
elseif (isset($_REQUEST['subirProducto'])) {
    //header("Location: subir");
    ?>
    <script type="text/javascript">
    window.location.href = "/subir";
    </script>
    <?php
}
elseif (isset($_REQUEST['editarPerfil'])) {
    //header("Location: editar");
    ?>
    <script type="text/javascript">
    window.location.href = "/editar";
    </script>
    <?php
}else {
    //header("Location: 404");
    ?>
    <script type="text/javascript">
    window.location.href = "/404";
    </script>
    <?php
}
die();
