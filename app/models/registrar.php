<?php
require_once('../bd.php');
$username = $form['username']; 
$email = $form['email'];
$tlfn = $form['tlfn'];
$password = $form['password'];


echo "<br>". $username . "<br>" . $email . "<br>" . $tlfn . "<br>" . $password;
$sql = "INSERT INTO usuario (nombre, email, password, telefono)
VALUES ('$username', '$email', '$password', '$tlfn')";


if($conn->query($sql) === TRUE){
    echo "<br> Succesfull";
}

$conn->close();

?>