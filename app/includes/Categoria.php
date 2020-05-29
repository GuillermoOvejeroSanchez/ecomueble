<?php
    require_once __DIR__ . '/Aplicacion.php';

    class Categoria{
        public $idCategoria;
        public $tipo;

        function __construct($tipo, $idCategoria = "")
        {
            $this->idCategoria = $idCategoria;
            $this->tipo = $tipo;
        }

        public function insertCategoria()
        {
            $sql = "INSERT INTO categoria(tipo) VALUES '$this->tipo'";
            return $sql;
        }

        public function getIDCategoria()
        {
            $app = Aplicacion::getSingleton();
            $conn = $app->conexionBd();
            $id = "";

            $sql = "SELECT idCategoria FROM categoria WHERE tipo = '$this->tipo'";
            
            if($resultado = $conn->query($sql)) {
                if ($resultado->num_rows > 0) {
                    $cat_fetched = $resultado->fetch_assoc();
                    $id = $cat_fetched['idCategoria'];
                }
            }
            return $id;
    }

        public static function getAllTags()
        {
            $app = Aplicacion::getSingleton();
            $conn = $app->conexionBd();
            $arrayTags;
            
            $sql = "SELECT * FROM categoria";
            
            if($resultado = $conn->query($sql)){
                while ($fila = $resultado->fetch_assoc()) {
                    $tipo = $fila['tipo'];
                    $arrayTags[$tipo] = ucfirst($tipo) . 's'; //añadimos 's' pa que sea en plural
                }
            }
            return $arrayTags;
        }

    }