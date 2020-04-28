<?php

    //Comprobar campos
    if (isset($_POST['submit_producto'])) {
       // session_start();
       // require_once('./includes/Aplicacion.php');
       // require('./includes/Producto.php');
       // require('./includes/Categoria.php');
       // require('./img.php');
        //$conn = connBD();
        $app = Aplicacion::getSingleton();
        $conn = $app->conexionBd();
    
        //Secure input
        if (!empty($_POST['nombre']) and !empty($_POST['description']) and !empty($_POST['price']) and !empty($_POST['categoria'])) {
            $nombre = secure_input($_POST['nombre']);
            $description = secure_input($_POST['description']);
            $price = secure_input($_POST['price']);
            $tipoMueble = secure_input($_POST['categoria']);
        }

        //Enviar datos al modelo
        $form = array(
            "nombre" => $nombre,
            "description" => $description,
            "price" => $price,
            "categoria" => $tipoMueble,
        );

        //require_once("./subir.php");
        
        //si sube el articulo correctamente va al perfil
        if (isset($_POST['submit_producto']) and $__POST['submit_producto'] == TRUE) {
            //unset($__POST['submit_producto']);
            //header("Location: /perfil");
        }
        //si no vuelve a subir para mostrar un mensaje de error
        else{
            //header("Location: /subir");
        }
    }
    /*
        //////////////////////////////////////////////////////////
        //Modelos de Producto y Categoria
        $product = new Producto();
        $product->idUsuario = $_SESSION['idUsuario'];
        $product->nombre = $nombre;
        $product->descripcion = $description;
        $product->precio = $price;
        
        $categoria = new Categoria($tipoMueble);
        
        //idCategoria para insertar en producto
        $sql = $categoria->getIDCategoria();
        if($resultado = $conn->query($sql)){
            $cat_fetched = $resultado->fetch_assoc();
            $product->idCategoria = $cat_fetched['idCategoria'];
        }
        
        //Guardar imagen del producto
        $imgPro = saveImg("./product_img/" , $nombre);
        $imgPro = empty($imgPro) ? "default_profile.jpg" : $imgPro;
        $product->imagen = $imgPro;
        
        //Subir producto a BD
        $sql = $product->insertProduct();
        if($conn->query($sql)){
            //Enviar mensaje, subido con exito
        }else{
            //Enviar mensaje, no se ha podido subir
        }
        header("Location: /perfil");
        
       // $conn->close();
        }

        if (isset($_POST['submit_producto'])) {
            submitProduct();
        }
        ////////////////////////////////////////////////////
    */
?>