<?php
    require_once __DIR__.'/Form.php';
    require_once __DIR__.'/Producto.php';
    require_once __DIR__.'/Categoria.php';

    class FormularioSubir extends Form{

        public function __construct(){
            parent::__construct('formSubir', ['action' =>'subir']);
        }

        protected function generaCamposFormulario($form){
            $nombre='';
            if($form){
                $nombre=isset($form['nombre']) ? $form['nombre'] : $nombre;
            }
            $html=
            '<fieldset>
                <legend> Subir producto </legend>
                <div><label>Nombre del producto: </label> <input type="text" name="nombre" placeholder="Nombre del producto" required /></div>
                <div><label>Descripción: </label> <input type="text" name="description" placeholder="Breve descripción" /></div>
                <div><label>Precio: </label> <input type="text" name="price" placeholder="Precio" required /></div>
                <div><label>Imagen del producto: </label> <input type="file" name="imagen" placeholder="Inserte imagen" /></div>
                <label>Elige una categoría:</label>
                <select id="categoria" name="categoria" form="product_form">';
                
                $arrayTags = getTags();
                foreach ($arrayTags as $key => $value) {
                    $html.= '<option value="'.$key.'">'.$value.'</option>';
                }
             
            $html.='   </select>
                <div><button type="submit" name="submit_subir">Subir producto</button></div>
            </fieldset>';
            
            return $html;
        }

        protected function procesaFormulario($form){
            $result = array();
            $conn = Aplicacion::getSingleton()->conexionBd();

            //Campos introducidos en el form
            $product = new Producto();
            $product->descripcion = $form['description'];
            $product->precio = $form['price'];
            $product->nombre = $form['nombre'];

            $product->idUsuario = $_SESSION['idUsuario'];

            $categoria = new Categoria($form['categoria']);
            //idCategoria para insertar en producto
            $sql = $categoria->getIDCategoria();
            if($resultado = $conn->query($sql)){
                $cat_fetched = $resultado->fetch_assoc();
                $product->idCategoria = $cat_fetched['idCategoria'];
            }
            
            //Guardar imagen del producto
        
            //El require va aqui????/////////////////////////////////////////////////////////////
            require('./img.php');
            $imgPro = saveImg("./product_img/" , $product->nombre);
            $imgPro = empty($imgPro) ? "default_profile.jpg" : $imgPro;
            $product->imagen = $imgPro;

            //Subir producto a BD
            $sql = $product->insertProduct();
            if($conn->query($sql)){
                //Enviar mensaje, subido con exito
                $_POST['submit_producto'] = TRUE;
                $result = '/perfil';
            }else{
                //Enviar mensaje, no se ha podido subir
                $_POST['submit_producto'] = FALSE;
                $result[] = "Error subiendo producto.\n";
            }
            
            return $result;
        }   
    }

?>