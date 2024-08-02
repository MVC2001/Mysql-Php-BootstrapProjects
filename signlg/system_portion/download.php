<?php
session_start();
include("./connection/include.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch file details from database
    $sql = "SELECT * FROM books WHERE id = $id";
    $result = $connect->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $file_path = $row['up_file'];  // Assuming 'up_file' contains the file name

        // Directory where your files are stored (adjust as per your server setup)
        $file_directory = './books/';

        // Full path to the file
        $file = $file_directory . $file_path;

        if (file_exists($file)) {
            // Set headers
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . basename($file) . '"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file));

            // Read the file and output it
            readfile($file);
            exit;
        } else {
            die('File not found');
        }
    } else {
        die('Invalid ID');
    }
} else {
    die('ID not specified');
}
?>
