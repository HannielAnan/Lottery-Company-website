<?php
include 'partials/dbconnect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $phone = $_POST['phone'];
  $query = "SELECT phone FROM user_info123 WHERE phone = '$phone'";
  $result = mysqli_query($conn, $query);
  if ($result) {
    if (mysqli_num_rows($result) > 0) {
      echo 'exists';
    } else {
      echo 'not exists';
    }
  } else {
    echo 'error';
  }
}
?>
