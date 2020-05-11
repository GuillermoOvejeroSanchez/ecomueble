<?php
    require_once __DIR__.'/Form.php'; 
    require_once __DIR__.'/Aplicacion.php';

    class FormularioEditarProducto extends Form{
        

        public function __construct($id){
            parent::__construct('formEditarProducto', ['action' =>'editarProducto?id=' . $id, 'enctype' => 'multipart/form-data']);
        }

        protected function generaCamposFormulario($form){
            $id = $_GET['id'];//Cogemos nombre user para realizar consulta
            $product = Producto::getProduct($id);
            $imagen = "../product_img/" . $product->imagen;
            ?>
                <?php
                //Esto no se como ponerlo bonico
                $html = " 
                    <fieldset>
                    <legend> Editar Producto </legend>
                    <table> 
                        <tr>
                            <th class='editarImg'> 
                               <div><img src='$imagen' alt='imagen'> <input type='file' name='imagen'/></div> 
                            </th> 
                        </tr>
                        <tr>
                            <th>
                            <div><label>Nombre: </label><input type='text' name='nombre' value='".$product->nombre."'/></div>
                            <div><label>Precio: </label><input type='text' name='precio' value='".$product->precio."'/></div>
                            <div><label>Descripción: </label><input type='text' name='descripcion' value='".$product->descripcion."'/></div>

                            <div><button type='submit' name='submit_editarProducto'>Guardar cambios</button></div>
                          </th> 
                        </tr> 
                    </table>
                    </fieldset>";

                   return $html;
        }

        protected function procesaFormulario($form){
            //profile, username, email, telefono, oldPass, newPass form

            

            $id = $_GET['id']; //Cogemos id articulo para realizar consulta
            $product = Producto::getProduct($id);

            $errores[] = "Algo salió mal";
          
            if(!empty($form['nombre'])){
                $product->nombre = $form['nombre'];
            }

            //Comprobar si existe user,email
            if(!empty($form['precio'])){
                $product->precio = $form['precio'];
            }
            
            if(!empty($form['descripcion'])){
                $product->descripcion = $form['descripcion'];
            }

            //Es valido y no existe
            if(!empty($_FILES['imagen']['name'])){
                require('./img.php');
                //Guardar img en server y session de la imagen
                $imgPath = saveImg("./product_img/" , $product->nombre);
                $imgPath = empty($imgPath) ? "default_profile.jpg" : $imgPath; //Si no ponemos imagen o no es valida, nos selecciona una por defecto
                $product->imagen = $imgPath;
            }
           

            //$errores[] = "TEST";
            
                $ok = $product->updateProduct();
                if($ok){
                    return "/articulo?id=".$id;
                }
            
            return $errores;
    }
}
?>