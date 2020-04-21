<?php
    require_once __DIR__ . '/Aplicacion.php';

    class Transaccion{
        public $idTransaccion;
        public $idProducto;
        public $idComprador;
        public $fecha;

        function __construct($idProducto, $idComprador, $fecha)
        {
            $this->idProducto = $idProducto;
            $this->idComprador = $idComprador;
            $this->fecha = $fecha;
        }

        public function newTransaction()
        {
            $sql = sprintf("INSERT INTO transacciones(idProducto, idComprador, fecha) 
            VALUES ( '$this->idProducto', '$this->idComprador', '$this->fecha')");
            return $sql;
        }
    }

?>