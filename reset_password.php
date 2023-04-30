<?php
session_start();
include 'partials/dbconnect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $phone = $_POST['phone'];

  // // Check if the user is authenticated and authorized to change the password
  // if ($_SESSION['phone'] != $phone) {
  //   echo "error: You are not authorized to change this password";
  //   exit();
  // }

  // Delete the old password from the database
  $stmt = mysqli_prepare($conn, "UPDATE user_info123 SET password = NULL WHERE phone = ?");
  mysqli_stmt_bind_param($stmt, "s", $phone);
  if (mysqli_stmt_execute($stmt)) {
    echo "success";
  } else {
    echo "error: " . mysqli_error($conn);
  }
  mysqli_stmt_close($stmt);
  mysqli_close($conn);
}
if (!$stmt) {
  echo "error: " . mysqli_error($conn);
  exit();
}

?>
