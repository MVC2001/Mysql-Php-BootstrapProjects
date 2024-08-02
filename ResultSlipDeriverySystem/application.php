<?php
session_start();
include("./connection/include.php");


// Process form data
$fullName = $_POST['fullName'];
$indexNo = $_POST['indexNo'];
$school = $_POST['school'];
$wented_at = $_POST['wented_at'];
$pdfName = $_FILES['file_upload']['name'];
$pdfTmpName = $_FILES['file_upload']['tmp_name'];

// Move uploaded file to uploads directory
$uploadDir = 'uploads/';
$uploadFile = $uploadDir . basename($pdfName);
move_uploaded_file($pdfTmpName, $uploadFile);

// Insert data into database
$sql = "INSERT INTO request_tbl (`fullName`,`indexNo`,`school`,`wented_at`,`file_upload`) 
        VALUES ('$fullName', '$indexNo', '$school', '$wented_at', '$pdfName')";

if ($connect->query($sql) === TRUE) {
    $_SESSION['success'] = "Your are successfully apply for result slip";
  header("Location: yourSleep.php");
    exit();
} else {
    $_SESSION['error'] = "Error: " . $sql . "<br>" . $connect->error;
    header("Location: application.php");
    exit();
}

$connect->close();


?>