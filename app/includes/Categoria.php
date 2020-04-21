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