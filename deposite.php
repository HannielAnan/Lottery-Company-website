<?php
session_start();
include 'partials/dbconnect.php';

if(isset($_POST['submit'])) {

  // retrieve user_id and username based on email
  $email = $_SESSION['email'];
  $query = "SELECT id, username FROM user_info123 WHERE email ='$email'";
  $result = mysqli_query($conn, $query);
  $user = mysqli_fetch_assoc($result);

  $user_id = $user['id'];
  $username = $user['username'];

  // retrieve form data
  $amount = $_POST['amount'];
  $phone = $_POST['phone'];
  $transaction_id = $_POST['transaction_id'];

  // check if an image file was uploaded
  if(isset($_FILES['image'])) {
    $image = $_FILES['image']['tmp_name'];
    $image_data = file_get_contents($image);
    $image_data = mysqli_real_escape_string($conn, $image_data);
  } else {
    $image_data = "";
  }

  // insert form data into database
  $query = "INSERT INTO deposit (user_id, receipt, amount, phone, user_name, transaction_id) 
            VALUES ('$user_id', '$image_data', '$amount', '$phone', '$username', '$transaction_id')";
  $result = mysqli_query($conn, $query);

  if($result) {
    // success message
    echo "<div class='alert alert-success'>Deposit Successful!</div>";
  } else {
    // error message
    echo "<div class='alert alert-danger'>Failed to deposit.</div>";
  }
}
if(isset($_POST['submit2'])) {

  // retrieve user_id and username based on email
  $email = $_SESSION['email'];
  $query = "SELECT id, username FROM user_info123 WHERE email ='$email'";
  $result = mysqli_query($conn, $query);
  $user = mysqli_fetch_assoc($result);

  $user_id = $user['id'];
  $username = $user['username'];

  // retrieve form data
  $amount2 = $_POST['amount'];
 
  // check if an image file was uploaded
  if(isset($_FILES['image2'])) {
    $image2 = $_FILES['image2']['tmp_name'];
    $image_data2 = file_get_contents($image2);
    $image_data2 = mysqli_real_escape_string($conn, $image_data2);
  } else {
    $image_data2 = "";
  }

  // insert form data into database
  $query = "INSERT INTO crypto_deposit (user_id, crypto_receipt, amount, user_name) 
            VALUES ('$user_id', '$image_data2', '$amount2', '$username')";
  $result = mysqli_query($conn, $query);

  if($result) {
    // success message
    echo "<div class='alert alert-success'>Deposit Successful!</div>";
  } else {
    // error message
    echo "<div class='alert alert-danger'>Failed to deposit.</div>";
  }
}
if(isset($_POST['submit3'])) {

  // retrieve user_id and username based on email
  $email = $_SESSION['email'];
  $query = "SELECT id, username FROM user_info123 WHERE email ='$email'";
  $result = mysqli_query($conn, $query);
  $user = mysqli_fetch_assoc($result);

  $user_id = $user['id'];
  $username = $user['username'];

  // retrieve form data
  $amount2 = $_POST['amount'];
 
  // check if an image file was uploaded
  if(isset($_FILES['image3'])) {
    $image2 = $_FILES['image3']['tmp_name'];
    $image_data2 = file_get_contents($image2);
    $image_data2 = mysqli_real_escape_string($conn, $image_data2);
  } else {
    $image_data2 = "";
  }

  // insert form data into database
  $query = "INSERT INTO skrill_deposit (user_id,receipt, amount, user_name) 
            VALUES ('$user_id', '$image_data2', '$amount2', '$username')";
  $result = mysqli_query($conn, $query);

  if($result) {
    // success message
    echo "<div class='alert alert-success'>Deposit Successful!</div>";
  } else {
    // error message
    echo "<div class='alert alert-danger'>Failed to deposit.</div>";
  }
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Deposit</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="style.css">
    <!-- style main css -->
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/dark-version.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

</head>
<body>
<?php require 'partials/nav.php'?>
<h2 style="font-size:20px; color:white; text-align:center;margin-top: 10px;">Coin Price $1 dollar = 100 coins</h2>
<h2 style="font-size:20px; color:white; text-align:center;">Coin Price Rs.300PKR = 100 coins</h2>
  <div class="container-fluid">
   <div class="row" style="margin-top:35px;">
    <div class="col-lg-4 mx-auto text-center">
    <button class="glow-on-hover" data-toggle="modal" data-target="#jazzCashModal" type="button">Jazz Cash Details</button>
  </div>
    <div class="col-lg-4 mx-auto text-center">
    <button class="glow-on-hover" data-toggle="modal" data-target="#CryptoModal" type="button">Crypto Details</button>
    </div>
    <div class="col-lg-4 mx-auto text-center">
    <button class="glow-on-hover" data-toggle="modal" data-target="#SkrillModal" type="button">Skrill</button>
    </div>
   </div>
  </div>
  <div class="modal fade" id="SkrillModal" tabindex="-1" role="dialog" aria-labelledby="SkrillModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content" style="background-color:black;">
      <div class="modal-header">
        <h5 class="modal-title" id="SkrillModalLabel" style="color:white;">Skrill Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <img src="assets/images/skrill.png">
        <form method="post" enctype="multipart/form-data">
        <label for="amount">Amount:</label>
			<input type="number" name="amount" placeholder="Enter Deposit amount" required>
      <label for="image">Upload a reciept:</label>
        <input type="file" class="form-control-file" id="image3" name="image3">
        <button type="submit" name="submit3" class="btn btn-primary" value="Deposit">Confirm</button>
        </form>
        <?php
        $query = "SELECT * FROM skrill_email";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);
        ?>
        <p style="color:white;">Email: <span id="Skrill_email" style="color:white;"><?php echo $row['email']; ?></span><button onclick="copyToClipboard3()">Copy</button></p>
        <p style="color:white;">Use the above given information to send money.(ATTACH SCREENSHOT OF DEPOSIT)Required</p>
      </div>
    </div>
  </div>
