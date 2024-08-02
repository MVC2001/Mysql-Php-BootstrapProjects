<?php
session_start();
include("./connection/include.php");

// Check if user is not logged in or not a normal user, then redirect to the login page
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'administrator') {
    header('Location: index.php');
    exit; // Ensure script execution stops after redirection
}

// Check if request method is POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $quiz_id = intval($_POST['quiz_id']);
    $your_answer = $connect->real_escape_string($_POST['your_answer']);
    $is_correct = $connect->real_escape_string($_POST['is_correct']);

    // Update the answer in the database
    $stmt = $connect->prepare("UPDATE quiz SET your_answer = ?, is_correct = ? WHERE id = ?");
    if ($stmt === false) {
        die("Error preparing statement: " . $connect->error);
    }
    $stmt->bind_param("ssi", $your_answer, $is_correct, $quiz_id);
    if (!$stmt->execute()) {
        die("Error executing statement: " . $stmt->error);
    }
    $stmt->close();

    echo "Answer submitted successfully!";
}

$connect->close();
?>
