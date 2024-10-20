<?php
include_once 'database.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home - A to Z</title>
    <script src="https://kit.fontawesome.com/2c02af15a9.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
    <style>
        h1{
            font-size: 50px;
            line-height: 64px;
            color: #222;
        }
        h2{
            font-size: 46px;
            line-height: 54px;
            color: #222;
        }
        h4{
            font-size: 20px;
            color: #222;
        }
        h6{
            font-weight: 700;
            font-size: 12px;
        }
        p{
            font-size: 16px;
            color: #465b52;
            margin: 15px 0 20px 0;
        }
        .section-p1 h2{
            color: white;
        }
        .section-p1 p{
            color: ghostwhite;
        }
    </style>
</head>
<body>
    <section id="header">
        <div class="logo"><a href="index.php"><img src="images/logo.png"  alt=""></a></div>
        <div>
            <ul id="navbar">
                <li><a class="active" href="index.php">Home</a></li>
                <li><a href="#products">Products</a></li>
                <li><a href="cart.php"><i class="fa-solid fa-cart-shopping"></i></a></li>
                        <?php
                            if (isset($_SESSION["username"])) {
                            echo '<li><a href="logout.php">Log out</a></li>';
                            } else {
                                echo '<li><a href="login.php">Log in</a></li>';
                            } ?>
            </ul>
        </div>
    </section>
    <section id="hero">
        <h4>Trade-in-offer</h4>
        <h2>Super value deals</h2>
        <h1>On all products</h1>
        <p>save more with coupons 60% sale</p>
        <button><a href="#products">Shop Now</a></button>
    </section>
    <section id="feature-box" class="section-p1">
        <div class="f-box">
            <img src="images/feature/f1.png" alt="">
            <h6>Free Shipping</h6>
        </div>
        <div class="f-box">
            <img src="images/feature/f2.png" alt="">
            <h6>Online order</h6>
        </div>
        <div class="f-box">
            <img src="images/feature/f3.png" alt="">
            <h6>Save Money</h6>
        </div>
        <div class="f-box">
            <img src="images/feature/f4.png" alt="">
            <h6>Promotions</h6>
        </div>
        <div class="f-box">
            <img src="images/feature/f5.png" alt="">
            <h6>Happy Sell</h6>
        </div>
        <div class="f-box">
            <img src="images/feature/f6.png" alt="">
            <h6>Support</h6>
        </div>
    </section>
    <section id="products" class="section-p1">
        <h2>Our Products</h2>
        <p>خصومات تصل الي% 50</p>
        <div class ="product-container">
            <?php
            $query = mysqli_query($GLOBALS["conn"], "select * from products") or die(mysqli_error($GLOBALS["conn"]));
            while ($row = mysqli_fetch_array($query)) {
                ?>
                <!-- start one produot -->
                <div class="product">
                    <img src="<?php echo $row['image']; ?>" alt="<?php echo $row['name']; ?>"/>
                    <div class="des">
                        <h5><?php echo $row['name']; ?></b></h5>
                        <div class="star">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <h4><?php echo $row['price']; ?>$</h4>
                    </div>
                    <a href='index.php?id=<?php echo $row['productID']; ?>'><i class="fa-solid fa-cart-shopping"></i></a>
                </div>
                <!--end-->
                <?php
            }
            ?>
        </div>
    </section>
</body>
</html>

<?php
if (isset($_GET['id']))  {
    $ID = $_GET['id'];
    $sui  = mysqli_query($GLOBALS['conn'],"SELECT * from products where productID='$ID'");
    $DATA = mysqli_fetch_array($sui);
    $userID = $_SESSION['userID'];
    $productName   = $DATA['name'];
    $PRICE  = $DATA['price'];
    mysqli_query($GLOBALS['conn'], "INSERT INTO carts (userID, productName, price) VALUES ('$userID', '$productName', '$PRICE')") or die('query failed');
}