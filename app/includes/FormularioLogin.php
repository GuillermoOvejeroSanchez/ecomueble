<?php
    require_once __DIR__.'/FormLib.php';
    require_once __DIR__.'/Usuario.php';
    require_once __DIR__.'/Aplicacion.php';

    function formularioLogin() {
        formulario('loginForm', ['action' =>'login']);
    }

    function generaCamposFormulario($form) {
        $nombre='';
        if($form) {
            $nombre=isset($form['nombre']) ? $form['nombre'] : $nombre;
        }
        $html='
        <fieldset>
            <legend> Iniciar Sesión </legend>
            <div><label>Nombre de usuario</label><input type="text" id="username" name="username"/>
            <img id="error1" src="/img/no.png" />
            <img id="ok1" src="/img/ok.png" /></div>
            <div><label>Password</label><input type="password" id="pass" name="password" />
            <img id="error2" src="/img/no.png" />
            <img id="ok2" src="/img/ok.png" /></div>
            <div><button  type="submit" id="submit_login" name="submit_login">Entrar</button></div>
        </fieldset>';
        return $html;
    }

    function procesaFormularioLogin($form) {

        $resultado = array();
            
        $user = new Usuario();
        $user->nombre = $form['username'];
        $user->password = $form['password'];

        $resultado[] = $user->logUser();
        if(end($resultado) == "/") {
            return "/";
        } else {
            $resultado[] = "<e>¡Error al iniciar sesión!</e>";
        }

        return $resultado;
    }