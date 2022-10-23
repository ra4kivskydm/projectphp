<?php
session_start();
require_once "connect.php";

$productId = $_GET['id'];
$products = mysqli_query($connect, "SELECT * FROM `product` WHERE `id` = '$productId'");
$products = mysqli_fetch_assoc($products);
include_once "login_web.php";
?>

<table>
        <tr>
            <th>id</th>
            <th>Name</th>
            <th>Amount</th>
            <th>Price</th>
            <th>Rating</th>
            <th>Bought</th>
        </tr>
        <tr>
            <td><?= $products['id']?></td>
            <td><?= $products['name']?></td>
            <td><?= $products['amount']?></td>
            <td><?= $products['price']?>$</td>
            <td><?= $products['rate']?></td>
            <td><?= $products['bought']?></td>


        </tr>

    </table>
<!--?????-->
<?php if ($products['product_place'] !== null && $products['product_place'] !== '') { ?>
<img src="<?= $products['product_place']?>" width="200 px" height="200 px">
<?php
}
?>
<br>
<h2>Comments</h2>
<br>
<?php
$comments = mysqli_query($connect, "SELECT `comments`.`id`, comments.product_id, comments.user_id, product.id, product.name AS product_name, users.id, users.login as user_name,`comment` 
FROM `comments` INNER JOIN `product` ON `comments`.`product_id` = `product`.`id` INNER JOIN `users` ON `comments`.`user_id` = `users`.`id` WHERE `product_id` = '$productId'");
$comments = mysqli_fetch_all($comments);
if(isset($_SESSION['user'])) { ?>
    <form action="comments_crud/create.php" method="post">
        <input type="hidden" value="<?= $productId?>" name="id">
        <input type="hidden" value="<?= $_SESSION['user']['id']?>" name="login">
        <p>Create comment</p>
        <input type="text" name="comment" >
        <button type="submit">Create comment</button>
    </form>
    <?php
}
?>


<table>
    <tr>
        <th>User</th>
        <th>Comment</th>
    </tr>
    <?php


foreach ($comments as $comment) {
    ?>
    <tr>
        <td><?= $comment[6]?></td>
        <td><?= $comment[7]?></td>
        <?php
        $user = $_SESSION['user']['login'];
        if(isset($_SESSION['user']) && $_SESSION['user']['login'] === $comment[6]) { ?>
        <td><a href="comments_crud/delete.php?id=<?= $comment[0] ?>&product_id=<?= $comment[1] ?>">Delete</a></td>
        <?php

        }
        ?>
    </tr>
<?php
} ?>
</table>
