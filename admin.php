<?php

session_start();
// Check if user is not logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
  // Redirect to login page
  header("Location: login.php");
  exit;
}

// Check if user is not an admin
if (!$_SESSION['is_admin']) {
  // Redirect to index page
  header("Location: allusers.php");
  exit;
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  include 'partials/dbconnect.php';
  $email = $_POST["email"];
  $password = $_POST["password"];
  
  $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
  $result = mysqli_query($conn, $sql);
  $num = mysqli_num_rows($result);
  if ($num == 1) {
    $user = mysqli_fetch_assoc($result);
    $_SESSION['loggedin'] = true;
    $_SESSION['email'] = $email;
    $_SESSION['is_admin'] = $user['is_admin'];
    if ($_SESSION['is_admin']) {
      header("Location: admin.php");
    } else {
      header("Location: index.php");
    }
    exit;
  } else {
    // Show an error message
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin panel</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="adminstyle.css">
</head>
<body>
   <div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
        <?php require 'partials/adminnav.php'?>
        </div>
    </div>
   </div>
</body>
</html>