<?php
session_start();
include 'partials/dbconnect.php';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $crypto_name = $_POST['crypto_name'];
    $wallet = $_POST['wallet'];

    // Retrieve row with the given ID from the database
    $sql = "SELECT * FROM crypto_wallet_address WHERE id='$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    // Update row in the database
    $sql = "UPDATE crypto_wallet_address SET crypto_name='$crypto_name', wallet='$wallet' WHERE id='$id'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $_SESSION['message'] = 'Amount updated successfully';
        $_SESSION['alert-class'] = 'alert-success';
    } else {
        $_SESSION['message'] = 'Failed to update amount';
        $_SESSION['alert-class'] = 'alert-danger';
    }

    header('location: crypto_wallet_change.php');
    exit();
}

// Retrieve row with the given ID from the database
$id = isset($_GET['id']) ? $_GET['id'] : 1;

if ($id) {
    $sql = "SELECT * FROM crypto_wallet_address WHERE id='$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
}

// Generate HTML for the edit form
echo '<div class="container">';
echo '<h2>Edit Amount</h2>';
echo '<form action="' . $_SERVER['PHP_SELF'] . '" method="POST">';
if (isset($row)) {
    echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
    echo '<div class="mb-3">';
    echo '<label for="Account Name" class="form-label">account_name</label>';
    echo '<input type="text" class="form-control" id="crypto_name" name="crypto_name" value="' . $row['crypto_name'] . '">';
    echo '<br>';
    echo '<label for="numbers" class="form-label">wallet</label>';
    echo '<input type="text" class="form-control" id="wallet" name="wallet" value="' . $row['wallet'] . '">';
    echo '</div>';
    echo '<button type="submit" class="btn btn-primary">Save Changes</button>';
} else {
    echo '<p>No row found with ID ' . $id . '</p>';
}
echo '</form>';
echo '</div>';


?>