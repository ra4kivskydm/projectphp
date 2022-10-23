<?php
session_start();
require_once "../../connect.php";
if(!isset($_SESSION['user']) || $_SESSION['user']['id'] !== $_POST['id']) {
    header("Location: ../index.php");
    die();
}
$id = $_POST['id'];
$oldPass = $_POST['oldPassword'];
$password = $_POST['password'];
$password2 = $_POST['password2'];
$result = mysqli_query($connect, "SELECT * FROM `users` WHERE `id` = '$id'");
$result = mysqli_fetch_assoc($result);

if ($password === $password2 && md5($oldPass) === $result['password']) {
    $password = md5($password);
    mysqli_query($connect, "UPDATE `users` SET `password` = '$password' WHERE `users`.`id` = '$id'");
    $_SESSION['user']['password'] = $password;
    header("Location: ../../profile.php?id=". $id);
} else {
    die("incorrect password");
}

//var_dump($result['login']);