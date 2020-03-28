<?php

class Usuario
{
    public $idUsuario;
    public $nombre;
    public $email;
    public $telefono;
    public $password;
    public $tipoUsuario;
    public $saldo;
    public $imagen;


    function __construct($nombre ="", $email = "", $telefono = "", $password = "", $tipoUsuario = 0, $saldo = 50, $imagen = 'default_profile.jpg')
    {
        $this->nombre = $nombre;
        $this->email = $email;
        $this->telefono = $telefono;
        $this->password = $password;
        $this->tipoUsuario = $tipoUsuario;
        $this->saldo = $saldo;
        $this->imagen = $imagen;
    }

    public function insertUser()
    {
        $sql = sprintf("INSERT INTO usuario( nombre, email, telefono, password, tipoUsuario, saldo, imagen) 
        VALUES ( '$this->nombre', '$this->email', '$this->telefono' , '$this->password', '$this->tipoUsuario', '$this->saldo', '$this->imagen')");
        return $sql;
    }

    public function checkUser()
    {
        $sql = "SELECT nombre, email, telefono FROM usuario WHERE nombre = '$this->nombre' OR email = '$this->email'";
        return $sql;
    }

    public static function updateSaldo($saldo, $incSaldo, $idUsuario)
    {
        $saldototal = $saldo + $incSaldo;
        $sql = "UPDATE usuario SET saldo = $saldototal WHERE idUsuario = $idUsuario";
        return $sql;
    }

    public function getUser($name) {
        $user = "SELECT idUsuario, nombre, email, telefono, tipoUsuario, saldo, imagen FROM usuario WHERE nombre = '$name'";
        return $user;
    }
    public static function getUserbyId($id) {
        $sql = "SELECT idUsuario, nombre, email, telefono, tipoUsuario, saldo, imagen FROM usuario WHERE idUsuario = '$id'";
        return $sql;
    }

    public static function getAllUsers()
    {
        $sql = sprintf("SELECT * FROM usuario ");
        return $sql;
    }

    public function logUserObsolete()
    {
        $sql = "SELECT idUsuario, nombre, tipoUsuario, saldo, imagen FROM usuario WHERE password = '$this->password' AND (nombre = '$this->nombre' OR email = '$this->nombre')";
        return $sql;
    }

    public function logUser()
    {
        $sql = "SELECT idUsuario, nombre, password,tipoUsuario, saldo, imagen FROM usuario WHERE (nombre = '$this->nombre' OR email = '$this->nombre')";
        return $sql;
    }

    public function createUser($row)
    {
        $this->idUsuario = $row['idUsuario'];
        $this->nombre = $row['nombre'];
        $this->email = $row['email'];
        $this->telefono = $row['telefono'];
        $this->tipoUsuario = $row['tipoUsuario'];
        $this->saldo = $row['saldo'];
        $this->imagen = $row['imagen'];
    }

}


?>