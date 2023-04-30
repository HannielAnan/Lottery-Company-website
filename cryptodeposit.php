<?php
session_start();
include 'partials/dbconnect.php';

// Retrieving data from the database
$sql = "SELECT * FROM crypto_deposit";
$result = mysqli_query($conn, $sql);

// Get the selected date from the user
if (isset($_GET['date'])) {
    $selected_date = $_GET['date'];
} else {
    $selected_date = date('Y-m-d');
}

// Retrieve data from the database for the selected date
$sql = "SELECT * FROM crypto_deposit WHERE DATE(dt) = '$selected_date'";
$result = mysqli_query($conn, $sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crypto deposit</title>
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
        <h2 class="text-center mt-5" style="color:white;">Crypto Deposit</h2>
        <form action="" method="get" class="mt-3">
            <label for="datepicker" style="color:white;">Select a date:</label>
            <input type="date" id="datepicker" name="date" value="<?php echo $selected_date; ?>">
            <button type="submit" class="btn btn-primary">View</button>
            <a href="crypto_wallet_change.php"><button type="button" class="btn btn-danger" data-bs-toggle="modal" style="margin-left: 10px;">
  Change Fix Number
</button></a>
        </form>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
        <table class="table mt-5">
                <thead>
                    <tr style="color:white;">
                        <th>User ID</th>
                        <th>User Name</th>
                        <th>Receipt</th>
                        <th>amount</th>
                        <th>Datetime</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        // Looping through the results and outputting them in the table
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo '<td style="color:white; font-size:20px;">' . $row['user_id'] . "</td>";
                            echo '<td style="color:white; font-size:20px;">' . $row['user_name'] . "</td>";
                            echo "<td><img src='data:image/jpeg;base64," . base64_encode($row['crypto_receipt']) . "' class='custom-img'/></td>";
                            echo '<td style="color:white; font-size:20px;">' . $row['amount'] . "</td>";
                            echo '<td style="color:white; font-size:20px;">' . $row['dt'] . "</td>";
                            echo '</tr>';
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</html>