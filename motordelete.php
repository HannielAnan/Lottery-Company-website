<?php
session_start();
// Connect to the database
$conn = new mysqli("localhost", "root", "", "moon_winner");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the id parameter is set
if (isset($_GET["id"])) {
    // Get the id from the URL parameter
    $id = $_GET["id"];

    // Delete the row from the database
    $sql = "DELETE FROM form_motor_ban_number WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        // Redirect back to the table page
        header("Location: cardelete.php");
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

$conn->close();
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap table with delete button</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">  
</head>
  <body><div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
            <?php require 'partials/adminnav.php'?>
</div>
</div>
</div>
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
          <h1 style="color:white;">Delete ban number</h1>
          <table class="table">
            <thead>
              <tr style="color:white;">
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              // Connect to the database
              $conn = new mysqli("localhost", "root", "", "moon_winner");
              if ($conn->connect_error) {
                  die("Connection failed: " . $conn->connect_error);
              }

              // Retrieve data from the table
              $sql = "SELECT * FROM form_motor_ban_number";
              $result = $conn->query($sql);

              // Loop through the data and generate table rows
              if ($result->num_rows > 0) {
                  while($row = $result->fetch_assoc()) {
                      echo "<tr style='color:white;'>";
                      echo "<td>" . $row["id"] . "</td>";
                      echo "<td>" . $row["number"] . "</td>";
                      echo "<td>" . $row["ban_until"] . "</td>";
                      echo '<td><a href="cardelete.php?id=' . $row["id"] . '" class="btn btn-danger">Delete</a></td>';
                      echo "</tr>";
                  }
              } else {
                  echo "<tr><td colspan='4'>No data found</td></tr>";
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
