<?php
session_start();
include("./connection/include.php");

// Process form data
$fullName = $_POST['fullName'];
$indexNo = $_POST['indexNo'];
$yearOfStudy = $_POST['yearOfStudy'];
$description = $_POST['description'];
$pdfName = $_FILES['file_upload']['name'];
$pdfTmpName = $_FILES['file_upload']['tmp_name'];

// Move uploaded file to uploads directory
$uploadDir = 'uploads/';
$uploadFile = $uploadDir . basename($pdfName);
move_uploaded_file($pdfTmpName, $uploadFile);

// Insert data into database
$sql = "INSERT INTO clearance_forms (fullName, indexNo, yearOfStudy, description, file_upload) 
        VALUES ('$fullName', '$indexNo', '$yearOfStudy', '$description', '$pdfName')";

if ($connect->query($sql) === TRUE) {
    $_SESSION['success'] = "New clearance form uploaded successfully";
    header("Location: clearanceForms.php");
    exit();
} else {
    $_SESSION['error'] = "Error: " . $sql . "<br>" . $connect->error;
    header("Location: addClearanceForm.php");
    exit();
}

$connect->close();
?>
