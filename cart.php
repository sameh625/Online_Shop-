<?php
include_once 'database.php';
session_start();
if (!isset($_SESSION['userID'])) {
    header("location: login.php");
}
if(isset($_GET['deleteID'])){
    $remove_id = $_GET['deleteID'];
    mysqli_query($GLOBALS['conn'], "DELETE FROM carts WHERE id = '$remove_id'") or die('query failed');
    header("Refresh:0; url=cart.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home - Online Shop</title>
    <script src="https://kit.fontawesome.com/2c02af15a9.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<section id="header">
    <div class="logo"><a href="index.php"><img src="images/logo.png"  alt=""></a></div>
    <div>
        <ul id="navbar">
            <li><a href="index.php">Home</a></li>
            <li><a href="index.php#products">Products</a></li>
            <li><a class="active" href="cart.php"><i class="fa-solid fa-cart-shopping"></i></a></li>
            <li><a href="logout.php">Log out</a></li>
        </ul>
    </div>
</section>
<div class="table-container">
    <h3>CART PRODUCTS</h3>
    <table class='table'>
        <thead>
        <tr>
            <th scope='col'>Product Name</th>
            <th scope='col'>Product Price</th>
            <th scope='col'>Delete Product</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $user_id = $_SESSION['userID'];
        $cart_query = mysqli_query($GLOBALS['conn'], "SELECT * FROM carts WHERE userID = '$user_id'") or die('query failed');
        $grand_total = 0;
        if (mysqli_num_rows($cart_query) > 0) {
            while ($row = mysqli_fetch_assoc($cart_query)) {
                $grand_total += $row['price'];
                $_SESSION['grand_total'] = $grand_total;
                ?>
                <tr>
                    <td><?php echo $row['productName']; ?></td>
                    <td><?php echo $row['price']; ?></td>
                    <td><a href='cart.php?deleteID=<?php echo $row['id']; ?>' class='btn btn-danger'>Delete</a></td>
                </tr>
            <?php }
        } ?>
        </tbody>
        <tfoot>
        <tr>
            <td colspan="3">TOTAL: <?php echo $grand_total; ?></td>
        </tr>
        </tfoot>
    </table>
    <a href="payment.php" class="btn btn-success" id="goToPay">PAY</a>
    <a href="index.php" class="btn btn-info" id="backToHome">BACK TO HOME</a>
</div>
</body>
</html>