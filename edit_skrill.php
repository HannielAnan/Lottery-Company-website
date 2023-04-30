<?php
session_start();
include 'partials/dbconnect.php';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $email = $_POST['email'];

    // Retrieve row with the given ID from the database
    $sql = "SELECT * FROM skrill_email WHERE id='$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    // Update row in the database
    $sql = "UPDATE skrill_email SET email='$email' WHERE id='$id'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $_SESSION['message'] = 'Amount updated successfully';
        $_SESSION['alert-class'] = 'alert-success';
    } else {
        $_SESSION['message'] = 'Failed to update amount';
        $_SESSION['alert-class'] = 'alert-danger';
    }

    header('location: skrill_change.php');
    exit();
}

// Retrieve row with the given ID from the database
$id = isset($_GET['id']) ? $_GET['id'] : 1;

if ($id) {
    $sql = "SELECT * FROM skrill_email WHERE id='$id'";
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
    echo '<br>';
    echo '<label for="email" class="form-label">email</label>';
    echo '<input type="text" class="form-control" id="email" name="email" value="' . $row['email'] . '">';
    echo '</div>';
    echo '<button type="submit" class="btn btn-primary">Save Changes</button>';
} else {
    echo '<p>No row found with ID ' . $id . '</p>';
}
echo '</form>';
echo '</div>';


?>