<?php
require_once "../../connect.php";

$login = $_POST['login'];
$password = $_POST['password'];
$password2 = $_POST['password2'];
$result = mysqli_query($connect, "SELECT * FROM `users` WHERE `login` = '$login'");
$result = mysqli_fetch_assoc($result);
//var_dump($result['login']);

if($result['login'] === $login){
    echo ("login already exists");
    die();
} else {
    if ($password === $password2) {
        $path = "../../uploads/avatars/default-avatar.png";
        if(isset($_FILES['avatar'])) {
            $path = "uploads/avatars/" . time() . $login . rand(10, 100) . $_FILES['avatar']['name'];
            move_uploaded_file($_FILES['avatar']['tmp_name'], "../../" . $path);
        }
        $password = md5($password);
        mysqli_query($connect, "INSERT INTO `users` (`id`, `login`, `password`, `avatar`) VALUES (NULL, '$login', '$password', '$path')");
        header("Location: ../login.php");
    } else {
        die("incorrect login or password");
    }
}
