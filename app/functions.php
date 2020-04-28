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
    $sql = Categoria::getAllTags();
    $arrayTags;
    if($resultado = $conn->query($sql)){
        while ($fila = $resultado->fetch_assoc()) {
            $tipo = $fila['tipo'];
            $arrayTags[$tipo] = ucfirst($tipo);
        }
        return $arrayTags;
    }
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