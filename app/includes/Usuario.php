<?php
    require_once __DIR__ . '/Aplicacion.php';

    class Usuario{

        public $idUsuario;
        public $nombre;
        public $email;
        public $telefono;
        public $password;
        public $tipoUsuario;
        public $saldo;
        public $imagen;
        public $bloq;
        public $valoracion;


        function __construct($nombre ="", $email = "", $telefono = "", $password = "", $tipoUsuario = 0, $saldo = 50, $imagen = 'default_profile.jpg', $bloq = 0, $valoracion=10)
        {
            $this->nombre = $nombre;
            $this->email = $email;
            $this->telefono = $telefono;
            $this->password = $password;
            $this->tipoUsuario = $tipoUsuario;
            $this->saldo = $saldo;
            $this->imagen = $imagen;
            $this->bloq = $bloq;
            $this->valoracion=$valoracion;
        }

        /***** FUNCIONES PARA REGISTRAR USUARIO *****/
        public function checkUser($valid)
        {
            $existe = FALSE;
            $conn = Aplicacion::getSingleton()->conexionBd();
            $sql = "SELECT nombre, email, telefono FROM usuario WHERE nombre = '$this->nombre' OR email = '$this->email'";
            $msg ="";
            if ($valid and $resultado = $conn->query($sql)) { 
                if ($resultado->num_rows > 0) {
                    $existe = TRUE;
                    $msg = "Ya existe un usuario con ese ";
                    //Comprobar cuales son los repetidos
                    $user_fetched = $resultado->fetch_assoc();
                    if($user_fetched['nombre'] == $this->nombre) $msg .= "nombre ";
                    if($user_fetched['email'] == $this->email) $msg .= "email ";
                } 
            }
            return $msg;
        }

        public function insertUser()
        {   
            $conn = Aplicacion::getSingleton()->conexionBd();
            $sql = sprintf("INSERT INTO usuario( nombre, email, telefono, password, tipoUsuario, saldo, imagen, bloq, valoracion) 
            VALUES ( '$this->nombre', '$this->email', '$this->telefono' , '$this->password', '$this->tipoUsuario', '$this->saldo', '$this->imagen', '$this->bloq', '$this->valoracion')");
            
            if($conn->query($sql) === TRUE) {
                return TRUE;
            }
            return FALSE;
        }

        /***** FUNCIÓN PARA INICIAR SESIÓN *****/
        public function logUser()
        {
            $conn = Aplicacion::getSingleton()->conexionBd();
            
            $sql = "SELECT idUsuario, nombre, password,tipoUsuario, saldo, imagen, bloq, valoracion FROM usuario WHERE (nombre = '$this->nombre' OR email = '$this->nombre')";

            if ($resultado = $conn->query($sql)) { 
                if ($resultado->num_rows > 0 and $resultado->num_rows === 1) {
                    $user_fetched = $resultado->fetch_assoc();

                    $ok = password_verify($this->password, $user_fetched['password']); 
                    if ($ok) {
                        if($user_fetched['bloq'] == 1){ 
                            return "Tu cuenta está bloqueada temporalmente.";
                        }
                        $_SESSION['login'] = TRUE;
                        $_SESSION['username'] = $user_fetched['nombre'];
                        $_SESSION['saldo'] = $user_fetched['saldo'];
                        $_SESSION['profile_pic'] = $user_fetched['imagen'];
                        $_SESSION['idUsuario'] = $user_fetched['idUsuario'];
                        
                        if ($user_fetched['tipoUsuario'] == 1) {
                            $_SESSION['admin'] = TRUE;
                        }
                        return  '/';
                    }
                } 
            }
            return "Usuario o Contraseña no coinciden";
        }

        /***** FUNCIONES PARA COMPROBAR QUE NO SE REPITAN NOMBRE, EMAIL O TELÉFONO AL CREAR O ACTUALIZAR PERFIL *****/
        public function checkUsername($nombre)
        {
            $app = Aplicacion::getSingleton();
            $conn = $app->conexionBd();
            
            $sql = "SELECT idUsuario, nombre FROM usuario WHERE nombre = '$nombre'";
            $msg ="";
            if ($resultado = $conn->query($sql)) {
                if ($resultado->num_rows > 0) {
                    $user_fetched = $resultado->fetch_assoc();
                    if($user_fetched['idUsuario'] != $_SESSION['idUsuario']) {
                        $msg = "Ya existe un usuario con ese nombre.";
                    }
                }
            }
            return $msg;
        }

        public function checkEmail($email)
        {
            $conn = Aplicacion::getSingleton()->conexionBd();
            $sql = "SELECT idUsuario, email FROM usuario WHERE email = '$email'";
            $msg ="";
            if ($resultado = $conn->query($sql)) { 
                if ($resultado->num_rows > 0) {
                    $user_fetched = $resultado->fetch_assoc();
                    if($user_fetched['idUsuario'] != $_SESSION['idUsuario']) {
                        $msg = "Ya existe un usuario con ese email.";
                    }
                } 
            }
            return $msg;
        }

        public function checkTlfn($telefono)
        {
            $conn = Aplicacion::getSingleton()->conexionBd();
            $sql = "SELECT idUsuario, telefono FROM usuario WHERE telefono = '$telefono'";
            $msg ="";
            if ($resultado = $conn->query($sql)) { 
                if ($resultado->num_rows > 0) {
                    $user_fetched = $resultado->fetch_assoc();
                    if($user_fetched['idUsuario'] != $_SESSION['idUsuario']) {
                        $msg = "Ya existe un usuario con ese teléfono.";
                    }
                } 
            }
            return $msg;
        }

        public function updateUser()
        {
            $app = Aplicacion::getSingleton();
            $conn = $app->conexionBd();

            $sql = "UPDATE usuario SET nombre = '$this->nombre', password = '$this->password', email = '$this->email', telefono = $this->telefono, imagen = '$this->imagen' WHERE idUsuario = $this->idUsuario";
            $resultado = $conn->query($sql);
            return $resultado;
        }

        /***** FUNCIONES PARA CONSULTAR USUARIOS EN LOS CONTROLLERS *****/
        public static function getUser($name) 
        {
            $app = Aplicacion::getSingleton();
            $conn = $app->conexionBd();
            $user = new Usuario(); //Usuario vacio

            $sql = "SELECT idUsuario, nombre, email, telefono, tipoUsuario, saldo, imagen, bloq, valoracion, password FROM usuario WHERE nombre = '$name'";
            $resultado = $conn->query($sql);
            $user->createUser($resultado->fetch_assoc()); //Creamos un objeto user con los datos de la consulta
            return $user;
        }

        public static function getUserbyId($id)
        {
            $app = Aplicacion::getSingleton();
            $conn = $app->conexionBd();
            $user = new Usuario(); //Usuario vacio

            $sql = sprintf("SELECT * FROM usuario WHERE idUsuario = '$id'");
            $resultado = $conn->query($sql);
            $user->createUser($resultado->fetch_assoc()); //Creamos un objeto user con los datos de la consulta
            return $user;
        }

        /***** FUNCIÓN PARA ACTUALIZAR EL SALDO TRAS UNA TRANSACCIÓN *****/
        public static function updateSaldo($saldo, $incSaldo, $idUsuario)
        {
            $app = Aplicacion::getSingleton();
            $conn = $app->conexionBd();

            $saldototal = $saldo + $incSaldo;
            $sql = "UPDATE usuario SET saldo = $saldototal WHERE idUsuario = $idUsuario";
            $ok = $conn->query($sql);
            return $ok;
        }

        /***** FUNCION PARA SUBIR LA VALORACION ****/
        public static function updateValoracion($valoracion, $idUsuario){
            $app = Aplicacion::getSingleton();
            $conn = $app->conexionBd();
            $user=new Usuario();
            $user->getUserbyId($idUsuario);
            $media=($valoracion+$user->valoracion)/2;
            $sql = "UPDATE usuario SET valoracion = $media WHERE idUsuario = $idUsuario";
            $ok = $conn->query($sql);
            return $ok;
        }

        /***** FUNCIONES PARA MOSTRAR USUARIOS ACTIVOS ******/
        public static function getAllActiveUsers()
        {
            $app = Aplicacion::getSingleton();
            $conn = $app->conexionBd();
            $map = [];

            $sql = sprintf("SELECT * FROM usuario WHERE tipoUsuario = '0' AND bloq = '0'");

            if($resultado = $conn->query($sql)){
                if($resultado->num_rows > 0){
                    while ($fila = $resultado->fetch_assoc()  ) {
                        $link = "./usuario?id=" .  $fila['idUsuario']; 
                        $product_img = "../profile_img/" . $fila['imagen'];
                        $map[$link] = $product_img;
                    }
                }
            }
            return $map;
        }

        function mostrarXUsuarios($num)
        {
            $usuario = new Usuario ();
            $map = $usuario->getAllActiveUsers();
            $html = '';
            foreach ($map as $link => $product_img) {
                if($num == 0){
                    break;
                }else{
                    $html .= '<a href="'.$link.'">'.'<img src="'.$product_img.'"alt="imagen"></a>';
                    $num--;
                }
            }
            return $html;
        }

        /*****FUNCIONES PARA MOSTRAR TODOS LOS USUARIOS (SOLO PARA ADMIN) *****/
        public static function getAllUsers()
        {
            $app = Aplicacion::getSingleton();
            $conn = $app->conexionBd();
            $map = [];

            $sql = sprintf("SELECT * FROM usuario WHERE tipoUsuario = '0'");

            if($resultado = $conn->query($sql)){
                if($resultado->num_rows > 0){
                    while ($fila = $resultado->fetch_assoc()  ) {
                        $link = "./usuario?id=" .  $fila['idUsuario']; 
                        $product_img = "../profile_img/" . $fila['imagen'];
                        $map[$link] = $product_img;
                    }
                }
            }
            return $map;
        }

        function mostrarTodosUsuarios()
        {
            $usuario = new Usuario ();
            $map = $usuario->getAllUsers();
            $html = '';
            foreach ($map as $link => $product_img) {
                $html .= '<a href="'.$link.'">'.'<img src="'.$product_img.'"alt="imagen"></a>';
            }
            return $html;
        }
        
        /*****FUNCIONES PARA MOSTRAR LOS USUARIOS BLOQUEADOS (SOLO PARA ADMIN) *****/
        public static function getBloqUsers()
        {
            $app = Aplicacion::getSingleton();
            $conn = $app->conexionBd();
            $map = [];

            $sql = sprintf("SELECT * FROM usuario WHERE bloq = '1'");

            if($resultado = $conn->query($sql)){
                if($resultado->num_rows > 0){
                    while ($fila = $resultado->fetch_assoc()  ) {
                        $link = "./usuario?id=" .  $fila['idUsuario']; 
                        $product_img = "../profile_img/" . $fila['imagen'];
                        $map[$link] = $product_img;
                    }
                }
            }
            return $map;
        }

        function mostrarBloqUsuarios()
        {
            $usuario = new Usuario ();
            $map = $usuario->getBloqUsers();
            $html = '';
            if(count($map) != 0){
                foreach ($map as $link => $product_img) {
                    $html .= '<a href="'.$link.'">'.'<img src="'.$product_img.'"alt="imagen"></a>';
                }
            }
            else {
                $html .= '<label>No hay ningún usuario bloqueado</label>';
            }
            return $html;
        }

        /***** FUNCIONES PARA BUSCAR USUARIOS POR NOMBRE (SOLO PARA ADMIN) ******/
        public static function getAllUsersFromNombre($nombre)
        {
            $app = Aplicacion::getSingleton();
            $conn = $app->conexionBd();
            $map = [];
            $nombre = '%' . $nombre . '%';
            $sql = sprintf("SELECT * FROM usuario WHERE nombre LIKE '%s'", $nombre);
            if($resultado = $conn->query($sql)){
                if($resultado->num_rows > 0){
                    while ($fila = $resultado->fetch_assoc()) {
                        $link = "./usuario?id=" .  $fila['idUsuario'];
                        $product_img = "../profile_img/" . $fila['imagen'];
                        $map[$link] = $product_img;
                    }
                }
            }
            return $map;
        }

        function mostrarUsuariosBuscados()
        {
            $existe = TRUE;
            if(isset($_POST['submit_buscarNombre'])){
            
                //nombre de usuario a buscar
                $nombre = $_POST['nombreUsuario'];
                if($nombre != "") {
                    $usuario = new Usuario ();
                    $map = $usuario->getAllUsersFromNombre($nombre);
                    return $map;
                }
                else {
                    $existe = FALSE;
                    return null;
                }  
            }   
        } 

        /***** FUNCIONES PARA BLOQUEAR O BORRAR USUARIOS (SOLO PARA ADMIN) *****/
        public function deleteUser($idUsuario)
        {
            $app = Aplicacion::getSingleton();
            $conn = $app->conexionBd();
            $sql = sprintf("DELETE FROM usuario WHERE idUsuario = '$idUsuario'");
            $ok = $conn->query($sql); 
            return $ok;
        }

        public function bloqUser($idUsuario) 
        {
            $app = Aplicacion::getSingleton();
            $conn = $app->conexionBd();
            $ok = FALSE;
            $sql = "SELECT bloq FROM usuario WHERE idUsuario = '$idUsuario'";

            if ($resultado = $conn->query($sql)) { 
                if ($resultado->num_rows > 0 and $resultado->num_rows === 1) {
                    $user_fetched = $resultado->fetch_assoc();
                    if($user_fetched['bloq'] == 0){
                        $sql = "UPDATE usuario SET bloq = 1 WHERE idUsuario = '$idUsuario'";
                    }
                    else {
                        $sql = "UPDATE usuario SET bloq = 0 WHERE idUsuario = '$idUsuario'";
                    }
                    $ok = $conn->query($sql);
                }
            }
            return $ok;
        }

        public function adminUser($idUsuario){

            $app = Aplicacion::getSingleton();
            $conn = $app->conexionBd();
            $ok = FALSE;
            $sql = "SELECT tipoUsuario FROM usuario WHERE idUsuario = '$idUsuario'";

            if ($resultado = $conn->query($sql)) { 
                if ($resultado->num_rows > 0 and $resultado->num_rows === 1) {
                    $user_fetched = $resultado->fetch_assoc();
                    if($user_fetched['tipoUsuario'] == 0){
                        $sql = "UPDATE usuario SET tipoUsuario = 1 WHERE idUsuario = '$idUsuario'";
                    }
                    else {
                        $sql = "UPDATE usuario SET tipoUsuario = 0 WHERE idUsuario = '$idUsuario'";
                    }
                    $ok = $conn->query($sql);
                }
            }
            return $ok;
        }

        /***** FUNCIÓN PARA CREAR UN USUARIO Y DEVOLVERLO TRAS UNA CONSULTA ******/
        public function createUser($row)
        {
            $this->idUsuario = $row['idUsuario'];
            $this->nombre = $row['nombre'];
            $this->email = $row['email'];
            $this->telefono = $row['telefono'];
            $this->tipoUsuario = $row['tipoUsuario'];
            $this->saldo = $row['saldo'];
            $this->imagen = $row['imagen'];
            $this->password = $row['password'];
            $this->bloq = $row['bloq'];
            $this->valoracion=$row['valoracion'];
        }
    }