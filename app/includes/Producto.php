<?php
    require_once __DIR__ . '/Aplicacion.php';
    
    class Producto{
        public $idProducto;
        public $descripcion;
        public $precio;
        public $idEstado;
        public $idCategoria;
        public $nombre;
        public $idUsuario;
        public $imagen;


        function __construct($descripcion ="", $precio = "", $idEstado = 0, $idCategoria = "", $nombre = "", $idUsuario = "", $imagen = 'default_profile.jpg')
        {
            $this->descripcion = $descripcion; //
            $this->precio = $precio; //
            $this->idEstado = $idEstado; //0 -> en venta 1 -> vendido 2 -> reservado
            $this->idCategoria = $idCategoria; //
            $this->nombre = $nombre; //
            $this->idUsuario = $idUsuario;
            $this->imagen = $imagen; //
        }

        /***** FUNCIÓN PARA AÑADIR PRODUCTO *****/
        public function insertProduct()
        {
            $conn = Aplicacion::getSingleton()->conexionBd();

            $sql = sprintf("INSERT INTO producto(descripcion, precio, idEstado, idCategoria, nombre, idUsuario, imagen) 
            VALUES('$this->descripcion', '$this->precio', '$this->idEstado' , '$this->idCategoria', '$this->nombre', '$this->idUsuario', '$this->imagen')");
            if($conn->query($sql)){
                //Enviar mensaje, subido con exito
                $_POST['submit_producto'] = TRUE;
                $result = '/perfil?upload=1';
            }else{
                //Enviar mensaje, no se ha podido subir
                $_POST['submit_producto'] = FALSE;
                $result[] = "Error subiendo producto.\n";
            }
            
            return $result;
        }

        /***** FUNCIONES PARA ACTUALIZAR DATOS DE PRODUCTO O ELIMINARLO *****/
        public function updateProduct()
        {
            $app = Aplicacion::getSingleton();
            $conn = $app->conexionBd();

            $sql = "UPDATE producto SET nombre = '$this->nombre', precio = '$this->precio', descripcion = '$this->descripcion', imagen = '$this->imagen' WHERE idProducto = $this->idProducto";
            $resultado = $conn->query($sql);

            return $resultado;
        }

        public function deleteProduct($idProducto)
        {
            $app = Aplicacion::getSingleton();
            $conn = $app->conexionBd();
            $sql = sprintf("DELETE FROM producto WHERE idProducto = '$idProducto'");
            $ok = $conn->query($sql); 
            return $ok;
        }

        /***** FUNCIONES PARA CONSULTAR PRODUCTOS Y CAMBIAR SU ESTADO EN LOS CONTROLLERS *****/
        public static function getProduct($id)
        {
            $app = Aplicacion::getSingleton();
            $conn = $app->conexionBd();
            $product = new Producto();

            $sql = "SELECT idProducto, descripcion, precio, idEstado, idCategoria, nombre, idUsuario, imagen FROM producto WHERE idProducto = '$id'";
            $resultado = $conn->query($sql);
            $product->createProduct($resultado->fetch_assoc()); //Creamos un objeto Producto con los datos de la consulta
            
            return $product;
        }

        public static function changeStatus($idProducto, $status)
        {
            $app = Aplicacion::getSingleton();
            $conn = $app->conexionBd();
            $sql = "UPDATE producto SET idEstado = $status WHERE idProducto = $idProducto";
            $ok = $conn->query($sql);
            return $ok;
        }

        /***** FUNCIONES PARA MOSTRAR PRODUCTOS EN VENTA *****/
        public static function getAllProducts()
        {
            $app = Aplicacion::getSingleton();
            $conn = $app->conexionBd();
            $map = [];
            $sql = sprintf("SELECT * FROM producto ");

            if($resultado = $conn->query($sql)){
                if($resultado->num_rows > 0){
                    while ($fila = $resultado->fetch_assoc()) {
                        $user = Usuario:: getUserbyId($fila['idUsuario']);
                        if($fila['idEstado'] != 1 && $user->bloq == 0){ //Solo si no está vendido y el usuario de ese producto no está bloqueado
                            $link = "./articulo?id=" .  $fila['idProducto'];
                            $product_img = "../product_img/" . $fila['imagen'];
                            $map[$link] = $product_img;
                        }
                    }
                }
            }
            return $map;                
        }

        function mostrarXProductos($num)
        {
            $producto = new Producto();
            $map =  $producto->getAllProducts();
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
        
        /***** FUNCIONES PARA MOSTRAR PRODUCTOS DE UN USUARIO *****/
        public static function getAllProductsFromUser($idUsuario)
        {
            $app = Aplicacion::getSingleton();
            $conn = $app->conexionBd();
            $sql = sprintf("SELECT * FROM producto WHERE idUsuario = '$idUsuario'");
            $link_id = [];
            if($resultado = $conn->query($sql)){
                if($resultado->num_rows > 0){
                    while ($fila = $resultado->fetch_assoc()) {
                        $product_img = "../product_img/" . $fila['imagen'];
                        $link_articulo = "./articulo?id=" .  $fila['idProducto']; 
                        $link_id[$link_articulo] = $product_img;
                    }
                }
            }
            return $link_id;
        }
        
        function mostrarProductosUser($idUsuario)
        {
            $producto = new Producto();
            $links_id = $producto->getAllProductsFromUser($idUsuario);
            $html = '';
            if(count($links_id) != 0){
                foreach ($links_id as $key => $value) {
                    $html .= '<a href="'.$key.'">'.'<img src="'.$value.'"alt="imagen"></a>';
                }
            }else{
                $html .= '<label>Este usuario no tiene artículos</label>';
            }
            return $html;
        }

        public static function getAllProductsFromComprador($idComprador)
        {
            $app = Aplicacion::getSingleton();
            $conn = $app->conexionBd();
            $sql1 = sprintf("SELECT * FROM transacciones WHERE idComprador = '$idComprador'");
            $link_id = [];
            if($resultado1 = $conn->query($sql1)){
                while ( $p = $resultado1->fetch_assoc()) {
               
                    $idProducto = $p['idProducto'];
                    $sql2 =  sprintf("SELECT * FROM producto WHERE idProducto = '$idProducto'");
                    if($resultado2 = $conn->query($sql2)){
                        if($resultado2->num_rows > 0){
                            while ($fila = $resultado2->fetch_assoc()) {
                                $product_img = "../product_img/" . $fila['imagen'];
                                $link_articulo = "./articulo?id=" .  $fila['idProducto']; 
                                $link_id[$link_articulo] = $product_img;
                            }
                        }
                    }
                }
            }
            return $link_id;
        }
        function mostrarProductosComprador($idComprador)
        {
            $transaccion = new Producto();
            $links_id = $transaccion->getAllProductsFromComprador($idComprador);
            $html = '';
            if(count($links_id) != 0){
                foreach ($links_id as $key => $value) {
                    $html .= '<a href="'.$key.'">'.'<img src="'.$value.'"alt="imagen"></a>';
                }
            }else{
                $html .= '<label>Este usuario no tiene artículos comprados</label>';
            }
            return $html;
        }


        /***** FUNCIONES PARA MOSTRAR PRODUCTOS DE UNA CATEGORÍA O DE TODAS *****/
        public static function getAllProductsFromCategoria($idCategoria)
        {
            $app = Aplicacion::getSingleton();
            $conn = $app->conexionBd();
            $map = [];
            $sql = sprintf("SELECT * FROM producto WHERE idCategoria = '$idCategoria' ");
            if($resultado = $conn->query($sql)){
                if($resultado->num_rows > 0){
                    while ($fila = $resultado->fetch_assoc()) {
                        $user = Usuario:: getUserbyId($fila['idUsuario']);
                        if($fila['idEstado'] != 1 && $user->bloq == 0){ //Solo si no está vendido y el usuario no está bloqueado
                            $link = "./articulo?id=" .  $fila['idProducto'];
                            $product_img = "../product_img/" . $fila['imagen'];
                            $map[$link] = $product_img;
                        }
                    }
                }
            }
            return $map;
        }

        public function mostrarProductos()
        {
            $existe = TRUE;
            if(!isset($_GET['categoria'])){
                $producto = new Producto();
                $map =  $producto->getAllProducts();
            }
            else {
                $categoria = new Categoria($_GET['categoria']);
    
                //idCategoria para insertar en producto
                $idCategoria = $categoria->getIDCategoria();
                if($idCategoria != "") {
                    $productoCat = new Producto();
                    $map = $productoCat->getAllProductsFromCategoria($idCategoria);
                }
                else {
                    $existe = FALSE;
                }  
            }
            if($existe) {
                foreach ($map as $link => $product_img) {
                    ?>
                    <a href=<?php echo "'$link'"?>> <img src=<?php echo "'$product_img'"?> alt='imagen'></a>
                    <?php
                }
            }       
        }

        /***** FUNCIONES PARA BUSCAR PRODUCTOS POR NOMBRE *****/
        public static function getAllProductsFromNombre($nombre)
        {
            $app = Aplicacion::getSingleton();
            $conn = $app->conexionBd();
            $map = [];
            $nombre = '%' . $nombre . '%';
            $sql = sprintf("SELECT * FROM producto WHERE nombre LIKE '%s'", $nombre);
            if($resultado = $conn->query($sql)){
                if($resultado->num_rows > 0){
                    while ($fila = $resultado->fetch_assoc()) {
                        $user = Usuario:: getUserbyId($fila['idUsuario']);
                        if($fila['idEstado'] != 1 && $user->bloq == 0){ //Solo si no está vendido y el usuario no está bloqueado
                            $link = "./articulo?id=" .  $fila['idProducto'];
                            $product_img = "../product_img/" . $fila['imagen'];
                            $map[$link] = $product_img;
                           
                        }
                    }
                    return $map;
                }
            }
            return null;
        }

        public function mostrarProductosBuscados()
        {
            $existe = TRUE;
            if(isset($_POST['submit_buscarNombre'])){
            
                //nombre de producto a buscar
                $nombre = $_POST['nombreProducto'];
                if($nombre != "") {
                    $producto = new Producto($nombre);
                    $map = $producto->getAllProductsFromNombre($nombre);
                    return $map;
                }
                else {
                    $existe = FALSE;
                    return null;    
                }
            }    
        }

        ///////////////////////////////////////// NO VEO PARA QUÉ USAMOS ESTA, NO SÉ CATEGORIZARLA
        public function getNameProduct()
        {
            $app = Aplicacion::getSingleton();
            $conn = $app->conexionBd();
            $id = "";

            $sql = "SELECT nombre FROM producto WHERE nombre = '$this->nombre'";
            
            if($resultado = $conn->query($sql)) {
                if ($resultado->num_rows > 0) {
                    $cat_fetched = $resultado->fetch_assoc();
                    $id = $cat_fetched['nombre'];
                }
            }
            return $id;
        }
          
        /***** FUNCIÓN PARA CREAR UN PRODUCTO Y DEVOLVERLO TRAS UNA CONSULTA ******/
        public function createProduct($row)
        {   
            $this->idProducto = $row['idProducto'];
            $this->descripcion = $row['descripcion']; //
            $this->precio = $row['precio']; //
            $this->idEstado = $row['idEstado']; //0 -> en venta 1 -> vendido 2 -> reservado
            $this->idCategoria = $row['idCategoria']; //
            $this->nombre = $row['nombre']; //
            $this->idUsuario = $row['idUsuario'];
            $this->imagen = $row['imagen'];
        }
    }