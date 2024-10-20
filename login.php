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
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Login - Online Shop</title>
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
        <h2>Login</h2>
        <form action="login.php" method="post">
            <input type="text" name="username" placeholder="Username" class="TextBox" required>
            <input type="password" name="password" placeholder="Password" class="TextBox" required>
            <input type="submit" name="login" id="submitBtn" value="Login">
        </form>
        <a href="register.php">Register</a>
    </div>
    </body>
    </html>

<?php
if (isset($_POST["login"])) {
    $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
    $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);
    $hashedPassword = md5($password);
    $sql = " SELECT * FROM users WHERE username = '$username' && password = '$hashedPassword' ";
    $result = mysqli_query($GLOBALS["conn"], $sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);
        $_SESSION['userID'] = $row['userID'];
        $_SESSION['userType'] = $row['userType'];
        $_SESSION['username'] = $row['username'];
        $_SESSION['cardNumber'] = $row['cardNumber'];
        $_SESSION['cardExpDate'] = $row['cardExpDate'];
        $_SESSION['cardCVV'] = $row['cardCVV'];

        if ($row['userType'] == '1') {
            header('location: admin.php');
        } elseif ($row['userType'] == '0') {
            header('location: index.php');
        }
    } else {
        echo '<script>alert("Incorrect username or password!");</script>';
    }
}