<?php
session_start();
include("./connection/include.php");


$id = $_GET['id'];

$sql = "DELETE FROM video_tb WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    echo "Record deleted successfully";
} else {
    echo "Error deleting record: " . $conn->error;
}

$conn->close();
?>
