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
        $sql = "SELECT nombre, email, telefono FROM usuario WHERE nombre = '$this->nombre' OR email = '$this->email' OR telefono = '$this->telefono'";
        return $sql;
    }

    public function getUser($name) {
        $user = "SELECT nombre, email, telefono, tipoUsuario, saldo, imagen FROM usuario WHERE nombre = '$name'";
        return $user;
    }

    public function logUser()
    {
        $sql = "SELECT idUsuario, nombre, tipoUsuario, saldo, imagen FROM usuario WHERE password = '$this->password' AND (nombre = '$this->nombre' OR email = '$this->nombre')";
        return $sql;
    }

    public function createUser($row)
    {
        $this->nombre = $row['nombre'];
        $this->email = $row['email'];
        $this->telefono = $row['telefono'];
        $this->tipoUsuario = $row['tipoUsuario'];
        $this->saldo = $row['saldo'];
        $this->imagen = $row['imagen'];
    }

}


?>