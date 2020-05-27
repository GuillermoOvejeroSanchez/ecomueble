<?php
    require_once __DIR__.'/FormLib.php';
    require_once __DIR__.'/Usuario.php';
    require_once __DIR__.'/Aplicacion.php';

    function formularioRegistro() {
        formulario('formRegistro', ['action' =>'registrar', 'enctype' => 'multipart/form-data']);
    }

    function generaCamposFormulario($form) {
        $nombre='';
        if($form) {
            $nombre=isset($form['nombre']) ? $form['nombre'] : $nombre;
        }
        $html=
        '<fieldset>
        <legend> Registro </legend>
            <div><label>Nombre de usuario</label><input type="text" id="username" name="username" />
            <img id="error1" src="/img/no.png" />
            <img id="ok1" src="/img/ok.png" /></div>
            <div><label>Email</label><input type="text" id="email" name="email" />
            <img id="error2" src="/img/no.png" />
            <img id="ok2" src="/img/ok.png" /></div>
            <div><label>Teléfono</label><input type="text" id="tlfn" name="tlfn"/>
            <img id="error3" src="/img/no.png" />
            <img id="ok3" src="/img/ok.png" /></div>
            <div><label>Contraseña</label><input type="password" id="pass" autocomplete="on" name="password" />
            <img id="error4" src="/img/no.png" />
            <img id="ok4" src="/img/ok.png" /></div>
            <div><label>Imagen de Perfil</label><input type="file" name="imagen"/></div>
            <div class="b"><button type="submit" id="submit_registrar" name="submit_registrar">Entrar</button></div>
        </fieldset>';
        return $html;
    }

    function procesaFormularioReg($form) {
        $result = array();

        $result[] = "<e>¡Error al Registrarse!</e>";

        $hash = password_hash($form['password'], PASSWORD_BCRYPT);
        $user->password = $hash;

        require('./img.php');
        //Guardar img en server y session de la imagen
        $imgPath = saveImg("./profile_img/" , $user->nombre, "profile");
        $imgPath = empty($imgPath) ? "default_profile.jpg" : $imgPath; //Si no ponemos imagen o no es valida, nos selecciona una por defecto
        $user->imagen = $imgPath;

        //Query SQL
        if($user->insertUser()) {
            $userLog = new Usuario();
            $userLog->nombre = $form['username'];
            $userLog->password = $form['password'];

            return $userLog->logUser();
        }
        return $result;
    }
