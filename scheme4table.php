<?php
session_start();


include 'partials/dbconnect.php';

if (isset($_POST['number'])) {
  $number_to_ban = $_POST['number'];
  
  // connect to database
  $mysqli = new mysqli("localhost", "root", "", "moon_winner");

  // prepare SQL statement
  $stmt = $mysqli->prepare("INSERT INTO form_4_ban_number (number, ban_until) VALUES (?, ?)");

  // bind parameters and execute
  $phone_number = $number_to_ban;
  $ban_until = date('Y-m-d H:i:s', strtotime('+1 day')); // ban for 1 day
  $stmt->bind_param("ss", $phone_number, $ban_until);
  $stmt->execute();

  // close statement and connection
  $stmt->close();
  $mysqli->close();
}
// Assuming you have already established a database connection using mysqli or PDO
// include 'partials/dbconnect.php'; // You should not use this line as it may cause the same error again

if (isset($_POST['winner'])) {
  // Retrieve the winning number and username from the form
  $winning_number = $_POST['winning_number'];
  $username = $_POST['username'];
// Turn off foreign key check
mysqli_query($conn, "SET FOREIGN_KEY_CHECKS=0");
  // Prepare the SQL statement to insert the data into the winner table
  $stmt = $conn->prepare("INSERT INTO winner_scheme_4 (six_digit_number, username) VALUES (?, ?)");
  
  // Bind the values to the parameters in the statement
  $stmt->bind_param("ss", $winning_number, $username);

  // Execute the statement
  if ($stmt->execute()) {
    // Success! The data has been inserted into the winner table.
    echo "<p style='color: white; font-weight: bold;'>Winner data inserted successfully.</p>";
  } else {
    // Oops! Something went wrong.
    echo "Error inserting winner data: " . $stmt->error;
  }
// Turn on foreign key check
mysqli_query($conn, "SET FOREIGN_KEY_CHECKS=1");
  // Close the statement
  $stmt->close();
}
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Hello, world!</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
            <?php require 'partials/adminnav.php'?>
            </div>
        </div>
        <div class="col-lg-12">
        <form method="post">
  <label for="date">Select a date:</label>
  <input type="date" id="date" name="date">
  <button type="submit">Submit</button>
</form>
        <table class="table table-bordered">
  <thead>
    <tr style="color:white;">
      <th>ID</th>
      <th>User ID</th>
      <th>Six Digit Number</th>
      <th>Amount</th>
      <th>Result</th>
      <th>Date and Time</th>
      <th>User Name</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
 
<button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#banModal">
  Ban Numbers
</button>
<button type="button" class="btn btn-danger" onclick="window.location.href='deletenumber4.php'" data-bs-toggle="modal" style="margin-left: 30px;">
 Delete Ban Numbers
</button>
<button type="button" class="btn btn-danger" onclick="window.location.href='schemewinner4.php'" data-bs-toggle="modal" style="margin-left: 30px;">
 Scheme 4 winner
</button>
<button type="button" class="btn btn-danger"  data-bs-target="#winnerModal" data-bs-toggle="modal" style="margin-left: 30px;">
Announce winner
</button>
    <?php
    // Connect to the database
    $conn = mysqli_connect("localhost", "root", "", "moon_winner");
// Check if the form is submitted and get the selected date
if (isset($_POST['date'])) {
  $date = $_POST['date'];

  // Fetch data from the "form_1" table for the selected date
  $query = "SELECT * FROM form_4 WHERE DATE(dt) = '$date'";
  $result = mysqli_query($conn, $query);
} else {
  // Fetch all data from the "form_1" table
  $query = "SELECT * FROM form_4";
  $result = mysqli_query($conn, $query);
}

    if (mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
        echo '<tr style="color:white">';
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["user_id"] . "</td>";
        echo "<td>" . $row["six_digit_number"] . "</td>";
        echo "<td>" . $row["amount"] . "</td>";
        echo "<td>" . $row["result"] . "</td>";
        echo "<td>" . $row["dt"] . "</td>";
        echo "<td>" . $row["user_name"] . "</td>";
        echo "<td><form method='POST'><input type='hidden' name='winning_number' value='" . $row["six_digit_number"] . "'><input type='hidden' name='username' value='" . $row["user_name"] . "'><button class='btn btn-primary' name='winner'>Winner</button></form></td>"; // add button to each row
        echo "</tr>";
       
    echo "</tr>";
  }
} else {
  echo "0 results";
}

mysqli_close($conn);

    
    ?>
  </tbody>
</table>

        </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
   
  </body>
  <!-- Ban Modal -->
<div class="modal fade" id="banModal" tabindex="-1" aria-labelledby="banModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="banModalLabel">Ban Number</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post">
          <div class="mb-3">
            <label for="number_to_ban" class="form-label" style="color:black;">Number to ban:</label>
            <input type="text" class="form-control" id="number_to_ban" name="number" required>
          </div>
          <div class="mb-3">
            <label for="ban_duration" class="form-label" style="color:black;">Ban duration (in days):</label>
            <input type="number" class="form-control" id="ban_duration" name="ban_duration" required>
          </div>
          <button type="submit" class="btn btn-primary" name="submit">Ban Number</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- winnig Modal -->
<div class="modal fade" id="winnerModal" tabindex="-1" aria-labelledby="winnerModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="winnerModalLabel" style="color:black;">Winning number</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post">
          <div class="mb-3">
            <label for="winning_number" class="form-label" style="color:black;">Winning number</label>
            <input type="number" class="form-control" id="winning_number" name="winning_number" required>
          </div>
          <div class="mb-3">
            <label for="username" class="form-label" style="color:black;">Username:</label>
            <input type="text" class="form-control" id="username" name="username" required>
          </div>
          <button class='btn btn-primary' name='winner'>Winner</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- JavaScript to set the hidden input value and show the modal -->
<script>
  const banModal = new bootstrap.Modal(document.getElementById('banModal'));

  function showBanModal(userId) {
    document.querySelector('#banModal input[name="number_to_ban"]').value = userId;
    banModal.show();
  }
</script>
</html>