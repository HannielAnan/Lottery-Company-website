<?php
session_start();
// Connect to the database
include 'partials/dbconnect.php';

if (isset($_POST['winner'])) {
  // Retrieve the winning number and username from the form
  $winning_number = $_POST['winning_number'];
  $username = $_POST['username'];
  $id = $_POST['id'];
  // Prepare the SQL statement to delete the data from the winner table
  $stmt = $conn->prepare("DELETE FROM winner_scheme_2 WHERE  id = ?");
  
  // Bind the value to the parameter in the statement
  $stmt->bind_param("i", $id);

  // Execute the statement
  if ($stmt->execute()) {
    // Success! The data has been deleted from the winner table.
    echo "Winner data deleted successfully.";

    // Prepare the SQL statement to insert the data into the previous_winner table
    $stmt = $conn->prepare("INSERT INTO previous_winner (number, username) VALUES (?, ?)");
    
    // Bind the values to the parameters in the statement
    $stmt->bind_param("ss", $winning_number, $username);

    // Execute the statement
    if ($stmt->execute()) {
      // Success! The data has been inserted into the previous_winner table.
      echo "<p style='color: white; font-weight: bold;'>Winner data inserted into previous_winner table successfully.</p>";
    } else {
      // Oops! Something went wrong.
      echo "Error inserting winner data into previous_winner table: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
  } else {
    // Oops! Something went wrong.
    echo "Error deleting winner data: " . $stmt->error;
  }
}

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Scheme 2 winner</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">  
</head>
  <body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
            <?php require 'partials/adminnav.php'?>

</div>
</div>
<div class="row">
    <div class="col-lg-12">
    <table class="table">
            <thead style="color:white;">
              <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Four Digit Number</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
                include 'partials/dbconnect.php';
                $sql = "SELECT * FROM winner_scheme_2";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                  while($row = $result->fetch_assoc()) {
                    echo '<tr style="color:white;">';
                    echo "<td>".$row['id']."</td>";
                    echo "<td>".$row['username']."</td>";
                    echo "<td>".$row['four_digit_number']."</td>";
                    echo "<td><form method='POST'> <input type='hidden' name='id' value='" . $row['id'] . "'><input type='hidden' name='winning_number' value='" . $row["four_digit_number"] . "'><input type='hidden' name='username' value='" . $row["username"] . "'><button class='btn btn-primary' name='winner'>Send to previous winner</button></form></td>"; // add button to each row
                    echo "</tr>";
                  }
                } else {
                  echo "0 results";
                }
                $conn->close();
              ?>
            </tbody>
          </table>
    </div>
</div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  </body>
</html>
