<?php
session_start();
include 'partials/dbconnect.php';

// Query the database to retrieve the data from the table
$sql = "SELECT * FROM withdraw";
$result = mysqli_query($conn, $sql);
// Get the selected date from the user
if (isset($_GET['date'])) {
    $selected_date = $_GET['date'];
} else {
    $selected_date = date('Y-m-d');
}

// Retrieve data from the database for the selected date
$sql = "SELECT * FROM withdraw WHERE DATE(dt) = '$selected_date'";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>withdraw request</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
            <?php require 'partials/adminnav.php'?>
            <h1 style="color:white;text-align:center;">Withdraw Request from users</h1>
            <form action="" method="get" class="mt-3">
            <label for="datepicker" style="color:white;">Select a date:</label>
            <input type="date" id="datepicker" name="date" value="<?php echo $selected_date; ?>">
            <button type="submit" class="btn btn-primary">View</button>
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
                        <th>amount</th>
                        <th>Wallet Address</th>
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
                            echo '<td style="color:white; font-size:20px;">' . $row['amount'] . "</td>";
                            echo '<td style="color:white; font-size:20px;">' . $row['wallet_address'] . "</td>";
                            echo '<td style="color:white; font-size:20px;">' . $row['dt'] . "</td>";
                            echo '</tr>';
                        }
                    ?>
                </tbody>
            </table>
            </div>
        </div>
    </div>
</body>
</html>