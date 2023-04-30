<?php
session_start();
$login = false;
$showError = false;

if($_SERVER["REQUEST_METHOD"] == "POST"){
    include 'partials/dbconnect.php';
    $email = $_POST["email"];
    $password = $_POST["password"];
    $sql = "SELECT * FROM user_info123 WHERE email='$email'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        if(password_verify($password, $row['password'])){
            $login = true;
            $_SESSION['loggedin'] = true; 
            $_SESSION['email'] = $email;
            if ($email == "admin123@gmail.com") {
                header("location: admin.php"); 
            } else {
                header("location: index.php"); 
            }
        } else{
            $showError = "Invalid credentials";
        }
    } else {
        printf("Error: %s\n", mysqli_error($conn));
        exit();
    }
}
                
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
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
         <div class="container-fluid">
      <div class="d-flex align-items-center justify-content-center" style="height: 100vh;">
      <div class="row">
        <div class="col-lg-12">
 <?php
 if($login){
  echo'
        <div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success!</strong> Your are logged in 
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
  <span aria-hidden="true">&times;</span/>
  </button>
</div>';
}
?>
 <?php
 if($showError){
  echo'
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>Error!</strong> '.$showError.'
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
  <span aria-hidden="true">&times;</span/>
  </button>
</div>';
}
?>
        <form method="post">
  <div class="mb-3">
    <label for="email" class="form-label">Email address</label>
    <input type="email" class="form-control" placeholder="Enter email" id="email" name="email" aria-describedby="emailHelp" style="background-color:white;">
   
  </div>
  <div class="mb-3">
    <label for="qassword" class="form-label">Password</label>
    <input type="password" placeholder="Enter password" class="form-control" id="password" name="password" style="background-color:white;">
  </div>
  <button type="submit" class="btn btn-primary">Login</button>
   <a href="forgot_password.php" style="color:white">Forget Password?</a>
</form>
      </div>
      </div>
</div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  </body>
</html>
