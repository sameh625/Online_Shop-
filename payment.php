<?php
include_once 'database.php';
session_start();
if (!isset($_SESSION['userID'])) {
    header("location: login.php");
}
?>

    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Payment - Online Shop</title>
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
    <div class="total-container">
        <h4>Total Price: <?php echo $_SESSION['grand_total']?></h4>
    </div>
    <div class="container">
        <h2>Payment</h2>
        <form action="payment.php" method="post">
            <input type="text" name="fullName" placeholder="Full Name" class="TextBox" required>
            <input type="email" name="email" placeholder="Email" class="TextBox" required>
            <input type="tel" name="telephone" placeholder="Phone Number" class="TextBox" required>
            <input type="text" name="address" placeholder="Address" class="TextBox" required>
            <input type="text" name="cardNumber" placeholder="Card Number" class="TextBox" required>
            <label>
                <input type="date" name="cardExpDate" placeholder="Card Expire Date" class="dateInput" required>
                Card Expire Date
            </label>
            <input type="password" name="cardCVV" placeholder="CVV" class="TextBox" required>
            <input type="submit" name="confirm" id="confirmBtn" value="Confirm">
        </form>
        <a href="cart.php">Back to Cart</a>
    </div>
    </body>
    </html>

<?php
if (isset($_POST["confirm"])) {
    $fullName = filter_input(INPUT_POST, "fullName", FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
    $telephone = filter_input(INPUT_POST, "telephone", FILTER_SANITIZE_SPECIAL_CHARS);
    $address = $_POST["address"];
    $totalPrice = $_SESSION['grand_total'];
    $cardNumber = filter_input(INPUT_POST, "cardNumber", FILTER_SANITIZE_SPECIAL_CHARS);
    $cardExpDate = $_POST["cardExpDate"];
    $cardCVV = filter_input(INPUT_POST, "cardCVV", FILTER_SANITIZE_SPECIAL_CHARS);
    $userID = $_SESSION['userID'];
    $select = "SELECT * FROM users where userID = '$userID' and cardNumber = '$cardNumber' and cardExpDate = '$cardExpDate' and cardCVV = '$cardCVV'";
    $result = mysqli_query($GLOBALS["conn"], $select);
    if (mysqli_num_rows($result) != 0) {
        $sql = "INSERT INTO orders (fullName, email, phoneNumber, address, price) VALUES ('$fullName', '$email', '$telephone', '$address', '$totalPrice')";
        mysqli_query($GLOBALS["conn"], $sql);
        $sql = "DELETE FROM carts WHERE userID = '$userID'";
        mysqli_query($GLOBALS["conn"], $sql);
        echo '<script>alert("Order confirmed!"); setTimeout(function() {window.location.href = "index.php";}, 0)</script>';
    } else {
        echo '<script>alert("Card Details incorrect!");</script>';
    }
}