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
    <title>Show Products - Online Shop</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="products-container">
    <?php
    $id = -1;
    $query = mysqli_query($GLOBALS["conn"], "select * from products") or die(mysqli_error($GLOBALS["conn"]));
    while ($row = mysqli_fetch_array($query)) {
        $id = $row['productID'];
        ?>
        <div class="card">
            <img src="<?php echo $row['image']; ?>" alt="<?php echo $row['name']; ?>" style="width: 100%"/>
            <div class="ctr">
                <h4><b><?php echo $row['name']; ?></b></h4>
                <p>Price: <?php echo $row['price']; ?>$</p>
            </div>
            <a href='deleteProduct.php?id=<?php echo $row['productID']; ?>' class='btn btn-danger'>Delete Product</a>
            <a href='updateProduct.php?id=<?php echo $row['productID']; ?>' class='btn btn-info'>Update product</a>
        </div>
        <?php
    }
    ?>
</div>
<a href="addProduct.php" class="btn btn-success">Add Product</a>
<a href="admin.php" class="btn btn-warning">Admin Page</a>
</body>
</html>