</div>
  <div class="modal fade" id="jazzCashModal" tabindex="-1" role="dialog" aria-labelledby="jazzCashModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content" style="background-color:black;">
      <div class="modal-header" style="backgroung-color:black;">
        <h5 class="modal-title" id="jazzCashModalLabel" style="color:white;">Jazz Cash Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <img src="assets/images/jazz.png" style="height:80px; margin-left:120px;">
         <br>
         <form method="post" enctype="multipart/form-data">
         <label for="amount">Amount(Minimum 300PKR):</label>
			<input type="number" name="amount" placeholder="Enter Deposit amount" required>
      <label for="phone">Enter your jazz cash number:</label>
      <input type="tel" id="phone" name="phone" placeholder="Enter your jazz cash number:" required>
      <label for="transaction_id">Transaction Id:</label>
			<input type="number" name="transaction_id" placeholder="Transaction Id:" required>
      <label for="image">Upload a reciept:</label>
        <input type="file" class="form-control-file" id="image" name="image">
        <p style="color:white;">Before requesting a deposit please make a transfer using payment details stated below</p>
<button type="submit"  name="submit" class="btn btn-primary">Confirm</button>
</form>
        <?php
        $query = "SELECT * FROM jazz_cash_number";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);
        ?>
        <p style="color:white;">Account Name: <?php echo $row['account_name']; ?></p>
        <p style="color:white;">Account Number: <span id="account_number" style="color:white;"><?php echo $row['numbers']; ?></span><button onclick="copyToClipboard()">Copy</button></p>
        <p style="color:white;">صرف جاز کیش کے ذریعہ پیسے بھیجیں. ایزی پیسہ اور بینک ٹرانسفر شدہ رقم آپ کے اکاؤنٹ میں جمع نہیں ہوگی اور آپ اس نقصان کے ذمہ دار ہوں گے۔ غلط ٹرانزیکشن آئی ڈی کے ذریعے تصدیق نہ کریں کہ آپ کا اکاؤنٹ 24 گھنٹے تک کام نہیں کرے گا</p>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="CryptoModal" tabindex="-1" role="dialog" aria-labelledby="CryptoModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content" style="background-color:black;">
      <div class="modal-header">
        <h5 class="modal-title" id="CryptoModalLabel" style="color:white;">Crypto Wallet Address</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <img src="assets/images/usdt.jpeg" style="height:80px; margin-left:180px;">
      <br>
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
        <label for="amount">Amount(Minimum 2 USDT):</label>
			<input type="number" name="amount" placeholder="Enter Deposit amount" required>
      <label for="image">Upload a reciept:</label>
        <input type="file" class="form-control-file" id="image2" name="image2">
        <button type="submit" name="submit2" class="btn btn-primary" value="Deposit">Submit</button>
        </form>
        <?php
        $query = "SELECT * FROM crypto_wallet_address";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);
        ?>
        <p style="color:white;">Account Name: <?php echo $row['crypto_name']; ?></p>
        <p style="color:white;">USDT TRON(TRC20): <span id="crypto_wallet" style="color:white;"><?php echo $row['wallet']; ?></span><button onclick="copyToClipboard2()">Copy</button></p>
        <p style="color:white;">Use the above given information to send USDT TRON(TRC20). Please don't use another crypto network from your crypto account.Use only TRON(TRC20). (ATTACH SCREENSHOT OF DEPOSIT)Required</p>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
<!-- Popper.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.3/umd/popper.min.js"></script>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script>
function copyToClipboard() {
  /* Get the text field */
  var accountNumber = document.getElementById("account_number");
  
  /* Select the text field */
  var range = document.createRange();
  range.selectNode(accountNumber);
  window.getSelection().removeAllRanges();
  window.getSelection().addRange(range);
  
  /* Copy the text inside the text field */
  document.execCommand("copy");
  
  /* Alert the copied text */
  alert("Copied the account number: " + accountNumber.innerHTML);
};
function copyToClipboard2() {
  /* Get the text field */
  var crypto_wallet = document.getElementById("crypto_wallet");
  
  /* Select the text field */
  var range = document.createRange();
  range.selectNode(crypto_wallet);
  window.getSelection().removeAllRanges();
  window.getSelection().addRange(range);
  
  /* Copy the text inside the text field */
  document.execCommand("copy");
  
  /* Alert the copied text */
  alert("Copied the crypto wallet address: " + crypto_wallet.innerHTML);
}
function copyToClipboard3() {
  /* Get the text field */
  var Skrill_email = document.getElementById("Skrill_email");
  
  /* Select the text field */
  var range = document.createRange();
  range.selectNode(Skrill_email);
  window.getSelection().removeAllRanges();
  window.getSelection().addRange(range);
  
  /* Copy the text inside the text field */
  document.execCommand("copy");
  
  /* Alert the copied text */
  alert("Copied the skrill email: " + Skrill_email.innerHTML);
}
</script>
</body>
</html>
