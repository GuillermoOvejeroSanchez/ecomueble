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
                $result = '/perfil';
            }else{
                //Enviar mensaje, no se ha podido subir
                $_POST['submit_producto'] = FALSE;
                $result[] = "Error subiendo producto.\n";
            }
            
            return $result;
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
        public static function getProduct($id) {
            $product = new Producto();
            $app = Aplicacion::getSingleton();
            $conn = $app->conexionBd();

            $sql = sprintf("SELECT * FROM producto WHERE idProducto = '$id'");

            $resultado = $conn->query($sql);
            if($resultado->num_rows > 0){
                $product->createProduct($resultado->fetch_assoc()); //Creamos un objeto Producto con los datos de la consulta
            }
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
        
        public function createProduct($row)
        {   $this->descripcion = $row['descripcion']; //
            $this->precio = $row['precio']; //
            $this->idEstado = $row['idEstado']; //0 -> en venta 1 -> vendido 2 -> reservado
            $this->idCategoria = $row['idCategoria']; //
            $this->nombre = $row['nombre']; //
            $this->idUsuario = $row['idUsuario'];
            $this->imagen = $row['imagen'];
        }
    }
?>