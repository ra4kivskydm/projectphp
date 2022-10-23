<?php
require_once "connect.php";

$productId = $_GET['id'];
$count = mysqli_query($connect, "SELECT `bought`, `amount` FROM `product` WHERE `id` = '$productId'");
$count = mysqli_fetch_assoc($count);
$bought = (int)$count['bought'] +1;
$amount = (int)$count['amount'] -1;
if($count['amount'] <= 0){
    header("Location: ../index.php");
} else {
    mysqli_query($connect, "UPDATE `product` SET `bought` = '$bought', `amount` = '$amount' WHERE `product`.`id` = '$productId'");
}
header("Location: ../index.php");
