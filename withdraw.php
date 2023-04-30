<?php
session_start();

include 'partials/dbconnect.php';

$message = ""; // initialize an empty message variable

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the user_id, username, and wallet balance from the "user_info123" table
    $user_id_query = "SELECT id, username FROM user_info123 WHERE email = ?";
    $stmt = mysqli_prepare($conn, $user_id_query);
    if (!$stmt) {
        die("Error: " . mysqli_error($conn));
    }

    // Bind the parameter and execute the statement
    mysqli_stmt_bind_param($stmt, "s", $_SESSION['email']);
    mysqli_stmt_execute($stmt);

    // Bind the result variables and fetch the results
    mysqli_stmt_bind_result($stmt, $user_id, $username);
    mysqli_stmt_fetch($stmt);

    // Close the statement
    mysqli_stmt_close($stmt);

    // Retrieve the form data
    $amount = $_POST["amount"];
    $wallet_address = $_POST["wallet_address"];

    // Insert the form data into your table
    $insert_query = "INSERT INTO withdraw(user_id, user_name, amount, wallet_address) VALUES (?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $insert_query);
    if (!$stmt) {
        die("Error: " . mysqli_error($conn));
    }

    mysqli_stmt_bind_param($stmt, "isss", $user_id, $username, $amount, $wallet_address);
    mysqli_stmt_execute($stmt);

    // Close the statement and database connection
    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    // Set the message to display to the user
    $message = "withdraw request sent.";

    // Don't redirect yet, so that the message can be displayed
      // Redirect to the homepage after displaying the success message
      header("Location: withdraw.php");
      exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Withdraw</title>
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
<h2 style="font-size:20px; color:white; text-align:center;margin-top: 10px;">Coin Price $1 dollar = 100 coins</h2>
<h2 style="font-size:20px; color:white; text-align:center;">10% withdrawl transaction fees</h2>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10">
        <?php if ($message): ?>
             <!-- Display the message to the user -->
             <div class="alert alert-success"><?php echo $message; ?></div>
             <?php endif; ?>
           <form method="post" action="withdraw.php">
           <label for="amount">Amount</label>
			<input type="number" placeholder="Enter amount" name="amount" required>
            <label for="wallet_address">Wallet Address</label>
			<input type="text" placeholder="Enter Wallet Address" name="wallet_address" required>
            <button type="submit" class="btn btn-primary">Withdraw</button>

           </form> 
        </div>
    </div>
    <br>
    <br>
    <div class="row justify-content-center">
      <div class="col-lg-8 mx-auto text-center">
        <h2 style="color:white;">withdraw only from USDT(TRC20)</h2>
        <h2 style="color:white;">Minimum withdrwal 100 coins</h2> 
        <h2 style="color:white;">Withdrwal(100 coins is equal to 1 dollars)</h2>
      </div>
    </div>
</div>
<?php require 'partials/footer.php'?> 
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>