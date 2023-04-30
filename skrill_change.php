<?php 
session_start();

include 'partials/dbconnect.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>change number</title>
</head>
<body>
    <?php include 'partials/adminnav.php'; ?>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <?php
            // Retrieve data from the database
$sql = "SELECT id, email FROM skrill_email";
$result = mysqli_query($conn, $sql);

// Generate HTML for the table
echo '<table class="table">';
echo '<thead><tr style="color:white;"><th>ID</th><th>Account Name</th><th>Action</th></tr></thead>';
echo '<tbody>';
while ($row = mysqli_fetch_assoc($result)) {
    echo '<tr style="color:white;">';
    echo '<td>' . $row['id'] . '</td>';
    echo '<td>' . $row['email'] . '</td>';
    echo '<td><a href="edit_skrill.php?id=' . $row['id'] . '">Edit</a></td>';
    echo '</tr>';
}
echo '</tbody>';
echo '</table>';
?>
            </div>
        </div>
    </div>
</body>
</html>