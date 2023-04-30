<?php
session_start();
include 'partials/dbconnect.php';

// Retrieve the current user information from the database
$email = $_SESSION['email'];
$sql = "SELECT * FROM user_info123 WHERE email = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $email);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($result);

if (isset($_POST['submit'])) {
   
    $phone = isset($_POST['phone']) ? $_POST['phone'] : '';

    // Validate the input values here...
    if (!preg_match("/^[0-9]{10}$/", $phone)) {
        $error = "Please enter a valid phone number";
    } else {

        // Start a transaction
        mysqli_begin_transaction($conn);

        $sql = "UPDATE user_info123 SET phone=? WHERE email=?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ss", $phone, $email);
        $result = mysqli_stmt_execute($stmt);

        if ($result) {
            // Update the session variable with the new email address
            $_SESSION['email'] = $email;

            // Commit the transaction
            mysqli_commit($conn);

            // Redirect to a success page
            header("Location: changeinfo.php");
            exit();
        } else {
            // Rollback the transaction
            mysqli_rollback($conn);

            // Handle the error
            $error = "There was an error updating your information. Please try again later.";
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change info</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <!-- site favicon -->
    <link rel="icon" type="image/png" href="assets/images/favicon.png" sizes="16x16">
    <!-- bootstrap 4  -->
    <link rel="stylesheet" href="assets/css/vendor/bootstrap.min.css">
    <!-- fontawesome 5  -->
    <link rel="stylesheet" href="assets/css/all.min.css">
    <!-- line-awesome webfont -->
    <link rel="stylesheet" href="assets/css/line-awesome.min.css">
    <!-- custom select css -->
    <link rel="stylesheet" href="assets/css/vendor/nice-select.css">
    <!-- animate css  -->
    <link rel="stylesheet" href="assets/css/vendor/animate.min.css">
    <!-- lightcase css -->
    <link rel="stylesheet" href="assets/css/vendor/lightcase.css">
    <!-- slick slider css -->
    <link rel="stylesheet" href="assets/css/vendor/slick.css">
    <!-- jquery ui css -->
    <link rel="stylesheet" href="assets/css/vendor/jquery-ui.min.css">
    <!-- datepicker css -->
    <link rel="stylesheet" href="assets/css/vendor/datepicker.min.css">
    <!-- style main css -->
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/dark-version.css">
</head>
<body>
<?php require 'partials/nav.php'?>
<div class="container mt-4">
    <h2 style="color:white;">Change User Information</h2>
    <!-- ... -->
    <form method="post">
        <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $row['phone'] ?>" style="background-color:white;">
        </div> 
        <button type="submit" name="submit" class="btn btn-primary">Save Changes</button>
    </form>
    <!-- ... -->
</div>


<?php require 'partials/footer.php'?> 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>