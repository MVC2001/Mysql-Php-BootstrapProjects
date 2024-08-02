<?php
session_start();
include("./connection/include.php");



if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'head_of_school') {
    header('location:index.php');
    exit; // Ensure script execution stops after redirection
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize form inputs (not implemented in this example)

    $fullName = $_POST['fullName'];
    $indexNo = $_POST['indexNo'];

    // Delete data from resultsleep_tbl
    $deleteQuery = mysqli_query($connect, "DELETE FROM `clearance_forms` WHERE `fullName` = '$fullName' AND `indexNo` = '$indexNo'");

    if ($deleteQuery) {
        header('Location: allclearanceForms.php');
        exit();
    } else {
        echo "Error deleting sleep record.";
    }
}
?>


