<?php

header("Access-Control-Allow-Origin: http://localhost:58557");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json");

include './connection.php';

$fullName = mysqli_real_escape_string($connect, $_POST['fullName']);
$regNo = mysqli_real_escape_string($connect, $_POST['regNo']);
$yearOfStudy = mysqli_real_escape_string($connect, $_POST['yearOfStudy']);
$Course = mysqli_real_escape_string($connect, $_POST['Course']);
$Dept = mysqli_real_escape_string($connect, $_POST['Dept']);
$School = mysqli_real_escape_string($connect, $_POST['School']);
$days = mysqli_real_escape_string($connect, $_POST['days']);
$departingOn = mysqli_real_escape_string($connect, $_POST['departingOn']);
$returningOn = mysqli_real_escape_string($connect, $_POST['returningOn']);
$reasonFor = mysqli_real_escape_string($connect, $_POST['reasonFor']);
$phoneNumber = mysqli_real_escape_string($connect, $_POST['phoneNumber']);
$date = mysqli_real_escape_string($connect, $_POST['date']);

// Check if email already exists
$query_check_email = "SELECT * FROM permission_tbl WHERE regNo='$regNo'";
$result_check_email = mysqli_query($connect, $query_check_email);

if (mysqli_num_rows($result_check_email) > 0) {
    // regNo already exists
    echo json_encode(array("message" => "Permission already exists"));
} else {                                                       
    // Insert new permission
    $query = "INSERT INTO permission_tbl (fullName, regNo, yearOfStudy, Course, Dept, School, days, departingOn, returningOn, reasonFor, phoneNumber, date) VALUES ('$fullName', '$regNo', '$yearOfStudy', '$Course', '$Dept', '$School', '$days', '$departingOn', '$returningOn', '$reasonFor', '$phoneNumber', '$date')";
    $results = mysqli_query($connect, $query);
    if ($results > 0) {
        echo json_encode(array("message" => "Permission granted successfully"));
    } else {
        echo json_encode(array("message" => "Error granting permission"));
    }
}

?>
