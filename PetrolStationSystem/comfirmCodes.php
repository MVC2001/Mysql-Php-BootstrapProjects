
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
    $comfirmation = $_POST['comfirmation'];
    
            
    // Update query
    $update_query ="UPDATE `orders` SET  comfirmation='$comfirmation' WHERE id=$id";
    
    if(mysqli_query($connect, $update_query)) {
        $_SESSION['success_message'] = "Order  updated  successfully!";
    } else {
        $_SESSION['error_message'] = "Failed to update order!";
    }

    header('Location: comfimedOnes.php');
    exit;
}
?>

