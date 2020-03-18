<?
require('../img.php');
    //Comprobar campos
    if (isset($_POST['submit_subir'])) {

        //Secure input
        if (!empty($_POST['productname']) and !empty($_POST['description']) and !empty($_POST['price'])) {
            $username = secure_input($_POST['productname']);
            $email = secure_input($_POST['description']);
            $tlfn = secure_input($_POST['price']);
        }

        //Enviar datos al modelo
        $form = array(
            "productname" => $productname,
            "description" => $description,
            "price" => $price,
        );

        require_once("../models/subir.php");
      
        //si nos sube correctamente va a perfil
        if (isset($_SESSION['subido']) and $_SESSION['subido'] == TRUE) {
            unset($_SESSION['subido']);
            header("Location: /perfil");
        }
        //Pero aquí debería salir un mensaje de error que no se ha subido el producto
        else{
            header("Location: /perfil");
        }
    }
    function secure_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>


