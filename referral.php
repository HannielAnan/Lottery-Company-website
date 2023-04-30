<?php
session_start();
include 'partials/dbconnect.php';

// Retrieve the username of the logged-in user from the user_info123 table
if (!isset($_SESSION['email'])) {
    header('Location: login.php');
    exit();
}
$email = $_SESSION['email'];
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$username_query = "SELECT username FROM user_info123 WHERE email = '".$_SESSION['email']."'";

$result = mysqli_query($conn, $username_query);
if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}
$row = mysqli_fetch_assoc($result);
if (!$row) {
    die("No user found with email: " . $_SESSION['email']);
}
$user_name = $row['username'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Referral Code</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    <!-- site favicon -->
    <link rel="icon" type="image/png" href="assets/images/favicon.png" sizes="16x16">
    <!-- bootstrap 4  -->
    <link rel="stylesheet" href="assets/css/vendor/bootstrap.min.css">
    <!-- fontawesome 5  -->
    <link rel="stylesheet" href="assets/css/all.min.css">
    <!-- line-awesome webfont -->
    <link rel="stylesheet" href="assets/css/line-awesome.min.css">
    <!-- custom select css -->
    <link rel="stylesheet" href="assets/css/vendor/nice-select.css">
    <!-- animate css  -->
    <link rel="stylesheet" href="assets/css/vendor/animate.min.css">
    <!-- lightcase css -->
    <link rel="stylesheet" href="assets/css/vendor/lightcase.css">
    <!-- slick slider css -->
    <link rel="stylesheet" href="assets/css/vendor/slick.css">
    <!-- jquery ui css -->
    <link rel="stylesheet" href="assets/css/vendor/jquery-ui.min.css">
    <!-- datepicker css -->
    <link rel="stylesheet" href="assets/css/vendor/datepicker.min.css">
    <!-- style main css -->
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/dark-version.css">
</head>
<body>
<?php require 'partials/nav.php'?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12  mx-auto text-center">
            <h3 style="color:white; font-size: 48px; margin-top: 150px;">Your Username: <?php echo($user_name); ?></h3> 
            <h4 style="color:white;">Your username is referral code If someone signup with your code you both will get 2 coins</h4>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>
