<?php
    require_once __DIR__.'/Form.php'; 
    require_once __DIR__.'/Aplicacion.php';

    class FormularioEditar extends Form{

        public function __construct(){
            parent::__construct('formEditar', ['action' =>'editar', 'enctype' => 'multipart/form-data']);
        }

        protected function generaCamposFormulario($form){
            $p = $_SESSION['username']; //Cogemos nombre user para realizar consulta
            $user = Usuario::getUser($p);
            $imagen = "../profile_img/" . $user->imagen;
            ?>
                <?php
                $html = " 
                    <fieldset>
                    <legend> Editar Perfil </legend>
                    <table> 
                        <tr>
                            <th class='editarImg'> 
                               <div><img src='$imagen' alt='imagen'> <input type='file' name='imagen'/></div> 
                            </th> 
                        </tr>
                        <tr>
                            <th>
                            <div><label>Nombre: </label><input type='text' name='username' value='".$user->nombre."'/></div>
                            <div><label>Email: </label><input type='text' name='email' value='".$user->email."'/></div>
                            <div><label>Teléfono: </label><input type='text' name='telefono' value='".$user->telefono."'/></div>
                            <div><label>Contraseña actual: </label><input type='password' name='oldPass'/></div>
                            <div><label>Nueva contraseña: </label><input type='password' name='newPass'/></div>
                            <div><label>Confirma su contraseña: </label><input type='password' name='confirmPass'/></div>

                            <div><button type='submit' name='submit_editar'>Guardar cambios</button></div>
                          </th> 
                        </tr> 
                    </table>
                    </fieldset>";

                   return $html;
        }

        protected function procesaFormulario($form){
            //profile, username, email, telefono, oldPass, newPass form

            $errores = [];

            $p = $_SESSION['username']; //Cogemos nombre user para realizar consulta
            $user = Usuario::getUser($p);

            //Validar email
            $valid = TRUE;
            if($user->email !== $form['email']){
                $user->email = $form['email'];
                $error = $user->checkEmail($valid);
                if($error !== "") $errores[] = $error;
            }
            if (!filter_var($user->email, FILTER_VALIDATE_EMAIL)) {
                $valid = FALSE;
                $errores[] = "Email no válido";
            }

            //Comprobar si existe user, email
            if($user->nombre !== $form['username']){
                $user->nombre = $form['username'];
                $error = $user->checkUsername($valid);
                if($error !== "") $errores[] = $error; 
                print_r(count($errores));
            }
            
            //Es valido y no existe
            if($valid and count($errores) === 0 and !empty($_FILES['imagen']['name'])){
                require('./img.php');
                //Guardar img en server y session de la imagen
                $imgPath = saveImg("./profile_img/" , $user->nombre);
                $imgPath = empty($imgPath) ? "default_profile.jpg" : $imgPath; //Si no ponemos imagen o no es valida, nos selecciona una por defecto
                $user->imagen = $imgPath;
                $_SESSION['profile_pic'] = $user->imagen;
            }
            
            if($user->telefono !== $form['telefono'] && strlen($form['telefono']) < 10){
                $user->telefono = $form['telefono'];
            }


            if($form['newPass'] !== "" && $form['newPass'] !== $form['oldPass'] ){
                if($form['newPass'] == $form['confirmPass']){
                    if(password_verify($form['oldPass'], $user->password)){
                        $hash = password_hash($form['newPass'], PASSWORD_BCRYPT);
                        $user->password = $hash;
                    }else{
                        $errores[] = "La contraseña introducida no es correcta";
                    }
                }else{
                    $errores[] = "Las contraseñas no coinciden";
                }
            }
            
            if(count($errores) === 0){
                $ok = $user->updateUser();
                if($ok){
                    $_SESSION['username'] = $user->nombre;
                    return '/perfil';
                }
            }
            return $errores;
    }
}
