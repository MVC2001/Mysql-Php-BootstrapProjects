<?php
session_start();
include("./connection/include.php");

// Function to sanitize filenames
function sanitize_filename($filename) {
    return preg_replace("/[^a-zA-Z0-9\_\-\.]/", '', $filename);
}

// Check if ID parameter exists
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch file details from database
    $sql = "SELECT * FROM books WHERE id = $id";
    $result = $connect->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $filename = $row['up_file'];
        $file_path = './books/' . sanitize_filename($filename); // Adjust the path to your books directory

        // Check if file exists
        if (file_exists($file_path)) {
            // Determine MIME type
            $mime_type = mime_content_type($file_path);
            $finfo = finfo_open(FILEINFO_MIME_TYPE);

            // Set headers to force download
            header("Cache-Control: public");
            header("Content-Description: File Transfer");
            header("Content-Disposition: attachment; filename=" . basename($file_path));
            header("Content-Type: " . $mime_type);
            header("Content-Length: " . filesize($file_path));

            // Read the file to output
            readfile($file_path);
            exit;
        } else {
            die('Error: The file does not exist.');
        }
    } else {
        die('Error: Book not found.');
    }
} else {
    die('Error: Invalid request.');
}
?>
