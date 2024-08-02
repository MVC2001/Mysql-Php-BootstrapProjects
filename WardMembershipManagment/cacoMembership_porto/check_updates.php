<?php
include("./connection/include.php");
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'member') {
    header('location:Error404.php');
    exit;
}

$last_check = $_GET['last_check']; // Last time client checked for updates

// Query for announcements that were modified since last_check
$query = "SELECT * FROM announcement WHERE checksum != MD5(comment) AND created_at > '$last_check' ORDER BY announce_id DESC";
$result = mysqli_query($connect, $query);

$response = array();
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $response[] = $row;
    }
}

echo json_encode($response);
?>
