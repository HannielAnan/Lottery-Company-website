<?php
// Connect to the database
$conn = mysqli_connect("localhost", "root", "", "moon_winner");

// Get the number to ban and ban duration from the POST request
$number_to_ban = $_POST["banned_number"];
$ban_duration = $_POST["banned_until"];

// Update the form_1 table with the ban duration for the user's number
$query = "UPDATE form_1 SET ban_duration=$ban_duration WHERE three_digit_number=$number_to_ban";
mysqli_query($conn, $query);

// Close the database connection
mysqli_close($conn);

// Redirect the user back to the admin page
header("Location: scheme1table.php");
exit();
?>
