<?php

class Producto
{
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
    public function getProduct($nombre) {
        $product = "SELECT descripcion, precio, estado, categoria, nombre, usuario, imagen FROM producto WHERE nombre = '$nombre'";
        return $product;
    }
    public function createProduct($row)
    {   $this->descripcion = $row['descripcion']; //
        $this->precio = $row['precio']; //
        $this->idEstado = $row['estado']; //0 -> en venta 1 -> vendido 2 -> reservado
        $this->idCategoria = $row['categoria']; //
        $this->nombre = $row['nombre']; //
        $this->idUsuario = $row['usuario'];
        $this->imagen = $row['imagen'];
    }
}


class Categoria
{
    public $idCategoria;
    public $tipo;


    function __construct($tipo, $idCategoria = "")
    {
        $this->idCategoria = $idCategoria;
        $this->tipo = $tipo;
    }

    //Si el usuario no tiene una categoria que inserte una
    public function insertCategoria()
    {
        $sql = "INSERT INTO categoria(tipo) VALUES '$this->tipo'";
        return $sql;
    }

    public function getIDCategoria()
    {
        $sql = "SELECT idCategoria FROM categoria WHERE tipo = '$this->tipo'";
        return $sql;
    }

    public static function getAllTags()
    {
        $sql = "SELECT * FROM categoria";
        return $sql;
    }

}
?>