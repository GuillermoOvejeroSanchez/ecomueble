<?php
    require_once __DIR__.'/Form.php';
    require_once __DIR__.'/Producto.php';
    require_once __DIR__.'/Categoria.php';

    class FormularioSubir extends Form{

        public function __construct(){
            parent::__construct('formSubir', ['action' =>'subir', 'enctype' => 'multipart/form-data']);
        }

        protected function generaCamposFormulario($form){
            $nombre='';
            if($form){
                $nombre=isset($form['nombre']) ? $form['nombre'] : $nombre;
            }
            $html=
            '<fieldset>
                <legend> Subir producto </legend>
                <div><label>Nombre del producto: </label> <input type="text" name="nombre"  required /></div>
                <div><label>Descripción: </label> <input type="text" name="description"  /></div>
                <div><label>Precio: </label> <input type="text" name="price"  required /></div>
                <div><label>Imagen del producto: </label> <input type="file" name="imagen"  /></div>
                <div><label>Elige una categoría:</label>
                <select id="categoria" name="categoria" form="formSubir"></div>';
                
                $arrayTags = getTags();
                foreach ($arrayTags as $key => $value) {
                    $html .= '<option value="'.$key.'">'.$value.'</option>';
                }
             
            $html.='   </select>
                <div><button type="submit" name="submit_subir">Subir producto</button></div>
            </fieldset>';
            
            return $html;
        }

        protected function procesaFormulario($form){
            $result = array();

            //Campos introducidos en el form
            $product = new Producto();
            $product->descripcion = $form['description'];
            $product->precio = $form['price'];
            $product->nombre = $form['nombre'];

            $product->idUsuario = $_SESSION['idUsuario'];

            $categoria = new Categoria($form['categoria']);
            //idCategoria para insertar en producto
            $id = $categoria->getIDCategoria();
            if($id != ""){
                $product->idCategoria = $id;
            }
            
            //Guardar imagen del producto
            require('./img.php');
            $_FILES['imagen']['tmp_name'];
            $imgPro = saveImg("./product_img/" , $product->nombre, $product->idProducto);
            $imgPro = empty($imgPro) ? "default_profile.jpg" : $imgPro;
            $product->imagen = $imgPro;

            //Subir producto a BD
            return $product->insertProduct();
        }   
    }
?>