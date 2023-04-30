<?php
session_start();
include 'partials/dbconnect.php';

$sql = "SELECT id, username, email, wallet FROM user_info123";
$result = mysqli_query($conn, $sql);
// Handle search query
$search_term = '';
if (isset($_GET['username'])) {
  $search_term = mysqli_real_escape_string($conn, $_GET['username']);
  $sql = "SELECT id, username, email, wallet FROM user_info123 WHERE username LIKE '%$search_term%'";
} else {
  $sql = "SELECT id, username, email, wallet FROM user_info123";
}
$result = mysqli_query($conn, $sql);
  
if (isset($_POST['wallet']) && isset($_POST['user_id'])) {
  $wallet = $_POST['wallet'];
  $user_id = $_POST['user_id'];


$sql = "UPDATE user_info123 SET wallet = wallet + ? WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "ii", $wallet, $user_id);
mysqli_stmt_execute($stmt);

if (mysqli_stmt_affected_rows($stmt) > 0) {
  echo "Record updated successfully";
} else {
  echo "Error updating record: " . mysqli_error($conn);
}

mysqli_stmt_close($stmt);
//best outside the if statement so user isn't stuck on a white blank page.
header("location: allusers.php");
exit;
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>All User dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="adminstyle.css">
    <style>
table {
  margin: 0 auto;
  border-collapse: collapse;
  background-color: white;
}

th, td {
  border: 1px solid black;
  padding: 8px;
  text-align: center;
}

th {
  background-color: #f2f2f2;
}
</style>

  </head>
  <body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
            <?php require 'partials/adminnav.php'?>
            <div class="form-popup" id="myForm" style="display:none;">
    <form class="form-container" method="post">
  <input type="hidden" name="user_id" id="user_id">
  <h1>Add Coins</h1>
  <label for="email"><b>Coins</b></label>
  <input type="number" placeholder="Enter coins" name="wallet" required>
  <button type="submit" class="btn">Add</button>
  <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
</form>
            </div>
        </div>
        <div class="row">
          <div class="col-lg-4">
      <form method="get">
        <label for="username" class="form-label">Search by Username:</label>
        <div class="input-group">
          <input type="text" class="form-control" id="username" name="username" placeholder="Enter username">
          <button type="submit" class="btn btn-primary" id="search">Search</button>
        </div>
      </form>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-8">
          <table class="table table-striped">
  <thead>
    <tr>
      <th>ID</th>
      <th>Username</th>
      <th>Email</th>
      <th>Wallet</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
     while($row = mysqli_fetch_assoc($result)) {
       echo "<tr>";
       echo "<td>" . $row['id'] . "</td>";
       echo "<td>" . $row['username'] . "</td>";
       echo "<td>" . $row['email'] . "</td>";
       echo "<td>" . $row['wallet'] . "</td>";
      echo "<td><button class='add-button' type='button' data-id='".$row['id']."' onclick='openForm()' class='open-button'>Add</button></td>";
      echo "</tr>";
  }
    ?>
  </tbody>
</table>

          </div>
        </div>
    </div>
 

<script>
  function updateWallet() {
  const newValue = parseInt(currentValue) + parseInt(document.getElementById("amount").value);
  document.getElementById("wallet").innerHTML = newValue;

  // Send the updated balance to the server
  const xhr = new XMLHttpRequest();
  xhr.open("POST", "/update-wallet", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function() {
    if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
      // Update the wallet balance in the database
      const response = JSON.parse(this.responseText);
      if (response.success) {
        localStorage.setItem("wallet", newValue);
      } else {
        console.error("Failed to update wallet balance:", response.message);
      }
    }
  };
  xhr.send("user_id=" + document.getElementById("user_id").value + "&wallet=" + newValue);
}

  function openForm() {
    document.getElementById("myForm").style.display = "block";
    let id = event.target.getAttribute("data-id");
    document.getElementById("user_id").value = id;
  }

  function closeForm() {
    document.getElementById("myForm").style.display = "none";
  }

</script>

  </body>
</html>
