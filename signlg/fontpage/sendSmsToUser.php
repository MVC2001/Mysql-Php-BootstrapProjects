<?php
session_start();
include("./connection/include.php");

// Function to add SMS to receiversms table and redirect
function addSmsToUser($connect, $email, $message) {
    // Insert SMS details into database
    $insertQuery = "INSERT INTO receiversms (email, message) VALUES (?, ?)";
    $stmt = mysqli_prepare($connect, $insertQuery);
    
    // Check if preparing the statement was successful
    if ($stmt === false) {
        echo "Error preparing statement: " . mysqli_error($connect);
        return;
    }

    mysqli_stmt_bind_param($stmt, "ss", $email, $message);
    $result = mysqli_stmt_execute($stmt);

    // Check if execution was successful
    if ($result) {
        // Redirect to success.php after inserting SMS
        header("Location: success.php");
        exit; // Make sure to exit after redirecting
    } else {
        echo "Error inserting SMS: " . mysqli_error($connect);
        // Handle error case here
    }

    mysqli_stmt_close($stmt);
}

// Example usage:
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Validate and sanitize inputs (ensure proper validation/sanitization here)
    // For simplicity, assuming basic validation/sanitization is done

    // Add SMS to receiversms table and redirect
    addSmsToUser($connect, $email, $message);
}
?>
