<?php
require_once "../connect.php";
session_start();
if(!isset($_SESSION['user'])) {
    header("Location: ../index.php");
} else {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $amount = $_POST['amount'];
    $price = $_POST['price'];
    $rate = $_POST['rate'];
    $bought = $_POST['bought'];


//var_dump("UPDATE `product` SET $query WHERE `product`.`id` = '$id'");
    $file = mysqli_query($connect, "SELECT `product_place` FROM `product` WHERE `id` = '$id'");
    $file = mysqli_fetch_assoc($file);
    if ($file['product_place'] !== null || file_exists($file['product_place'])) {
            unlink('../' . $file['product_place']);
        }
    if ($_FILES['productPicture']['name'] === '') {
        $path = null;

    } else {
        $path = "uploads/" . time() . $_FILES['productPicture']['name'];
        move_uploaded_file($_FILES['productPicture']['tmp_name'], "../" . $path);
    }

    $fields = [
        'name' => $name,
        'amount' => $amount,
        'price' => $price,
        'rate' => $rate,
        'bought' => $bought,
        'product_place' => $path];
    $query = '';
    foreach ($fields as $key => $field) {
        if ($field !== '') {
            if ($key !== 'product_place') {
                $query = $query . $key . ' = ' . "'" . $field . "'" . ', ';
            } else {
                    $query = $query . $key . ' = ' . "'" . $field . "' ";
            }

        }
    }


    mysqli_query($connect, "UPDATE `product` SET $query WHERE `product`.`id` = '$id'");
    header('Location: ../index.php');
}