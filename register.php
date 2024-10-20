<?php
include_once 'database.php';
session_start();
if (isset($_SESSION['userID'])) {
    header("location: index.php");
}
?>
    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Register - Online Shop</title>
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
                <li><a class="active" href="login.php">Log in</a></li>
            </ul>
        </div>
    </section>
    <div class="container">
        <h2>Register</h2>
        <form action="register.php" method="post">
            <input type="text" name="username" placeholder="Username" class="TextBox" required>
            <input type="email" name="email" placeholder="Email" class="TextBox" required>
            <input type="password" name="password" placeholder="Password" class="TextBox" required>
            <input type="password" name="repeatPassword" placeholder="Repeat Password" class="TextBox" required>
            <input type="text" name="cardNumber" placeholder="Card Number" class="TextBox" required>
            <label>
                <input type="date" name="cardExpDate" placeholder="Card Expire Date" required>
                Card Expire Date
            </label>
            <input type="password" name="cardCVV" placeholder="CVV" class="TextBox" required>
            <input type="submit" name="register" id="submitBtn" value="Register">
        </form>
        <a href="login.php">Back to Login</a>
    </div>
    </body>
    </html>

<?php
if (isset($_POST["register"])) {
    $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
    $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);
    $repeatPassword = filter_input(INPUT_POST, "repeatPassword", FILTER_SANITIZE_SPECIAL_CHARS);
    $cardNumber = filter_input(INPUT_POST, "cardNumber", FILTER_SANITIZE_SPECIAL_CHARS);
    $cardExpDate = $_POST["cardExpDate"];
    $cardCVV = filter_input(INPUT_POST, "cardCVV", FILTER_SANITIZE_SPECIAL_CHARS);

    if ($password != $repeatPassword) {
        echo '<script>alert("Password does not match wit repeat password!");</script>';
    } else {
        $hashedPassword = md5($password);
        $select = "SELECT * FROM users where username = '$username'";
        $result = mysqli_query($GLOBALS["conn"], $select);
        if (mysqli_num_rows($result) == 0) {
            $sql = "INSERT INTO users (username, email, password, userType, cardNumber, cardExpDate, cardCVV) VALUES  ('$username', '$email', '$hashedPassword', 0, '$cardNumber', '$cardExpDate', '$cardCVV')";
            mysqli_query($GLOBALS["conn"], $sql);
            header('location: login.php');
        } else {
            echo '<script>alert("User is already taken!");</script>';
        }
    }
}