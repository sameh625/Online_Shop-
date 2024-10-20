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
    <title>Admin - Online Shop</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h2>Welcome, <?php echo $_SESSION['username'] ?></h2>
    <a href="index.php" class="btn btn-success">Home</a>
    <a href="products.php" class="btn btn-info">Show All Products</a>
    <a href="logout.php" class="btn btn-danger">Logout</a>
</div>
</body>
</html>