<?php
    require_once __DIR__.'/FormLib.php'; 
    require_once __DIR__.'/Usuario.php';
    require_once __DIR__.'/Aplicacion.php';


    function formularioEditar() {
        formulario('formEditar', ['action' =>'editar', 'enctype' => 'multipart/form-data']);
    }

    function generaCamposFormulario($form) {
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
                    <div><label>Nombre: </label><input type='text' id='username' name='username' value='".$user->nombre."'/>
                    <img id='error1' src='/img/no.png' />
                    <img id='ok1' src='/img/ok.png' /></div>
                    <div><label>Email: </label><input type='text' id='email' name='email' value='".$user->email."'/>
                    <img id='error2' src='/img/no.png' />
                    <img id='ok2' src='/img/ok.png' /></div>
                    <div><label>Teléfono: </label><input type='text'  id='tlfn' name='telefono' value='".$user->telefono."'/>
                    <img id='error3' src='/img/no.png' />
                    <img id='ok3' src='/img/ok.png' /></div>
                    <div><label>Contraseña actual: </label><input type='password' id='oldPass' autocomplete='on' name='oldPass'/>
                    <img id='error4' src='/img/no.png' />
                    <img id='ok4' src='/img/ok.png' /></div>
                    <div><label>Nueva contraseña: </label><input type='password' id='newpass1' autocomplete='on' name='newPass'/></div>
                    <img id='error5' src='/img/no.png' />
                    <img id='ok5' src='/img/ok.png' /></div>
                    <div><label>Confirma tu nueva contraseña: </label><input type='password' id='newpass2' autocomplete='on' name='confirmPass'/>
                    <img id='error6' src='/img/no.png' />
                    <img id='ok6' src='/img/ok.png' /></div>

                    <div><button type='submit' id='submit_editar' name='submit_editar'>Guardar cambios</button></div>
                    </th> 
                </tr> 
            </table>
            </fieldset>";
        return $html;
    }

    function procesaFormularioEditar($form) {
        $errores = [];

        $p = $_SESSION['username']; //Cogemos nombre user para realizar consulta
        $user = Usuario::getUser($p);

        if($user->nombre !== $form['username']) {
            $user->nombre = $form['username'];
        }

        if($user->email !== $form['email']) {
            $user->email = $form['email'];
        }

        if($user->telefono !== $form['telefono']) {
            $user->telefono = $form['telefono'];
        }

        //Si subimos una imagen nueva:
        if(!empty($_FILES['imagen']['name'])) {
            require('./img.php');
            //Guardar img en server y session de la imagen
            $imgPath = saveImg("./profile_img/" , $user->nombre);
            $imgPath = empty($imgPath) ? "default_profile.jpg" : $imgPath; //Si no ponemos imagen o no es valida, nos selecciona una por defecto
            $user->imagen = $imgPath;
            $_SESSION['profile_pic'] = $user->imagen;
        }

        if($form['newPass'] !== $form['oldPass'] ) {
            if(password_verify($form['oldPass'], $user->password)) {
                $hash = password_hash($form['newPass'], PASSWORD_BCRYPT);
                $user->password = $hash;
            } else {
                $errores[] = "La contraseña introducida no es correcta.";
            }
            
        }

        if(count($errores) === 0) {
            $ok = $user->updateUser();
            if($ok){
                $_SESSION['username'] = $user->nombre;
                return '/perfil';
            }
        }
        return $errores;
    }
