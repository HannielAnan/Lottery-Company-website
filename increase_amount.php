<?php
  //connect to the database
  $conn = mysqli_connect("localhost", "root", "", "moon_winner");
  //retrieve the user id from the post request
  $userId = $_POST['id'];
  //increase the amount
  $sql = "UPDATE users SET wallet = wallet + 1 WHERE id = '$userId'";
  mysqli_query($conn, $sql);
  mysqli_close($conn);
?>
