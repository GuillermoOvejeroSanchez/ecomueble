<?php
    require_once __DIR__.'/Form.php';
    require_once __DIR__.'/Producto.php';
    require_once __DIR__.'/Categoria.php';

    class FormularioProducto extends Form{
        public function __construct(){
            parent::__construct('formProducto');
        }
        protected function generaCamposFormulario($form){
            $producto='';
            if($form){
                $producto=isset($form['nombre']) ? $form['nombre'] : $producto;
            }
            $html =
            '<fieldset>
            <legend> Subir Producto </legend>
                <div><label>Nombre del producto</label><input type="text" name="nombre" /></div>
                <div><label>Descripcion</label><input type="text" name="description" /></div>
                <div><label>Precio</label><input type="text" name="price"/></div>
                <div><label>Imagen del producto</label><input type="file" name="imagen"/></div>
                <label for="categoria">Elige una categoría:</label>
                <select id="categoria" name="categoria" form="product_form">
                    ';
                        require("./controllers/subir.php");
                        $arrayTags = getTags();
                        foreach ($arrayTags as $key => $value) {
                            $value = "<option value=".$key.">".$value."</option>";
                            $html .= $value;
                        }
                 $html .= '</select>
                <div class="b"><button type="submit" name="submit_producto">Subir</button></div>
            </fieldset>';
            return $html;
        }

        protected function procesaProducto($form){
            $conn = connBD();
            $msg="";
            $valid=TRUE;
            if (!empty($_POST['nombre']) and !empty($_POST['description']) and !empty($_POST['price']) and !empty($_POST['categoria'])) {
                $nombre = secure_input($_POST['nombre']);
                $description = secure_input($_POST['description']);
                $price = secure_input($_POST['price']);
                $tipoMueble = secure_input($_POST['categoria']);
            }
            $product=new Producto($form['nombre'], $form['description'], $form['price'], $form['categoria']);

            $product->idUsuario = $_SESSION['idUsuario'];
            $product->nombre = $nombre;
            $product->descripcion = $description;
            $product->precio = $price;

            $categoria = new Categoria($tipoMueble);
            $sql = $categoria->getIDCategoria();
            if($resultado = $conn->query($sql)){
                $cat_fetched = $resultado->fetch_assoc();
                $product->idCategoria = $cat_fetched['idCategoria'];
            }
            $imgPro = saveImg("./product_img/" , $nombre);
            $imgPro = empty($imgPro) ? "default_profile.jpg" : $imgPro;
            $product->imagen = $imgPro;

            $sql = $product->insertProduct();
            if($conn->query($sql)){
                $_SESSION['subido'] = TRUE;
            }else{
                $_SESSION['fail_msg'] = $msg;
            }

            $conn->close();
        }

    }

?>