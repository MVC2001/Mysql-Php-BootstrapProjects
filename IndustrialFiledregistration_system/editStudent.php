<?php
include "connection.php";
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: index.php");
    exit();
}

if (isset($_POST['update'])) {
    $student_id = $_POST['student_id'];
    $name = $_POST['name'];
    $phoneNumber = $_POST['phoneNumber'];
    $program = $_POST['program'];
    $email = $_POST['email'];
    $course = $_POST['course'];
    $status = $_POST['status'];

    $query = "UPDATE students SET name='$name', phoneNumber='$phoneNumber', program='$program', email='$email', course='$course',status ='$status' WHERE student_id=$student_id";
    mysqli_query($conn, $query);

    header("Location: AdminDashboard.php");
    exit();
}

?>