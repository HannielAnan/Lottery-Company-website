<?php

include 'partials/dbconnect.php';

// Get the current time
$current_time = time();

// Prepare the SQL query to remove expired bans
$sql = "DELETE FROM form_1 WHERE ban_end_time < ?";
$stmt = mysqli_prepare($conn, $sql);

// Bind the current time as a parameter and execute the statement
mysqli_stmt_bind_param($stmt, "s", $current_time);
mysqli_stmt_execute($stmt);

// Close the statement
mysqli_stmt_close($stmt);

// Close the database connection
mysqli_close($conn);

?>
