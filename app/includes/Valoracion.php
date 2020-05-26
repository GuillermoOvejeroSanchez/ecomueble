<?php
    require_once __DIR__ . '/Aplicacion.php';

    class Valoracion{
        public $idValoracion;
        public $idCliente;
        public $idVendedor;
        public $nota;
        
        function __construct($idValoracion="",$nota ="", $idCliente ="", $idVendedor="")
        {
            $this->idValoracion= $idValoracion;
            $this->idCliente = $idCliente;
            $this->idVendedor = $idVendedor;
            $this->nota= $nota;
        }

        /*ESTO DEBERIA IR EN UN FORMULARIO??????????
        public function generaCamposValoracion(){
            $html=
            '<fieldset>
                <legend> Valorar compra </legend>
                <div><label>Valora el producto: </label> <input type="text" name="nota1"  required /></div>
                <div><label>Valora al vendedor: </label> <input type="text" name="nota2"  /></div>
                <div><button type="submit" name="submit_valorar">Valorar compra</button></div>
            </fieldset>';
            return $html;
        }*/

        public function newValoracion()
        {
            $app = Aplicacion::getSingleton();
            $conn = $app->conexionBd();

            $sql = "INSERT INTO valoracion(idValoracion, idCliente, idVendedor, nota) 
            VALUES ('$this->idValoracion','$this->idCliente', $this->idVendedor, '$this->nota')";
            $ok = $conn->query($sql);
            return $ok;
        }
        public static function getValoracion($id)
        {
            $app = Aplicacion::getSingleton();
            $conn = $app->conexionBd();
            $valoracion = new Valoracion();

            $sql = "SELECT * FROM valoracion WHERE idValoracion = '$id'";
            $resultado = $conn->query($sql);
            $valoracion->createValoracion($resultado->fetch_assoc()); //Creamos un objeto Producto con los datos de la consulta
            
            return $valoracion;
        }

        public static function showValoraciones($id)
        {
            $app = Aplicacion::getSingleton();
            $conn = $app->conexionBd();
            $map = [];
            $sql = sprintf("SELECT * FROM valoracion WHERE idVendedor = $id");

            if($resultado = $conn->query($sql)){
                if($resultado->num_rows > 0){
                    while ($fila = $resultado->fetch_assoc()) {
                        echo "<pre>ID valoracion: " . $fila['idValoracion'] . " ID cliente: " . $fila['idCliente'] . " nota: ". $fila['nota']."</pre>";
                        
                    }
                }
            }                
        }

        public function createValoracion($row)
        {   
            $this->idValoracion = $row['idValoracion'];
            $this->idCliente = $row['idCliente'];
            $this->idVendedor = $row['idVendedor'];
            $this->nota = $row['nota'];
            
        }
    }