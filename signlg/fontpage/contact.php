<?php
session_start();
include './connection/include.php';

if (isset($_POST["post_data"])) {
    $name = mysqli_real_escape_string($connect, $_POST['name']);
    $email = mysqli_real_escape_string($connect, $_POST['email']);
    $message = mysqli_real_escape_string($connect, $_POST['message']);

    $insert_new_contact = "INSERT INTO contact (name, email, message) VALUES (?, ?, ?)";

    // Prepare and bind the statement
    $stmt = mysqli_prepare($connect, $insert_new_contact);
    mysqli_stmt_bind_param($stmt, "sss", $name, $email, $message);

    // Execute the statement
    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['message'] = "<div class='alert alert-success d-flex align-items-center' role='alert'>User added successfully. <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
    } else {
        $_SESSION['message'] = "<div class='alert alert-danger' role='alert'>Error: " . mysqli_error($connect) . "</div>";
    }

    // Close statement
    mysqli_stmt_close($stmt);
}

// Redirect back to the HTML page
header("Location:../index.php");
exit();
