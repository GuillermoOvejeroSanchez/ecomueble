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
 
            $user = new Usuario();
            $user->nombre = $form['username'];
            $user->password = $form['password'];

            //Comprobar si existe user,email,tlfn
            return $user->logUser();
        
        }
    }
?>