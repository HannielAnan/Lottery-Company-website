<?php
  // Start session
  session_start();
  include 'partials/dbconnect.php';

  // Check if form has been submitted
  if (isset($_POST['submit'])) {

    // Retrieve input data and sanitize it
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);

    // Validate input data
    if ($password != $confirm_password) {
      $_SESSION['message'] = "Passwords do not match";
      header('Location: create_new_password.php');
      exit();
    }

    // Hash password
    $hash = password_hash($password, PASSWORD_DEFAULT);

    // Check if user exists in database
    $query = "SELECT * FROM user_info123 WHERE phone='$phone'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
      // User exists, update password in database
      $query = "UPDATE user_info123 SET password='$hash' WHERE phone='$phone'";
    } else {
      // User doesn't exist, show error message
      $_SESSION['message'] = "User doesn't exist. Please enter correct phone number.";
      header('Location: create_new_password.php');
      exit();
    }

    $result = mysqli_query($conn, $query);

    if (!$result) {
      // There was an error updating/inserting the password in the database
      $_SESSION['message'] = "Error updating password";
      header('Location: create_new_password.php');
      exit();
    }

    // Redirect to login page with success message
    $_SESSION['message'] = "Password updated successfully";
    header('Location: login.php');
    exit();
  }
?>

<!DOCTYPE html>
<html>
<head>
  <title>Create New Password</title>
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
  <div class="container-fluid" style="margin-top:10px;">
    <div class="row justify-content-center">
    <div class="col-lg-6 mx-auto text-center">
    <h4 style="color:white;">Create New Password</h4>
  <form method="POST" action="create_new_password.php">
    <label for="phone">Phone Number:</label>
    <input type="text" id="phone" name="phone" required><br><br>
    <input type="password" name="password" placeholder="Enter New Password" required><br><br>
    <input type="password" name="confirm_password" placeholder="Confirm New Password" required><br><br>
    <input type="submit" name="submit" value="Submit" style="background-color: #007bff;">
  </form>
    </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>
