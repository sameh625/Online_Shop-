<?php
include_once 'database.php';
session_start();
if (!isset($_SESSION['userType']) || $_SESSION['userType'] != 1) {
    header('location: logout.php');
}
$ID = $_GET['id'];
mysqli_query($GLOBALS["conn"] ,"DELETE FROM products WHERE productID = '$ID'");
header ('location: products.php');
