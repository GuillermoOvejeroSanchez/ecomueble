<?php
    require_once __DIR__ . '/Aplicacion.php';
    

    class Reporte{
        public $idReporte;
        public $motivo;
        public $idProducto;
        public $reportador;
        public $fechaReporte;
        public $resolucion;

        function __construct($motivo ="", $idProducto ="", $reportador="", $fechaReporte="", $resolucion="")
        {
            $this->motivo = $motivo;
            $this->idProducto = $idProducto;
            $this->reportador = $reportador;
            $this->reportador = $reportador;
            $this->fechaReporte = $fechaReporte;
            $this->resolucion = $resolucion;
        }

        public function newReporte()
        {
            $app = Aplicacion::getSingleton();
            $conn = $app->conexionBd();

            $sql = "INSERT INTO reporte(motivo, idProducto, reportador, fechaReporte, resolucion) 
            VALUES ('$this->motivo','$this->idProducto', '$this->reportador','$this->fechaReporte', '$this->resolucion')";
            $ok = $conn->query($sql);
            return $ok;
        }
        public function borrarReserva($idReporte){
            $app = Aplicacion::getSingleton();
            $conn = $app->conexionBd();
            $sql = sprintf("DELETE FROM reporte WHERE idReporte = '$idReporte'");
            $ok = $conn->query($sql); 
            return $ok;
        }
        public static function getReporte($id)
        {
            $app = Aplicacion::getSingleton();
            $conn = $app->conexionBd();
            $reporte = new Reporte();

            $sql = "SELECT * FROM reporte WHERE idReporte = '$id'";
            $resultado = $conn->query($sql);
            $reporte->createReporte($resultado->fetch_assoc()); //Creamos un objeto Producto con los datos de la consulta
            
            return $reporte;
        }

        public static function showReports($id)
        {
            $app = Aplicacion::getSingleton();
            $conn = $app->conexionBd();
            $map = [];
            $sql = sprintf("SELECT * FROM reporte WHERE idProducto = $id");

            if($resultado = $conn->query($sql)){
                if($resultado->num_rows > 0){
                    while ($fila = $resultado->fetch_assoc()) {
                        echo "<pre>ID reporte: " . $fila['idReporte'] . " motivo: " . $fila['motivo'] . " ID producto: " . $fila['idProducto'] . " ID reportador: " . $fila['reportador'] . " fecha: " . $fila['fechaReporte'] . " resolucion: " . $fila['resolucion']. "</pre>";
                        
                    }
                }
            }                
        }
        public function updateReporte()
        {
            $app = Aplicacion::getSingleton();
            $conn = $app->conexionBd();

            $sql = "UPDATE reporte SET resolucion = '$this->resolucion' WHERE idReporte = $this->idReporte";
            $resultado = $conn->query($sql);

            return $resultado;
        }

        public function createReporte($row)
        {   
            $this->idReporte = $row['idReporte'];
            $this->motivo = $row['motivo'];
            $this->idProducto = $row['idProducto'];
            $this->reportador = $row['reportador'];
            $this->fechaReporte = $row['fechaReporte'];
            $this->resolucion = $row['resolucion'];
            
        }
    }