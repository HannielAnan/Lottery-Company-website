<?php
$showAlert = false;
$showError = false;

if($_SERVER["REQUEST_METHOD"] == "POST"){
  include 'partials/dbconnect.php';
  $username = $_POST["username"];
  $email = $_POST["email"];
  $phone = $_POST["phone"];
  $password = $_POST["password"];
  $cpassword = $_POST["cpassword"];
  $fullPhone = $_POST['countryCode'] . $_POST['phone'];
  $referralCode = isset($_POST["referral_code"]) ? $_POST["referral_code"] : '';


   // check referral code and increment wallet value
   $referralSql = '';
   if(isset($_POST['referral_code']) && !empty($_POST['referral_code'])) {
     $referralCode = $_POST['referral_code'];
     $referralSql = "SELECT * FROM `user_info123` WHERE username = '$referralCode'";
     $referralResult = mysqli_query($conn, $referralSql);
 
     $referralNumRows = mysqli_num_rows($referralResult);
     if($referralNumRows > 0) {
       $referralRow = mysqli_fetch_assoc($referralResult);
       $referrerUsername = $referralRow['username'];
       $referrerWallet = $referralRow['wallet'] + 2;
       $walletSql = "UPDATE `user_info123` SET wallet = '$referrerWallet' WHERE username = '$referrerUsername'";
       $walletResult = mysqli_query($conn, $walletSql);
 
       if (!$walletResult) {
         $showError = "Unable to update referrer's wallet";
       }
     }
   }
  // check whether the phone number already exists or not
  $existSql = "SELECT * FROM `user_info123` WHERE phone = '$phone'";
  $result = mysqli_query($conn, $existSql);
  $numExistRows = mysqli_num_rows($result);
  if($numExistRows > 0){
    $showError = "Phone number is already registered";
  }
  else{
    // check whether the phone number already exists with a different username or not
    $existSql = "SELECT * FROM `user_info123` WHERE phone = '$fullPhone' AND username != '$username'";
    $result = mysqli_query($conn, $existSql);
    $numExistRows = mysqli_num_rows($result);
    if($numExistRows > 0){
      $showError = "Phone number is already registered with a different username";
    }
    else{
      if($password == $cpassword){
        // hash the password
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO `user_info123` (`username`, `email`, `phone`, `password`, `dt`, `referral_code`) VALUES ('$username', '$email', '$fullPhone', '$hash', current_timestamp(), '$referralCode')";
        $result = mysqli_query($conn, $sql);
        if ($result){
          $showAlert = true;
        }
      }
      else{
        $showError = "Password do not match";
      }
      //if ($result){
       // $userId = mysqli_insert_id($conn); // get the ID of the newly inserted user
        // $userWalletSql = "UPDATE `user_info123` SET wallet = wallet + 2 WHERE id = '$userId'";
        //$userWalletResult = mysqli_query($conn, $userWalletSql);
        //if (!$userWalletResult) {
        //  $showError = "Unable to update user's wallet";
       // }
       // $showAlert = true;
    //  }
      
      if(isset($_POST['submit'])){
        if(!isset($_POST['terms'])){
          $showError = "Please agree to the Terms and Conditions";
        }
      }
    }
  }
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Moon Winner</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <!-- style main css -->
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/dark-version.css">
    <!--flags-->
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.5.0/css/flag-icon.min.css" integrity="sha512-+xM8/lzX15Jvnd1eGRp/DLdS8W+7wkHv+E1ebK7VCEJ4OVW4e9Gv6HZyUJcl0UHfCQc+0vNNJWyHYhldiN52ag==" crossorigin="anonymous" referrerpolicy="no-referrer" />
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.12/css/intlTelInput.min.css">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.12/css/intlTelInput.min.css">
<!-- other Firebase SDK scripts go here -->
<script src="https://www.gstatic.com/firebasejs/9.17.1/firebase-auth.js"></script>
<script src="https://www.gstatic.com/firebasejs/9.17.1/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/9.17.1/firebase-auth.js"></script>
  </head>
  <body>
    
         <?php require 'partials/nav.php'?>
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
           
      <div class="d-flex align-items-center justify-content-center" style="height: 100vh;">
 <?php
 if($showAlert){
  echo'
        <div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success!</strong> Your account is created now login
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
        <form method="post" style="margin-top: 180px;">
  <div class="mb-3">
    <label for="username" class="form-label">User Name</label>
    <input type="username" maxlength="13"  placeholder="Enter Username" class="form-control" id="username" name="username" aria-describedby="emailHelp" required style="background-color:white;">
  </div>  
  <div class="mb-3">
    <label for="email" class="form-label">Email address</label>
    <input type="email" class="form-control" placeholder="Enter Email" id="email" name="email" aria-describedby="emailHelp" required style="background-color:white;">
   
  </div>
  <div class="mb-3">
  <div class="form-group" id="recaptcha-container" style="margin-top:50px">
  <label for="phone" style="color: white;font-size: 18px;font-family: 'Josefin Sans', sans-serif;">Phone</label>
  <input type="tel" name="phone" id="phone" class="form-control" placeholder="Enter phone number" required style="background-color:white;">
</div>
<div class="form-group">
  <label for="countryCode" style="bacground-color: white;font-size: 18px;font-family: 'Josefin Sans', sans-serif;">Country code</label>
  <select name="countryCode" id="countryCode" class="form-control" required style=" bacground-color: white;">
    <option value="">Select country code</option>
  </select>
  </div> 
  <div class="mb-3">
  <label for="referral_code" class="form-label">Reference Code(Optional)</label>
  <input type="text" class="form-control" id="referral_code" name="referral_code" style="background-color:white;">
</div>
  <div class="mb-3">
    <label for="qassword" class="form-label">Password</label>
    <input type="password" maxlength="20" placeholder="Enter password"  class="form-control" id="password" name="password" required style="background-color:white;">
  </div>
  <div class="mb-3">
    <label for="cpassword1" class="form-label">Confirm Password</label>
    <input type="password" placeholder="Confirm password" class="form-control" id="cpassword" name="cpassword" style="background-color:white;">
  </div>
  <div class="mb-3 form-check">
  <input type="checkbox" id="terms" name="terms" style="padding: 0 !important;border: none !important; width: auto;background-color: white;border-radius: 8px;-webkit-border-radius: 8px;-moz-border-radius: 8px;-ms-border-radius: 8px;-o-border-radius: 8px;color: black;" required>
  <label  for="terms"  >I agree to the <a href="termsandcondition.php" target="_blank">Terms and Conditions</a></label>
</div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
      </div>
</div>
   
            </div>
          </div>
        </div>
  

   <!-- <div style="margin-top:100px;"><?php ?></div> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="https://www.gstatic.com/firebasejs/9.17.1/firebase-auth.js"></script>
<script src="https://www.gstatic.com/firebasejs/9.17.1/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/9.17.1/firebase-auth.js"></script>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script src="https://www.gstatic.com/firebasejs/9.17.1/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/9.17.1/firebase-analytics.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.12/js/intlTelInput.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.12/js/utils.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.12/js/intlTelInput.min.js"></script>
      <script>
 
 var input = document.querySelector("#phone");
  var countryCode = document.querySelector("#countryCode");

  // initialize plugin
  var iti = window.intlTelInput(input, {
    initialCountry: "auto",
    separateDialCode: true,
    utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.12/js/utils.js",
  });

  // populate country code dropdown
  var countryList = window.intlTelInputGlobals.getCountryData();
  for (var i = 0; i < countryList.length; i++) {
    var country = countryList[i];
    var option = document.createElement("option");
    option.value = "+" + country.dialCode;
    option.text = country.name + " (" + country.dialCode + ")";
    countryCode.appendChild(option);
  }
</script>

    </script>
  </body>
</html>