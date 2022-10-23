<?php
session_start();
require_once "../connect.php";

$id = $_POST['id'];
$login = $_POST['login'];
$comment = $_POST['comment'];
if(isset($_SESSION['user'])){
    mysqli_query($connect, "INSERT INTO `comments` (`id`, `product_id`, `user_id`, `comment`) VALUES (NULL, '$id', '$login', '$comment')");
    header('Location: ../product.php?id='.$id.'');
} else {
    echo "Unregistered users can't create comments, you can <a href=" . "../Autorization/login.php >Sign up</a>";
}

