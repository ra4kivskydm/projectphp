<?php
session_start();
if(!isset($_SESSION['user'])) {
    header("Location: ../index.php");
    die();
}

require_once "connect.php";
$userId = $_GET['id'];
$users = mysqli_query($connect, "SELECT * FROM `users` WHERE `id` = '$userId'");
$users = mysqli_fetch_assoc($users);
?>


    <p>hello, <?=$_SESSION['user']['login'] ?>     <a href="Autorization/logout.php">logout</a></p>

    <img src="<?= $users['avatar']?>" width="200 px" height="200 px">

<form action="Autorization/db/edit.php" method="post" enctype="multipart/form-data">
    <h2>Edit profile</h2>
    <input type="hidden" name="id" value="<?= $userId?>">
    <p>Login</p>
    <input type="text" name="login" placeholder="Login" value="<?=$_SESSION['user']['login'] ?>">
    <p>Avatar</p>
    <input type="file" name="avatar">
    <br>
    <button type="submit">Edit</button>
</form>
<form action="Autorization/db/change_pass.php" method="post">
    <h2>Change password</h2>
    <input type="hidden" name="id" value="<?= $userId?>">
    <p>Old password</p>
    <input type="password" name="oldPassword" placeholder="Password">
    <p>Password</p>
    <input type="password" name="password" placeholder="New password">
    <p>Password again</p>
    <input type="password" name="password2" placeholder="Enter password again">
    <br>
    <input type="submit" value="change">
</form>

