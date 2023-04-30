<?php
session_start();

// Retrieve the coin amount from the database table
include 'partials/dbconnect.php';

$query = "SELECT amount FROM fixed_amounts WHERE id = 4";
$stmt = mysqli_prepare($conn, $query);

if (!$stmt) {
  die("Query failed: " . mysqli_error($conn));
}

mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($result);
$amount = $row['amount'];


if (isset($_POST['submit'])) {
  // Check if user is logged in
  if (!isset($_SESSION['email'])) {
    die("You need to log in before you can submit the form.");
  }

  // Retrieve the user_id, username, and wallet balance from the "user_info123" table
  $user_id_query = "SELECT id, username, wallet FROM user_info123 WHERE email = ?";
  $stmt_user = mysqli_prepare($conn, $user_id_query);
  mysqli_stmt_bind_param($stmt_user, "s", $_SESSION['email']);
  mysqli_stmt_execute($stmt_user);
  $user_id_result = mysqli_stmt_get_result($stmt_user);

  if (mysqli_num_rows($user_id_result) > 0) {
    $user_id_row = mysqli_fetch_assoc($user_id_result);
    $user_id = $user_id_row['id'];
    $user_name = $user_id_row['username'];
    $wallet = $user_id_row['wallet'];
  } else {
    die("Error: Unable to retrieve user_id.");
  }

  // Retrieve form data
  $seven_digit_number = mysqli_real_escape_string($conn, $_POST['seven_digit_number']);
  $amount = mysqli_real_escape_string($conn, $_POST['amount']);
  // $result_input = mysqli_real_escape_string($conn, $_POST['result']);
  $dt = date("Y-m-d H:i:s");

  // Check if the entered number is in the banned numbers list
  $sql = "SELECT COUNT(*) as count FROM form_car_ban_number WHERE number = ?";
  $stmt_ban = mysqli_prepare($conn, $sql);
  mysqli_stmt_bind_param($stmt_ban, "s", $seven_digit_number);
  mysqli_stmt_execute($stmt_ban);
  $ban_result = mysqli_stmt_get_result($stmt_ban);
  $ban_row = mysqli_fetch_assoc($ban_result);

  if ($ban_row['count'] > 0) {
    // The number is banned, don't insert it into the database
    echo '<div class="alert alert-danger" role="alert">This number is banned.</div>';
  } else if ($wallet < $amount) {
    // The user's account balance is insufficient, don't insert the form data into the database
    echo '<div class="alert alert-danger" role="alert">Your account balance is insufficient.</div>';
  } else {
    // Deduct the coin amount from the user's wallet
    $new_wallet = $wallet - $amount;
    $update_wallet_query = "UPDATE user_info123 SET wallet = ? WHERE id = ?";   
    $stmt_wallet = mysqli_prepare($conn, $update_wallet_query);
    mysqli_stmt_bind_param($stmt_wallet, "ii", $new_wallet, $user_id);
    mysqli_stmt_execute($stmt_wallet);

    // Insert the form data into the database
$sql = "INSERT INTO car (user_id, seven_digit_number, amount, dt, user_name) VALUES (?, ?, ?, ?, ?)";
$stmt_car = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt_car, "issss", $user_id, $seven_digit_number, $amount, $dt, $user_name);
$result_car = mysqli_stmt_execute($stmt_car);
if ($result_car) {
    echo '<div class="alert alert-success" role="alert">buying successful.</div>';
} else {
    echo '<div class="alert alert-success" role="alert">buying successful.</div>';
}

if (!$stmt_car) {
  die("Error: " . mysqli_error($conn));
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
      <div class="row justify-content-center">
        <div class="col-lg-3 mx-auto text-center">
        <div style="text-align: center; margin-top: 50px;">
		<h2 style="color: gold;">Enter Your lucky number to win car</h2>
		<form method="post">
			<label for="six_digit_number">Seven Digit Number:</label>
			<input type="text" name="seven_digit_number" pattern="\d{7}" maxlength="7" required>
			<br><br>
      </div>
      </div>
      <div class="row justify-content-center">
        <div class="col-lg-3 mx-auto text-center">
        <div style="background-color: black; border: 2px solid gold; padding: 10px; border-radius: 10px; margin-top: 10px;">
      	<label for="amount" id="amount" style="color:white;">Coin Amount:</label>
<label for="coin_amount" style="color:white;"><?php echo $amount; ?></label>
<input type="hidden" name="amount" value="<?php echo $amount; ?>">
  </div>
	
			<br><br>
			<input type="submit" name="submit" value="Submit">
		</form>
 
	</div>
  </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <?php require 'partials/footer.php'?> 

  </body>
</html>