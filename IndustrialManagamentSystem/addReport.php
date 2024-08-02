<?php
session_start();
include("./connection/include.php");

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('location:Error404.php');
    exit; // Ensure script execution stops after redirection
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input data
    $fullName = mysqli_real_escape_string($connect, $_POST['fullName']);
    $trainer = mysqli_real_escape_string($connect, $_POST['trainer']);
    $reportDate = mysqli_real_escape_string($connect, $_POST['report_date']);
    $activities = $_POST['activity'];
    $comment = mysqli_real_escape_string($connect, $_POST['comment']);

    // Insert data into database
    $sql = "INSERT INTO fieldReport (fullName, trainer, report_date, activities, comment) VALUES ('$fullName', '$trainer', '$reportDate', '$activities', '$comment')";
    if (mysqli_query($connect, $sql)) {
        // Report added successfully
        header('location:dashboard.php'); // Redirect to dashboard or another page
        exit;
    } else {
        // Error occurred while adding report
        echo "Error: " . $sql . "<br>" . mysqli_error($connect);
    }
}
?>
