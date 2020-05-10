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

        public function updateProduct(){
            $app = Aplicacion::getSingleton();
            $conn = $app->conexionBd();

            $sql = "UPDATE producto SET nombre = '$this->nombre', precio = '$this->precio', descripcion = '$this->descripcion', imagen = '$this->imagen' WHERE idProducto = $this->idProducto";
            $resultado = $conn->query($sql);

            return $resultado;

        }

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

        public function deleteProduct($idProducto){
            $app = Aplicacion::getSingleton();
            $conn = $app->conexionBd();
            $sql = sprintf("DELETE FROM producto WHERE idProducto = '$idProducto'");
            $ok = $conn->query($sql); 
            return $ok;
        }
        
        public static function getAllProducts()
        {
            $app = Aplicacion::getSingleton();
            $conn = $app->conexionBd();
            $map = [];
            $sql = sprintf("SELECT * FROM producto ");

            if($resultado = $conn->query($sql)){
                if($resultado->num_rows > 0){
                    while ($fila = $resultado->fetch_assoc()) {
                        if($fila['idEstado'] == 0){ //Solo si su idEstado es 0 -> En venta
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
                    /* ?>
                    <a href=<?php echo "'$link'"?>> <img src=<?php echo "'$product_img'"?> alt='imagen'></a>
                    <?php */
                    $num--;
                }
            }
            return $html;
        } 

        public static function getAllProductsFromCategoria($idCategoria)
        {
            $app = Aplicacion::getSingleton();
            $conn = $app->conexionBd();
            $map = [];
            $sql = sprintf("SELECT * FROM producto WHERE idCategoria = '$idCategoria' ");
            if($resultado = $conn->query($sql)){
                if($resultado->num_rows > 0){
                    while ($fila = $resultado->fetch_assoc()) {
                        if($fila['idEstado'] == 0){ //Solo si su idEstado es 0 -> En venta
                            $link = "./articulo?id=" .  $fila['idProducto'];
                            $product_img = "../product_img/" . $fila['imagen'];
                            $map[$link] = $product_img;
                        }
                    }
                }
            }
            return $map;
        }
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
                        if($fila['idEstado'] == 0){ //Solo si su idEstado es 0 -> En venta
                            $link = "./articulo?id=" .  $fila['idProducto'];
                            $product_img = "../product_img/" . $fila['imagen'];
                            $map[$link] = $product_img;
                        }
                    }
                }
            }
            return $map;
        }
        

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
          
        public static function getProduct($id) {
            $app = Aplicacion::getSingleton();
            $conn = $app->conexionBd();
            $product = new Producto();

            $sql = "SELECT idProducto, descripcion, precio, idEstado, idCategoria, nombre, idUsuario, imagen FROM producto WHERE idProducto = '$id'";

            $resultado = $conn->query($sql);
            $product->createProduct($resultado->fetch_assoc()); //Creamos un objeto Producto con los datos de la consulta
            
            return $product;
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
                else
                    $existe = FALSE;
                    return null;    
            }    
        }

        public static function changeStatus($idProducto, $status)
        {
            $app = Aplicacion::getSingleton();
            $conn = $app->conexionBd();
            $sql = "UPDATE producto SET idEstado = $status WHERE idProducto = $idProducto";
            $ok = $conn->query($sql);
            return $ok;
        }
        
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
?>