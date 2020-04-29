<?php
    require_once __DIR__.'/Form.php';
    require_once __DIR__.'/Usuario.php';
    require_once __DIR__.'/Aplicacion.php';

    class FormularioRegistro extends Form{

        public function __construct(){
            parent::__construct('formRegistro', ['action' =>'registrar', 'enctype' => 'multipart/form-data']);
        }

        protected function generaCamposFormulario($form){
            $nombre='';
            if($form){
                $nombre=isset($form['nombre']) ? $form['nombre'] : $nombre;
            }
            $html=
            '<fieldset>
            <legend> Registro </legend>
                <div><label>Nombre de usuario</label><input type="text" name="username" /></div>
                <div><label>Email</label><input type="text" name="email" /></div>
                <div><label>Teléfono</label><input type="text" name="tlfn"/></div>
                <div><label>Contraseña</label><input type="password" name="password" /></div>
                <div><label>Imagen de Perfil</label><input type="file" name="imagen"/></div>
                <div class="b"><button type="submit" name="submit_registrar">Entrar</button></div>
            </fieldset>';
            return $html;
        }

        protected function procesaFormulario($form){
            $result[] = "<a>¡Error al Registrarse!</a>";
           
            $username = isset($form['username']) ? $form['username'] : null;
            if ( empty($username) ) {
                $result[] = "El nombre de usuario no puede estar vacío";
            }
            
            $email = isset($form['email']) ? $form['email'] : null;
            if ( empty($email) ) {
                $result[] = "El email no puede estar vacío";
            }

            $telefono = isset($form['tlfn']) ? $form['tlfn'] : null;
            if ( empty($telefono) ) {
                $result[] = "El teléfono de usuario no puede estar vacío";
            }

            $password = isset($form['password']) ? $form['password'] : null;
            if ( empty($password) ) {
                $result[] = "El password no puede estar vacío.";
            }
    
            if (count($result) === 1) {

                //Campos introducidos en el form
                $user = new Usuario($username, $email, $telefono);
                $hash = password_hash($password, PASSWORD_BCRYPT);
                $user->password = $hash;

                //Validar email
                $valid = TRUE;
                if (!filter_var($user->email, FILTER_VALIDATE_EMAIL)) {
                    $valid = FALSE;
                    $result[] = "Email no válido";
                }

                //Comprobar si existe user,email,tlfn
                $existe = $user->checkUser($valid); 

            //Es valido y no existe
            if($valid and !$existe){
                require('./img.php');
                //Guardar img en server y session de la imagen
                $imgPath = saveImg("./profile_img/" , $user->nombre);
                $imgPath = empty($imgPath) ? "default_profile.jpg" : $imgPath; //Si no ponemos imagen o no es valida, nos selecciona una por defecto
                $user->imagen = $imgPath;
                
                //Query SQL
                if($user->insertUser()){
                    $userLog = new Usuario();
                    $userLog->nombre = $form['username'];
                    $userLog->password = $form['password'];
        
                    //Comprobar si existe user,email,tlfn
                    return $userLog->logUser();
                }
            }
            return $result;
           
        }
    }
}
?>