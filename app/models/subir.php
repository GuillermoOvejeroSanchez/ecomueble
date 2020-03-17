<?php
session_start();
require_once('../bd.php');


//Campos introducidos en el form
$productname=$form['productname'];
$description=$form['description'];
$price=$form['price'];

//Guardar imagen del producto
$imgPro=saveImg("../product_img/" , $productname);
$imgPro = empty($imgPro) ? "default_profile.jpg" : $imgPro; 

//Query SQL
$sql = "INSERT INTO producto (nombre, descripcion, precio, imagen)
VALUES ('$productname', '$description', '$price', '$imgPro')";

if(!$existe && $conn->query($sql) === TRUE){
    $_SESSION['subido'] = TRUE;
    $_SESSION['product_pic'] = $imgPath;
}
$conn->close();
?>