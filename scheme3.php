<?php
session_start();

// Connect to the database
include 'partials/dbconnect.php';

if (isset($_POST['submit'])) {
  // Check if user is logged in
  if (!isset($_SESSION['email'])) {
    die("You need to log in before you can submit the form.");
  }

  // Retrieve the user_id, username, and wallet balance from the "user_info123" table
  $user_id_query = "SELECT id, username, wallet FROM user_info123 WHERE email = ?";
  $stmt = mysqli_prepare($conn, $user_id_query);
  mysqli_stmt_bind_param($stmt, "s", $_SESSION['email']);
  mysqli_stmt_execute($stmt);
  $user_id_result = mysqli_stmt_get_result($stmt);

  if (mysqli_num_rows($user_id_result) > 0) {
    $user_id_row = mysqli_fetch_assoc($user_id_result);
    $user_id = $user_id_row['id'];
    $user_name = $user_id_row['username'];
    $wallet = $user_id_row['wallet'];
  } else {
    die("Error: Unable to retrieve user_id.");
  }

  // Retrieve form data
  $six_digit_number = mysqli_real_escape_string($conn, $_POST['five_digit_number']);
  $amount = mysqli_real_escape_string($conn, $_POST['amount']);
  $result_input = mysqli_real_escape_string($conn, $_POST['result']);
  $dt = date("Y-m-d H:i:s");

  // Check if the entered number is in the banned numbers list
  $sql = "SELECT COUNT(*) as count FROM form_3_ban_number WHERE number = ?";
  $stmt = mysqli_prepare($conn, $sql);
  mysqli_stmt_bind_param($stmt, "s", $six_digit_number);
  mysqli_stmt_execute($stmt);
  $ban_result = mysqli_stmt_get_result($stmt);
  $ban_row = mysqli_fetch_assoc($ban_result);

  if ($ban_row['count'] > 0) {
    // The number is banned, don't insert it into the database
    echo '<div class="alert alert-danger" role="alert">This number is banned.</div>';
  } else if ($wallet < $amount) {
    // The user's account balance is insufficient, don't insert the form data into the database
    echo'<div class="alert alert-danger" role="alert">Your account balance is insufficient.</div>';
  } else {
    // Deduct the coin amount from the user's wallet
    $new_wallet = $wallet - $amount;
    $update_wallet_query = "UPDATE user_info123 SET wallet = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $update_wallet_query);
    mysqli_stmt_bind_param($stmt, "ii", $new_wallet, $user_id);
    mysqli_stmt_execute($stmt);

    // Insert the form data into the database
    $sql = "INSERT INTO form_3 (user_id, five_digit_number, amount, result, dt, user_name) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "isssss", $user_id, $six_digit_number, $amount, $result_input, $dt, $user_name);
    $result = mysqli_stmt_execute($stmt);
    if ($result) {
      echo '<div class="alert alert-success" role="alert">buying successful.</div>';
    } else {
      echo "Error: Unable to insert form data into the database.";
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
      <!-- site favicon -->
  <link rel="icon" type="image/png" href="assets/images/favicon.png" sizes="16x16">
    <!-- bootstrap 4  -->
    <link rel="stylesheet" href="assets/css/vendor/bootstrap.min.css">
    <!-- fontawesome 5  -->
    <link rel="stylesheet" href="assets/css/all.min.css">
  
    <link rel="stylesheet" href="assets/css/line-awesome.min.css">
    <!-- custom select css -->
     <link rel="stylesheet" href="assets/css/vendor/nice-select.css">
    
     <link rel="stylesheet" href="assets/css/vendor/animate.min.css"> 
    <!-- lightcase css-->
    <link rel="stylesheet" href="assets/css/vendor/lightcase.css"> 
    <!-- slick slider css -->
     <link rel="stylesheet" href="assets/css/vendor/slick.css"> 
    <!-- jquery ui css -->
    <link rel="stylesheet" href="assets/css/vendor/jquery-ui.min.css">
  
    <link rel="stylesheet" href="assets/css/vendor/datepicker.min.css">
    <!-- style main css -->
    <link rel="stylesheet" href="assets/css/main.css"> 
    <link rel="stylesheet" href="assets/css/dark-version.css">
  </head>
  <script>
		function updateResult() {
			var amount = document.querySelector('input[name="amount"]').value;
			document.querySelector('input[name="result"]').value = amount * 10000;
		}
	</script>
  <body>
    
    
        <?php require 'partials/nav.php'?>
        <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-lg-6">
        <div style="text-align: center; margin-top: 50px;">
		<h2 style="color: gold;">Buy Your token</h2>
		<form method="post">
			<label for="five_digit_number">Five Digit Token:</label>
			<input type="text" name="five_digit_number" placeholder="Enter your number" pattern="\d{5}" maxlength="5" required>
			<br><br>
			<label for="amount">Coin Amount:</label>
			<input type="number" name="amount" oninput="updateResult()" required>
			<br><br>
			<label for="result">Winning Prize:</label>
			<input type="text" name="result" readonly>
			<br><br>
			<input type="submit" name="submit" value="Submit" style="background-color:gold;">
		</form>
	</div>
        </div>
      </div>
    </div>
    <?php require 'partials/footer.php'?> 

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  </body>
</html>