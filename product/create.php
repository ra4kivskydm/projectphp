<?php
session_start();
require_once "../connect.php";
if(!isset($_SESSION['user'])) {
    header("Location: ../index.php");
} else {
//print_r($_POST);
    $name = $_POST['name'];
    $amount = $_POST['amount'];
    $price = $_POST['price'];
    $rate = $_POST['rate'];
    $bought = $_POST['bought'];
    $path = "uploads/" . time() . rand(10, 100). $_FILES['productPicture']['name'];
    move_uploaded_file($_FILES['productPicture']['tmp_name'], "../" . $path);

    mysqli_query($connect, "INSERT INTO `product` (`id`, `name`, `amount`, `price`, `rate`, `bought`, `product_place`) 
    VALUES (NULL, '$name', '$amount', '$price', '$rate', '$bought', '$path')");
    header('Location: ../index.php');
}