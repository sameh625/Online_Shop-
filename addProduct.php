<?php
include_once 'database.php';
session_start();

if (!isset($_SESSION['userType']) || $_SESSION['userType'] != 1) {
    header('location: logout.php');
}

?>

    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Add Product - Online Shop</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
    <div class="main">
        <form action="addProduct.php" method="post" enctype="multipart/form-data">
            <h2>Add New Product</h2>
            <input type="text" name='name' placeholder="Enter Product Name" class="TextBox" required>
            <br>
            <input type="text" name='price' placeholder="Enter Product Price" class="TextBox" required>
            <br>
            <input type="file" name="IMAGE" id="FILE">
            <br>
            <input type="submit" name="add" class="btn btn-success" value="Add">
        </form>
        <a href="products.php" class="btn btn-info">Show All Products</a>
        <a href="admin.php" class="btn btn-warning">Admin Page</a>
    </div>
    </body>
    </html>

<?php
if (isset($_POST['add'])) {
    $NAME = $_POST['name'];
    $PRICE = $_POST['price'];
    $IMAGE = $_FILES['IMAGE'];
    $image_location = $_FILES['IMAGE']['tmp_name'];
    $image_name = basename($_FILES['IMAGE']['name']);
    $image_up = "images/".$image_name;
    $sql = "INSERT INTO products (name, price, image) VALUES ('$NAME', '$PRICE', '$image_up')";
    mysqli_query($GLOBALS['conn'], $sql);

    header('location: admin.php');
}