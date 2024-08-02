<?php
include './connection.php';

header("Access-Control-Allow-Origin: http://localhost:58557");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullName = mysqli_real_escape_string($connect, $_POST['fullName']);
    $email = mysqli_real_escape_string($connect, $_POST['email']);
    $password = mysqli_real_escape_string($connect, md5($_POST['password']));

    $query_check_email = "SELECT * FROM users WHERE email='$email'";
    $result_check_email = mysqli_query($connect, $query_check_email);

    if (mysqli_num_rows($result_check_email) > 0) {
        echo json_encode(array("message" => "Email already taken"));
    } else {
        $query = "INSERT INTO users (fullName, email, password) VALUES('$fullName', '$email', '$password')";
        $results = mysqli_query($connect, $query);
        if ($results) {
            echo json_encode(array("message" => "Student registered successfully"));
        } else {
            echo json_encode(array("message" => "Error registering student"));
        }
    }
} else {
    echo json_encode(array("message" => "Method not allowed"));
}
?>
