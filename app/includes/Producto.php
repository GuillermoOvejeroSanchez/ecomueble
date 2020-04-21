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
            $sql = sprintf("INSERT INTO producto(descripcion, precio, idEstado, idCategoria, nombre, idUsuario, imagen) 
            VALUES('$this->descripcion', '$this->precio', '$this->idEstado' , '$this->idCategoria', '$this->nombre', '$this->idUsuario', '$this->imagen')");
            return $sql;
        }

        public static function getAllProductsFromUser($idUsuario)
        {
            $sql = sprintf("SELECT * FROM producto WHERE idUsuario = '$idUsuario'");
            return $sql;
        }
        public static function deleteProduct($idProducto){
            $sql = sprintf("DELETE FROM producto WHERE idProducto = '$idProducto'");
            return $sql; 

        }
        
        public static function getAllProducts()
        {
            $sql = sprintf("SELECT * FROM producto ");
            return $sql;
        }
        public static function getAllProductsFromCategoria($idCategoria)
        {
            $sql = sprintf("SELECT * FROM producto WHERE idCategoria = '$idCategoria' ");
            return $sql;
        }
        public function getProduct($id) {
            $sql = sprintf("SELECT * FROM producto WHERE idProducto = '$id'");
            return $sql;
        }

        public static function changeStatus($idProducto, $status)
        {
            $sql = "UPDATE producto SET idEstado = $status WHERE idProducto = $idProducto";
            return $sql;
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