<?php


class Aplicacion
{
	private static $instancia = null;
	private function __construct() {}
	
	public static function getSingleton() {
		if (null === self::$instancia) {
			self::$instancia = new self();
		}
		return self::$instancia;
	}

	private $datosBD;
	private $estaIniciada = false;
	private $conn;
	
	
	
	/**
	 * Evita que se pueda utilizar el operador clone.
	 */
	private function __clone()
	{
	    parent::__clone();
	}
	
	/**
	 * Evita que se pueda utilizar unserialize().
	 */
	private function __wakeup()
	{
	    return parent::__wakeup();
	}
	
	public function init($datosBD)
	{
        if (!$this->estaIniciada ) {
    	    $this->datosBD = $datosBD;
    		session_start();
    		$this->estaIniciada = true;
        }
	}
	
	public function shutdown()
	{
        if (!$this->estaIniciada) {
	        echo "Aplicación no inicializada";
	        exit();
        }
        
	    if ($this->conn !== null) {
	        $this->conn->close();
	    }
	}
	
	public function conexionBd()
	{
        if (!$this->estaIniciada) {
	        echo "Aplicación no inicializada";
	        exit();
        }

		if (!$this->conn) {
			$host = $this->datosBD['host'];
			$user = $this->datosBD['user'];
			$password = $this->datosBD['pass'];
			$bd = $this->datosBD['bd'];
			
			$this->conn = new mysqli($host, $user, $password, $bd);
			if ($this->conn->connect_errno) {
				echo "Error de conexión a la BD: (" . $this->conn->connect_errno . ") " . utf8_encode($this->conn->connect_error);
				exit();
			}
			if (!$this->conn->set_charset("utf8mb4")) {
				echo "Error al configurar la codificación de la BD: (" . $this->conn->errno . ") " . utf8_encode($this->conn->error);
				exit();
			}
		}
		return $this->conn;
	}
}