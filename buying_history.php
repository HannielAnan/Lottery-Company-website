<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('Location: login.php');
    exit();
}
include 'partials/dbconnect.php';

$email = $_SESSION['email'];

$sql = "SELECT id, username FROM user_info123 WHERE email = '$email'";
$result = mysqli_query($conn, $sql);
if (!$result) {
    die('Query failed: ' . mysqli_error($conn));
}
$row = mysqli_fetch_assoc($result);
$user_id = isset($row['id']) ? $row['id'] : 0;
$username = isset($row['username']) ? $row['username'] : '';

if ($user_id > 0) {
    $sql = "SELECT three_digit_number, amount, user_name, dt FROM form_1 WHERE user_id = $user_id
    UNION ALL
    SELECT four_digit_number, amount, user_name, dt FROM form_2 WHERE user_id = $user_id
    UNION ALL
    SELECT five_digit_number, amount, user_name, dt FROM form_3 WHERE user_id = $user_id
    UNION ALL
    SELECT six_digit_number, amount, user_name, dt FROM form_4 WHERE user_id = $user_id
    UNION ALL
    SELECT seven_digit_number, amount, user_name, dt FROM car WHERE user_id = $user_id
    UNION ALL
    SELECT seven_digitiphone_number, amount, user_name, dt FROM iphone WHERE user_id = $user_id
    UNION ALL
    SELECT seven_digitmotor_number, amount, user_name, dt FROM motor WHERE user_id = $user_id";

    $result = mysqli_query($conn, $sql);
    if (!$result) {
        die('Query failed: ' . mysqli_error($conn));
    }
    
    $winners_sql = "SELECT * FROM winner WHERE username = '$username'";
    $winners_result = mysqli_query($conn, $winners_sql);
    $message1 = '';
    if (mysqli_num_rows($winners_result) > 0) {
        $winner_row = mysqli_fetch_assoc($winners_result);
        $winning_number = $winner_row['three_digit_number'];
        $dt1 = $winner_row['dt'];
        $message1 = "<div class='alert alert-success'>Congratulations! You are a winner. Your username is $username and your winning number is $winning_number. Date and time:$dt1</div>";
    }
    if (!empty($message1)) {
      // use $message2 here
  }
    $winners_sql2 = "SELECT * FROM winner_scheme_2 WHERE username = '$username'";
    $winners_result2 = mysqli_query($conn, $winners_sql2);
    $message2 = '';
    if (mysqli_num_rows($winners_result2) > 0) {
        $winner_row2 = mysqli_fetch_assoc($winners_result2);
        $winning_number2 = $winner_row2['four_digit_number'];
         $dt2 = $winner_row2['dt'];
        $message2 = "<div class='alert alert-success'>Congratulations! You are a winner. Your username is $username and your winning number is $winning_number2. Date and time:$dt2</div>";
    }   
    if (!empty($message2)) {
      // use $message2 here
  }
    $winners_sql3 = "SELECT * FROM winner_scheme_3 WHERE username = '$username'";
    $winners_result3 = mysqli_query($conn, $winners_sql3);
    $message3 = '';
    if (mysqli_num_rows($winners_result3) > 0) {
        $winner_row3 = mysqli_fetch_assoc($winners_result3);
        $winning_number3 = $winner_row3['five_digit_number'];
         $dt3 = $winner_row3['dt'];
         $message3 = "<div class='alert alert-success'>Congratulations! You are a winner. Your username is $username and your winning number is $winning_number3. Date and time:$dt3</div>";
    }
    if (!empty($message3)) {
      // use $message2 here
  }
    $winners_sql4 = "SELECT * FROM winner_scheme_4 WHERE username = '$username'";
    $winners_result4 = mysqli_query($conn, $winners_sql4);
    $message4 = '';
    if (mysqli_num_rows($winners_result4) > 0) {
        $winner_row4 = mysqli_fetch_assoc($winners_result4);
        $winning_number4 = $winner_row4['six_digit_number'];
         $dt4 = $winner_row4['dt'];
         $message4 = "<div class='alert alert-success'>Congratulations! You are a winner. Your username is $username and your winning number is $winning_number4. Date and time:$dt4</div>";
    }
    if (!empty($message4)) {
      // use $message2 here
  }
    $winners_sql5 = "SELECT * FROM car_winner WHERE username = '$username'";
    $winners_result5 = mysqli_query($conn, $winners_sql5);
    $message5 = '';
    if (mysqli_num_rows($winners_result5) > 0) {
        $winner_row5 = mysqli_fetch_assoc($winners_result5);
        $winning_number5 = $winner_row5['seven_digit_number'];
         $dt5 = $winner_row5['dt'];
         $message5 = "<div class='alert alert-success'>Congratulations! You are a winner. Your username is $username and your winning number is $winning_number5. Date and time:$dt5 </div>";
    }
    if (!empty($message5)) {
      // use $message2 here
  }
    $winners_sql6 = "SELECT * FROM motor_winner WHERE username = '$username'";
    $winners_result6 = mysqli_query($conn, $winners_sql6);
    $message6 = '';
    if (mysqli_num_rows($winners_result6) > 0) {
        $winner_row6 = mysqli_fetch_assoc($winners_result6);
        $winning_number6 = $winner_row6['seven_digitmotor_number'];
        $dt6 = $winner_row6['dt'];
        $message6 = "<div class='alert alert-success'>Congratulations! You are a winner. Your username is $username and your winning number is $winning_number6. Date and time:$dt6</div>";
    }
    if (!empty($message6)) {
      // use $message2 here
  }
    $winners_sql7 = "SELECT * FROM iphone_winner WHERE username = '$username'";
    $winners_result7 = mysqli_query($conn, $winners_sql7);
    $message7 = '';
    if (mysqli_num_rows($winners_result7) > 0) {
        $winner_row7 = mysqli_fetch_assoc($winners_result7);
        $winning_number7 = $winner_row7['seven_digitiphone_number'];
        $dt7 = $winner_row7['dt'];
        $message7 = "<div class='alert alert-success'>Congratulations! You are a winner. Your username is $username and your winning number is $winning_number7. Date and time:$dt7</div>";
    }
    if (!empty($message7)) {
      // use $message2 here
  }
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Buying History</title>
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
         <?php echo $message1?>
         <?php echo $message2?>
         <?php echo $message3?>
         <?php echo $message4?>
         <?php echo $message5?>
         <?php echo $message6?>
         <?php echo $message7?>

         <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
        <div class="table-responsive">

            <table class="table" style="color:white;">
              <thead>
                <tr>
                  <th scope="col" style="color:white;">Number</th>
                  <th scope="col" style="color:white;">Amount</th>
                  <th scope="col" style="color:white;">User Name</th>
                  <th scope="col" style="color:white;">Date</th>
                </tr>
              </thead>
              <tbody>
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                  echo "<tr>";
                  echo "<td>" . $row['three_digit_number'] . "</td>";
                  echo "<td>" . $row['amount'] . "</td>";
                  echo "<td>" . $row['user_name'] . "</td>";
                      echo "<td>" . $row['dt'] . "</td>";
                  echo "</tr>";
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  </body>
</html>
