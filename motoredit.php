<?php
session_start();
include 'partials/dbconnect.php';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $amount = $_POST['amount'];

    // Update row in the database
    $sql = "UPDATE motor_fixed_amounts SET amount='$amount' WHERE id='$id'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $_SESSION['message'] = 'Amount updated successfully';
        $_SESSION['alert-class'] = 'alert-success';
    } else {
        $_SESSION['message'] = 'Failed to update amount';
        $_SESSION['alert-class'] = 'alert-danger';
    }

    header('location: motornumchange.php');
    exit();
}

// Retrieve row with the given ID from the database
$id = $_GET['id'];
$sql = "SELECT * FROM motor_fixed_amounts WHERE id='$id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

// Generate HTML for the edit form
echo '<div class="container">';
echo '<h2>Edit Amount</h2>';
echo '<form action="' . $_SERVER['PHP_SELF'] . '" method="POST">';
echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
echo '<div class="mb-3">';
echo '<label for="amount" class="form-label">Amount</label>';
echo '<input type="text" class="form-control" id="amount" name="amount" value="' . $row['amount'] . '">';
echo '</div>';
echo '<button type="submit" class="btn btn-primary">Save Changes</button>';
echo '</form>';
echo '</div>';
?>
