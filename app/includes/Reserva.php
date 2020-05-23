<?php
    require_once __DIR__ . '/Aplicacion.php';
    

    class Reserva{
        public $idReserva;
        public $idProducto;
        public $idComprador;

        function __construct($idProducto ="", $idComprador="")
        {
            $this->idProducto = $idProducto;
            $this->idComprador = $idComprador;
        }

        public function newReserva()
        {
            $app = Aplicacion::getSingleton();
            $conn = $app->conexionBd();

            $sql = "INSERT INTO reservas(idProducto, idComprador) 
            VALUES ('$this->idProducto', '$this->idComprador')";
            $ok = $conn->query($sql);
            return $ok;
        }
        public function borrarReserva($idProducto){
            $app = Aplicacion::getSingleton();
            $conn = $app->conexionBd();
            $sql = sprintf("DELETE FROM reservas WHERE idProducto = '$idProducto'");
            $ok = $conn->query($sql); 
            return $ok;
        }
        public static function getidComprador($id)
        {
            $app = Aplicacion::getSingleton();
            $conn = $app->conexionBd();
            $reserva = new Reserva();

            $sql = "SELECT * FROM reservas WHERE idProducto = '$id'";
            $resultado = $conn->query($sql);
            if($resultado && $resultado->num_rows > 0) {
                $reserva->createReserva($resultado->fetch_assoc()); //Creamos un objeto Producto con los datos de la consulta
            }
            
            
            return $reserva;
        }
        public function createReserva($row)
        {   
            $this->idReserva = $row['idReserva'];
            $this->idProducto = $row['idProducto'];
            $this->idComprador = $row['idComprador'];
            
        }
    }