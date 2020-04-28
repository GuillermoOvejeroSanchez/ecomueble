<?php
    require_once __DIR__.'/Form.php';
    require_once __DIR__.'/Usuario.php';
    require_once __DIR__.'/Aplicacion.php';

    class FormularioRegistro extends Form{

        public function __construct(){
            parent::__construct('formRegistro', ['action' =>'registrar']);
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
            $result = array();
            $conn = Aplicacion::getSingleton()->conexionBd();
            
            //Campos introducidos en el form
            $user = new Usuario($form['username'], $form['email'], $form['tlfn']);
            $hash = password_hash($form['password'], PASSWORD_BCRYPT);
            $user->password = $hash;

            //Validar email
            $valid = TRUE;
            $msg = "";
            if (!filter_var($user->email, FILTER_VALIDATE_EMAIL)) {
                $valid = FALSE;
                $msg .= "email no válido\n";
            }

            //Comprobar si existe user,email,tlfn
            $sql = $user->checkUser(); 
            $existe = FALSE;

            if ($valid and $resultado = $conn->query($sql)) { 
                if ($resultado->num_rows > 0) {
                    $existe = TRUE;
                    $msg = "Ya existe un usuario con ese ";
                    //Comprobar cuales son los repetidos
                    $user_fetched = $resultado->fetch_assoc();
                    if($user_fetched['nombre'] == $user->nombre) $msg .= "nombre ";
                    if($user_fetched['email'] == $user->email) $msg .= "email ";
                } 
            }

            //Es valido y no existe
            if($valid and !$existe){
                //El require va aqui????/////////////////////////////////////////////////////////////
                require('./img.php');
                //Guardar img en server y session de la imagen
                $imgPath = saveImg("./profile_img/" , $user->nombre);
                $imgPath = empty($imgPath) ? "default_profile.jpg" : $imgPath; //Si no ponemos imagen o no es valida, nos selecciona una por defecto
                $user->imagen = $imgPath;
                //Query SQL
                $sql = $user->insertUser();
                
                if($conn->query($sql) === TRUE){
                    $_SESSION['registrado'] = TRUE;
                    $_SESSION['login'] = TRUE;
                    // No se si esto se pasa asi, REVISAR!!!!! ///////////////////////////////////////////
                    $_SESSION['username'] = $user->nombre;
                    $_SESSION['saldo'] = $user->saldo;
                    $_SESSION['profile_pic'] = $user->imagen;
                    $_SESSION['idUsuario'] = $user->idUsuario;

                    $result = '/';
                }
            }
            else{
                //Mensajes de alerta saber que campo falla
                $_SESSION['fail_msg'] = $msg;
            }

            return $result;
        }
    }

?>