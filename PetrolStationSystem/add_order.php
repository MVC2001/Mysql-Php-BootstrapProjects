<?php
session_start();
include("./connection/include.php");

function insertOrder($connect, $station_point, $client, $phoneNo, $location, $category, $volume) {
    // Use prepared statements to prevent SQL injection
    $insertQuery = mysqli_prepare($connect, "INSERT INTO `orders` (`station_point`, `client`, `phoneNo`, `location`, `category`, `volume`) VALUES (?, ?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($insertQuery, "ssssss", $station_point, $client, $phoneNo, $location, $category, $volume);
    
    if (mysqli_stmt_execute($insertQuery)) {
        return "Order placed successfully.";
    } else {
        return "Failed to place order: " . mysqli_error($connect);
    }
}

if (isset($_POST['place-order'])) {
    $station_point = $_POST['station_point'];
    $client = $_POST['client'];
    $phoneNo = $_POST['phoneNo'];
    $location = $_POST['location'];
    $category = $_POST['category'];
    $volume = $_POST['volume'];

    $result = insertOrder($connect, $station_point, $client, $phoneNo, $location, $category, $volume);
    if (strpos($result, 'successfully') !== false) {
        $_SESSION['success_message'] = $result;
    } else {
        $_SESSION['error_message'] = $result;
    }
    header("Location: successfullPage.php");
    exit();
}
?>
