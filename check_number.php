<?php
session_start();
include 'partials/dbconnect.php';
if (isset($_GET['number']) && !empty($_GET['number'])) {
  $number = $_GET['number'];
  // remove any non-numeric characters from the phone number except +
  $number = preg_replace('/[^0-9+]/', '', $number);
  error_log("Formatted number: $number");
 
  $sql = "SELECT * FROM user_info123 WHERE phone LIKE '%$number%'";
 error_log("SQL Query: $sql");

  $result = mysqli_query($conn, $sql);
  error_log("Query Result: " . print_r($result, true));

  if ($result !== false) {
    // check if any rows are returned from the query
    if (mysqli_num_rows($result) > 0) {
      // Phone number exists in the database
      echo "exists";
    } else {
      // Phone number does not exist in the database
      echo "not_exists";
    }
  } else {
    // display error if query execution fails
    echo "Query execution failed: " . mysqli_error($conn);
  }
  
} else {
  // display error if 'number' GET parameter is not set or empty
  echo "Invalid phone number";
}

?>
