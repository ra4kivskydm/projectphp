<?php
//print_r($_SESSION['user']['login']);
if(isset($_SESSION['user'])){ ?>
    <p>hello, <a href="profile.php?id=<?=$_SESSION['user']['id'] ?>" ><?=$_SESSION['user']['login'] ?></a></p>
    <a href="Autorization/logout.php">logout</a>
    <?php
} else { ?>
    <a href="Autorization/login.php">Sign up</a>
    <a href="Autorization/register.php"> Register</a>
    <?php
}
?>
