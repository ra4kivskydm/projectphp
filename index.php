<?php
session_start();
 require_once 'connect.php';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
<?php include_once "login_web.php"; ?>

<br>
    <table>
        <tr>
            <th>id</th>
            <th>Name</th>
            <th>Amount</th>
            <th>Price</th>
            <th>Rating</th>
            <th>Bought</th>
        </tr>
        <?php
        $product = mysqli_query($connect, "SELECT * FROM `product`");
        $product = mysqli_fetch_all($product);
        foreach ($product as $products)     {
        ?>
        <tr>
            <td><?= $products[0]?></td>
            <td><a href="product.php?id=<?= $products[0]?>"><?= $products[1]?></a></td>
            <td><?= $products[2]?></td>
            <td><?= $products[3]?>$</td>
            <td><?= $products[4]?></td>
            <td><?= $products[5]?></td>
            <?php
            if(isset($_SESSION['user'])){ ?>
            <td><a href="edit.php?id=<?= $products[0]?>">Edit</a></td>
            <td><a href="product/delete.php?id=<?= $products[0]?>">Delete</a></td>
            <?php
        }
        ?>
            <td><a href="buy.php?id=<?= $products[0]?>&bought=<?= $products[5]?>">Buy</a></td>

        </tr>
        <?php
        }
        ?>
    </table>
<?php
if(isset($_SESSION['user'])) { ?>
    <form action="product/create.php" method="post" enctype="multipart/form-data">
        <p>Name</p>
        <input type="text" name="name">
        <p>Amount</p>
        <input type="number" name="amount">
        <p>Price</p>
        <input type="number" name="price">
        <p>Picture</p>
        <input type="file" name="productPicture">
        <p>Rate</p>
        <input type="number" name="rate">
        <p>Bought</p>
        <input type="number" name="bought">
        <button type="submit">add</button>
    </form>
    <?php

}
?>
</body>
</html>
