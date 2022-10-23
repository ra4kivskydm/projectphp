<?php
require_once "../connect.php";
if(!isset($_SESSION['user'])) {
    header("Location: index.php");
} else {
    $commentId = $_GET['id'];
    $product_id = $_GET['product_id'];

    $comment = mysqli_query($connect, "DELETE FROM `comments` WHERE `comments`.`id` = '$commentId'");


    header('Location: ../product.php?id=' . $product_id);
}