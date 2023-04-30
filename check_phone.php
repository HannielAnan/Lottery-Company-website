<?php
// include the database connection
include 'partials/dbconnect.php';

// get the phone number from the query string
$phone = $_GET['phone'];

// query the database to see if the phone number exists
$query = "SELECT phone FROM user_info123 WHERE phone = '$phone'";
$result = mysqli_query($conn, $query);

// check if the query was successful
if ($result) {

  // check if the phone number exists in the database
  if (mysqli_num_rows($result) > 0) {

    // phone number exists
    echo 'exists';

  } else {

    // phone number does not exist in the database
    echo 'does not exist';

  }

} else {

  // query was not successful
  echo 'error';

}

?>
