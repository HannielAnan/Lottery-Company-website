<?php
session_start();
include 'partials/dbconnect.php';

// if (isset($_GET['number'])) {
//   $number = $_GET['number'];
//   $sql = "SELECT * FROM user_info123 WHERE phone = '$number'";
//   $result = mysqli_query($conn, $sql);

//   if (mysqli_num_rows($result) > 0) {
//       // Phone number exists in the database
//       echo "exists";
//   } else {
//       // Phone number does not exist in the database
//       echo "not_exists";
//   }
// }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forget password</title>
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
    <!-- flags -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.5.0/css/flag-icon.min.css" integrity="sha512-+xM8/lzX15Jvnd1eGRp/DLdS8W+7wkHv+E1ebK7VCEJ4OVW4e9Gv6HZyUJcl0UHfCQc+0vNNJWyHYhldiN52ag==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.12/css/intlTelInput.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.12/js/intlTelInput.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.12/js/utils.js"></script>
<!-- jQuery library -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<?php require 'partials/nav.php'?>
  <div class="container-fluid">
    <div class="row justify-content-center" style="margin-top: 40px;">
      <div class="col-lg-3">
        <h4 style="color:white;">Enter phone number that you put when you registered</h4>
        <form method="POST">
          <input type="text" name="phone" id="number" placeholder="Enter number with country code ">
          <div id="recaptcha-container"></div>
          <button type="button" onclick="phoneAuth()";>SendCode</button>
         <input type="text" id="verificationCode"  placeholder="Enter OTP" style="margin-top: 40px;"> 
         <button type="button" onclick="codeverify();">Verify code</button>
        <br>
        </form>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  <script src="https://www.gstatic.com/firebasejs/9.17.1/firebase-app-compat.js"></script>
  <script src="https://www.gstatic.com/firebasejs/9.17.1/firebase-auth-compat.js"></script>
  <script src="NumberAuthentication.js"></script>
  <script src="check_number.php"></script>
  <script>
const firebaseConfig = {
  apiKey: "AIzaSyCpeKcfG7O1__wRg3gb8UGB6m9e4l8oe3k",
  authDomain: "test-11958.firebaseapp.com",
  projectId: "test-11958",
  storageBucket: "test-11958.appspot.com",
  messagingSenderId: "469564007739",
  appId: "1:469564007739:web:d3abb4f815aaa17d6ac31e",
  measurementId: "G-77WD6CTXS9"
};
// initializing firebase SDK
firebase.initializeApp(firebaseConfig);
var coderesult; // declare coderesult variable globally
  </script>
</body>
</html>