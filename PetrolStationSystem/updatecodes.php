
<?php
session_start();
include("./connection/include.php");

// Check if user is logged in and has the necessary permissions
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'station_manager') {
    header('location:login.php');
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id']; 
    $service = $_POST['service'];
    $weblink = $_POST['weblink'];
    $contact = $_POST['contact'];
    $location = $_POST['location'];
    $diesel = $_POST['diesel'];
    $petrol = $_POST['petrol'];
    $kerosene = $_POST['kerosene'];
    

                        
    // Update query
    $update_query ="UPDATE `petrol_station` SET  service='$service',weblink='$weblink',contact='$contact',location='$location',diesel='$diesel',petrol='$petrol',kerosene='$kerosene' WHERE id=$id";
    
    
    if(mysqli_query($connect, $update_query)) {
        $_SESSION['success_message'] = "Station point updated  successfully!";
    } else {
        $_SESSION['error_message'] = "Failed to update station point!";
    }

    header('Location: stations.php');
    exit;
}
?>

