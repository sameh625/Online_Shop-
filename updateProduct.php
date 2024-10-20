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
        <title>Update Product - Online Shop</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
    <?php
    $ID = $_GET['id'];
    $result = mysqli_query($GLOBALS['conn'],"SELECT * FROM products WHERE productID ='$ID'");
    $row = mysqli_fetch_array($result);
    ?>
    <div class="main">
        <form action="updateProduct.php?id=<?php echo $ID?>" method="post" enctype="multipart/form-data">
            <h2>Update Product</h2>
            <input type="text" name='name' value="<?php echo $row['name']?>" class="TextBox" required>
            <br>
            <input type="text" name='price' value="<?php echo $row['price']?>" class="TextBox" required>
            <br>
            <input type="file" name="IMAGE" id="FILE">
            <br>
            <input type="submit" name="update" class="btn btn-success" value="Update">
        </form>
        <a href="products.php" class="btn btn-info">Show All Products</a>
        <a href="admin.php" class="btn btn-warning">Admin Page</a>
    </div>
    </body>
    </html>

<?php
if (isset($_POST['update'])) {
    $productID = $_GET['id'];
    $NAME = $_POST['name'];
    $PRICE = $_POST['price'];
    if (!empty($_FILES['IMAGE']['name'])) {
        $image_location = $_FILES['IMAGE']['tmp_name'];
        $image_name = basename($_FILES['IMAGE']['name']);
        $image_up = "images/".$image_name;
        mysqli_query($GLOBALS['conn'], "UPDATE products SET image = '$image_up'  WHERE productID = '$productID'" );
    }
    $sql = "UPDATE products SET name ='$NAME', price = '$PRICE'  WHERE productID = '$productID'";
    mysqli_query($GLOBALS['conn'], $sql);

    header('location: admin.php');
}