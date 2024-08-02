<?php
session_start();
include("./connection/include.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Prepare SQL statement
    $stmt = $connect->prepare("DELETE FROM books WHERE id = ?");
    $stmt->bind_param("i", $id);

    // Execute the statement
    if ($stmt->execute()) {
        // Redirect back to the books page after successful deletion
        header("Location: allBooks.php");
        exit();
    } else {
        echo "Error deleting book: " . $stmt->error;
    }

    // Close statement
    $stmt->close();
}

// Close connection
$connect->close();
?>
