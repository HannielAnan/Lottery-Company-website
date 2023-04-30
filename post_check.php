<?php
if (isset($_POST['submit'])) {
    if (isset($_POST['three_digit_number']) && isset($_POST['amount']) &&
        isset($_POST['result']) 
        ) {
        
        $three_digit_number = $_POST['three_digit_number'];
        $amount = $_POST['amount'];
        $result = $_POST['result'];
        $host = "localhost";
        $dbUsername = "root";
        $dbPassword = "";
        $dbName = "moon_winner";
        $conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);
        if ($conn->connect_error) {
            die('Could not connect to the database.');
        }
        else {
            $Insert = "INSERT INTO form_1(three_digit_number, amount, result) values(?, ?, ?)";
           
            // if{
            //     $stmt = $conn->prepare($Insert);
            //     $stmt->bind_param("ssssii",$three_digit_number, $amount, $result);
            //     if ($stmt->execute()) {
            //         echo "New record inserted sucessfully.";
            //     }
            //     else {
            //         echo $stmt->error;
            //     }
            // }
            // else {
            //     echo "Someone already registers using this email.";
            // }
            // $stmt->close();
            $conn->close();
        }
    }
    else {
        echo "All field are required.";
        die();
    }
}
else {
    echo "Submit button is not set";
}
?>