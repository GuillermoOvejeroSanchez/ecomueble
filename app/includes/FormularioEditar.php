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
                //Esto no se como ponerlo bonico
                $html = " 
                    <div class='perfil'> 
                    <table> 
                        <tr>
                            <th class='imagen'> <img src='$imagen' alt='imagen'> <input type='file' name='imagen' value='Subir nueva foto'/> </th> 
                            <th class='datos'><p>Nombre: <input type='text' name='username' value='".$user->nombre."'/></p> 
                            <p>Email: <input type='text' name='email' value='".$user->email."'/></p>
                            <p>Teléfono: <input type='text' name='telefono' value='".$user->telefono."'/></p>
                            <p>Contraseña actual: <input type='password' name='oldPass'/></p>
                            <p>Nueva contraseña: <input type='password' name='newPass'/></p>
                            <p>Confirma su contraseña: <input type='password' name='confirmPass'/></p>

                            <p><input type='submit' name='submit_editar' value='Guardar cambios'></p>
                            </th>
                        </tr> 
                    </table>
                   </div>";

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

            //Comprobar si existe user,email
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
            //check if email and username are duplicated

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

            //$errores[] = "TEST";
            
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
?>