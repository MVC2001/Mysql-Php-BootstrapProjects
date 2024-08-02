<?php
session_start();
include("./connection/include.php");

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('location:index.php');
    exit; // Ensure script execution stops after redirection
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if ID is provided
    if (isset($_POST['id'])) {
        // Sanitize input to prevent SQL injection
        $id = mysqli_real_escape_string($connect, $_POST['id']);
        $fullName = mysqli_real_escape_string($connect, $_POST['fullName']);
        $indexNo = mysqli_real_escape_string($connect, $_POST['indexNo']);
        $sleep_file = mysqli_real_escape_string($connect, $_POST['sleep_file']);
        $status = mysqli_real_escape_string($connect, $_POST['status']);
        $approved = mysqli_real_escape_string($connect, $_POST['approved']);

        // Check if student is already approved
        $check_query = "SELECT approved FROM resultsleep_tbl WHERE id = $id";
        $check_result = mysqli_query($connect, $check_query);
        $row = mysqli_fetch_assoc($check_result);
        if ($row['approved'] === 'approved') {
            echo "<script>alert('Student already approved.');</script>";
        } else {
            // Update the request details in the database
            $query = "UPDATE `resultsleep_tbl` SET fullName='$fullName', indexNo='$indexNo', sleep_file='$sleep_file', status='$status', approved='$approved' WHERE id=$id";

            if (mysqli_query($connect, $query)) {
                // Redirect to the page where the request details are displayed
                header("Location: viewSleep.php?id=$id");
                exit();
            } else {
                echo "Error updating record: " . mysqli_error($connect);
            }
        }
    } else {
        echo "ID not provided.";
    }
} else {
    echo "Invalid request method.";
}
?>
