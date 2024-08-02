<?php
// viewDocument.php

if (isset($_GET['file'])) {
    $filename = $_GET['file'];
    $filepath = 'uploads/' . $filename;

    // Validate file existence
    if (file_exists($filepath)) {
        // Set appropriate header for PDF
        header('Content-Type: application/pdf');
        readfile($filepath);
        exit;
    } else {
        // File not found
        die('File not found.');
    }
} else {
    // Invalid request
    die('Invalid request.');
}
?>
