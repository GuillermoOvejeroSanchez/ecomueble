<?php
    require_once __DIR__.'/Form.php';
    require_once __DIR__.'/Usuario.php';
    require_once __DIR__.'/Aplicacion.php';
    class FormularioLogin extends Form{

        public function __construct(){
            parent:: __construct('loginForm', ['action' =>'login']);
        }

        protected function generaCamposFormulario($form){
            $nombre='';
            if($form){
                $nombre=isset($form['nombre']) ? $form['nombre'] : $nombre;
            }
            $html='
            <fieldset>
                <legend> Iniciar Sesión </legend>
                <div><label>Nombre de usuario</label><input type="text" name="username"/></div>
                <div><label>Password</label><input type="password" name="password" /></div>
                <div class="b"><button  type="submit" name="submit_login">Entrar</button></div>
            </fieldset>';
            return $html;
        }

        protected function procesaFormulario($form){
            //Campos introducidos en el form
            $conn = Aplicacion::getSingleton()->conexionBd();

            $user = new Usuario();
            $user->nombre = $form['username'];
            $user->password = $form['password'];

            //Comprobar si existe user,email,tlfn
            $sql = $user->logUser();

            if ($resultado = $conn->query($sql)) { 
                if ($resultado->num_rows > 0 and $resultado->num_rows === 1) {
                    $user_fetched = $resultado->fetch_assoc();
                    $ok = password_verify($user->password, $user_fetched['password']); 
                    if ($ok) {
                        $_SESSION['login'] = TRUE;
                        $_SESSION['username'] = $user_fetched['nombre'];
                        $_SESSION['saldo'] = $user_fetched['saldo'];
                        $_SESSION['profile_pic'] = $user_fetched['imagen'];
                        $_SESSION['idUsuario'] = $user_fetched['idUsuario'];
                        
                        if ($user_fetched['tipoUsuario'] == 1) {
                            $_SESSION['admin'] = TRUE;
                        }
                        return '/';
                    }
                } 
            }
            return ['Error al logear', 'Usuario o contraseña incorrectas', ];
        }
        
        
    }

?>