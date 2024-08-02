<?php
session_start();
include("./connection/include.php");

// Check if user is not logged in or not a student, then redirect to login page
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'student') {
    header('location:Error404.php');
    exit; // Ensure script execution stops after redirection
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Use prepared statements to prevent SQL injection
    $stmt = $connect->prepare("INSERT INTO weeklyreport (day, fullName, trainer, supervisor, activity, hourswork) 
                               VALUES (?, ?, ?, ?, ?, ?)");

    if ($stmt) {
        // Bind parameters to the prepared statement
        $stmt->bind_param('ssssss', $day, $fullName, $trainer, $supervisor, $activity, $hourswork);

        // Fetch data from POST request and assign to variables
        $day = htmlspecialchars($_POST['day'], ENT_QUOTES, 'UTF-8');
        $fullName = htmlspecialchars($_POST['fullName'], ENT_QUOTES, 'UTF-8');
        $trainer = htmlspecialchars($_POST['trainer'], ENT_QUOTES, 'UTF-8');
        $supervisor = htmlspecialchars($_POST['supervisor'], ENT_QUOTES, 'UTF-8');
        $activity = htmlspecialchars($_POST['activity'], ENT_QUOTES, 'UTF-8');
        $hourswork = htmlspecialchars($_POST['hourswork'], ENT_QUOTES, 'UTF-8');

        // Execute the prepared statement
        if ($stmt->execute()) {
            echo "Reports successfully inserted.";
            header("Location: weeklyReport.php");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the prepared statement
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $connect->error;
    }
}

// Close the database connection
$connect->close();
?>
