<?php

function secure_input($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function subir(){
    //Guardar imagen del producto
    $imgPro=saveImg("../product_img/" , $productname);
    $imgPro = empty($imgPro) ? "default_profile.jpg" : $imgPro;  
}

function getTags(){
    $app = Aplicacion::getSingleton();
    $conn = $app->conexionBd();
    $arrayTags = Categoria::getAllTags();
    return $arrayTags;
}

function not_logged() {
    ?>
<div class="noReg">
    <img src="img/warning.png" alt="Atención">
    <p>¡Regístrate o inicia sesión para acceder!</p>
</div>
<?php
}

?>