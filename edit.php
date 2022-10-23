<?php
    session_start();
    require_once "connect.php";
    if(!isset($_SESSION['user'])) {
        header("Location: index.php");
    }
    $productId = $_GET['id'];
    $product = mysqli_query($connect, "SELECT * FROM `product` WHERE `id` = '$productId'");
    $product = mysqli_fetch_assoc($product);
//    print_r($product);
    ?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <title>edit</title>
</head>
<body>

<form action="product/update.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $product['id']?>">
    <p>Name</p>
    <input type="text" name="name" value="<?= $product['name']?>">
    <p>Amount</p>
    <input type="number" name="amount" value="<?= $product['amount']?>">
    <p>Price</p>
    <input type="file" name="productPicture">
    <p>Rate</p>
    <input type="number" name="rate" value="<?= $product['rate']?>">
    <p>Bought</p>
    <input type="number" name="bought" value="<?= $product['bought']?>">
    <button type="submit">edit</button>

</form>
</body>
</html>
