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


        function __construct($nombre ="", $email = "", $telefono = "", $password = "", $tipoUsuario = 0, $saldo = 50, $imagen = 'default_profile.jpg')
        {
            $this->nombre = $nombre;
            $this->email = $email;
            $this->telefono = $telefono;
            $this->password = $password;
            $this->tipoUsuario = $tipoUsuario;
            $this->saldo = $saldo;
            $this->imagen = $imagen;
        }

        public function insertUser()
        {   
            $conn = Aplicacion::getSingleton()->conexionBd();
            $sql = sprintf("INSERT INTO usuario( nombre, email, telefono, password, tipoUsuario, saldo, imagen) 
            VALUES ( '$this->nombre', '$this->email', '$this->telefono' , '$this->password', '$this->tipoUsuario', '$this->saldo', '$this->imagen')");
            
            if($conn->query($sql) === TRUE){
                return TRUE;
            }
            return FALSE;
        }

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

        public function checkUsername($valid)
        {
            $existe = FALSE;
            $conn = Aplicacion::getSingleton()->conexionBd();
            $sql = "SELECT nombre, email, telefono FROM usuario WHERE nombre = '$this->nombre'";
            $msg ="";
            if ($valid and $resultado = $conn->query($sql)) { 
                if ($resultado->num_rows > 0) {
                    $existe = TRUE;
                    $msg = "Ya existe un usuario con ese ";
                    //Comprobar cuales son los repetidos
                    $user_fetched = $resultado->fetch_assoc();
                    if($user_fetched['nombre'] == $this->nombre) $msg .= "nombre ";
                } 
            }
            return $msg;
        }


        public function checkEmail($valid)
        {
            $existe = FALSE;
            $conn = Aplicacion::getSingleton()->conexionBd();
            $sql = "SELECT nombre, email, telefono FROM usuario WHERE email = '$this->email'";
            $msg ="";
            if ($valid and $resultado = $conn->query($sql)) { 
                if ($resultado->num_rows > 0) {
                    $existe = TRUE;
                    $msg = "Ya existe un usuario con ese ";
                    //Comprobar cuales son los repetidos
                    $user_fetched = $resultado->fetch_assoc();
                    if($user_fetched['email'] == $this->email) $msg .= "email ";
                } 
            }
            return $msg;
        }


        public static function updateSaldo($saldo, $incSaldo, $idUsuario)
        {
            $app = Aplicacion::getSingleton();
            $conn = $app->conexionBd();

            $saldototal = $saldo + $incSaldo;
            $sql = "UPDATE usuario SET saldo = $saldototal WHERE idUsuario = $idUsuario";
            $ok = $conn->query($sql);
            return $ok;
        }

        public static function getUser($name) {
            $app = Aplicacion::getSingleton();
            $conn = $app->conexionBd();
            $user = new Usuario(); //Usuario vacio

            $sql = "SELECT idUsuario, nombre, email, telefono, tipoUsuario, saldo, imagen, password FROM usuario WHERE nombre = '$name'";
            $resultado = $conn->query($sql);
            $user->createUser($resultado->fetch_assoc()); //Creamos un objeto user con los datos de la consulta

            return $user;
        }

        public function updateUser(){
            $app = Aplicacion::getSingleton();
            $conn = $app->conexionBd();

            $sql = "UPDATE usuario SET nombre = '$this->nombre', password = '$this->password', email = '$this->email', telefono = $this->telefono, imagen = '$this->imagen' WHERE idUsuario = $this->idUsuario";
            $resultado = $conn->query($sql);

            return $resultado;

        }

        public static function getUserbyId($id) {
            $app = Aplicacion::getSingleton();
            $conn = $app->conexionBd();
            $user = new Usuario(); //Usuario vacio

            $sql = sprintf("SELECT * FROM usuario WHERE idUsuario = '$id'");
            $resultado = $conn->query($sql);
            $user->createUser($resultado->fetch_assoc()); //Creamos un objeto user con los datos de la consulta
            
            return $user;
        }

        public static function getAllUsers()
        {
            $app = Aplicacion::getSingleton();
            $conn = $app->conexionBd();
            $map = [];

            $sql = sprintf("SELECT * FROM usuario ");

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
            $map = $usuario->getAllUsers();
            $html = '';
            foreach ($map as $link => $product_img) {
                if($num == 0){
                    break;
                }else{
                    $html .= '<a href="'.$link.'">'.'<img src="'.$product_img.'"alt="imagen"></a>';
                   /*?>
                    <a href=<?php echo "'$link'"?>> <img src=<?php echo "'$product_img'"?> alt='imagen'></a>
                    <?php */
                    $num--;
                }
            }
            return $html;
        }

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

        public function logUser()
        {
            $conn = Aplicacion::getSingleton()->conexionBd();
            
            $sql = "SELECT idUsuario, nombre, password,tipoUsuario, saldo, imagen FROM usuario WHERE (nombre = '$this->nombre' OR email = '$this->nombre')";
            
            if ($resultado = $conn->query($sql)) { 
                if ($resultado->num_rows > 0 and $resultado->num_rows === 1) {
                    $user_fetched = $resultado->fetch_assoc();

                    $ok = password_verify($this->password, $user_fetched['password']); 
                    if ($ok) {
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
        }
    }
?>
