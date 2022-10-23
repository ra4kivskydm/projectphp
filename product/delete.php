<?php
session_start();
require_once "../connect.php";
if(isset($_SESSION['user'])) {
    $productId = $_GET['id'];
    $file = mysqli_query($connect, "SELECT `product_place` FROM `product` WHERE `id` = '$productId'");
    $file = mysqli_fetch_assoc($file);
    if ($file['product_place'] !== null) {
        unlink('../' . $file['product_place']);
    }

    $productId = $_GET['id'];
    $product = mysqli_query($connect, "DELETE FROM `product` WHERE `product`.`id` = '$productId'");

    header("Location: ../index.php");
} else {
    header("Location: ../index.php");
}
