<?php
require_once "../../connect.php";
session_start();
if(!isset($_SESSION['user'])) {
    header("Location: ../index.php");
    die();
}
$userId = $_POST['id'];
$login = $_POST['login'];

$user = mysqli_query($connect, "SELECT `avatar` FROM `users` WHERE `id` = '$userId'");
$user = mysqli_fetch_assoc($user);
//echo $user['avatar'];
if ($user['avatar'] !== 'uploads/avatars/default-avatar.png') {
    if ($user['avatar'] !== null || file_exists($user['avatar'])) {
        unlink('../../' . $user['avatar']);
    }
}
if ($_FILES['avatar']['name'] === '') {
    $path = 'uploads/avatars/default-avatar.png';
} else {
    $path =  "uploads/avatars/" . time() . $login . rand(10, 100) . $_FILES['avatar']['name'];
    move_uploaded_file($_FILES['avatar']['tmp_name'], "../../" . $path);
}

mysqli_query($connect, "UPDATE `users` SET `login` = '$login', `avatar` = '$path' WHERE `users`.`id` = '$userId'");
$_SESSION['user']['login'] = $login;
header("Location: ../../profile.php?id=". $userId);
