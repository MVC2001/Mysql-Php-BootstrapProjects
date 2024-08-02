<?php
include("./connection/include.php");

// Enable error reporting for debugging purposes
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["videoFile"])) {
    $description = $connect->real_escape_string($_POST['description']);

    $file_name = $_FILES["videoFile"]["name"];
    $file_tmp = $_FILES["videoFile"]["tmp_name"];
    $file_type = $_FILES["videoFile"]["type"];
    $file_size = $_FILES["videoFile"]["size"];

    // Allowed video formats
    $allowed_types = array('video/mp4', 'video/mpeg', 'video/webm');
    if (!in_array($file_type, $allowed_types)) {
        echo "Only MP4, MPEG, and WebM video formats are allowed.";
        exit();
    }

    // Check file size (limit to 5GB)
    $max_size = 5 * 1024 * 1024 * 1024; // 5GB in bytes
    if ($file_size > $max_size) {
        echo "The video file is too large. Maximum allowed size is 5GB.";
        exit();
    }

    // Upload the video file
    $upload_dir = "uploads/";
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }
    $target_file = $upload_dir . basename($file_name);

    if (move_uploaded_file($file_tmp, $target_file)) {
        // Insert video details into the database
        $sql = "INSERT INTO video_tbl (v_upload, description) VALUES ('$target_file', '$description')";
        if ($connect->query($sql) === TRUE) {
            // Redirect to viewVideo.php
            header('Location: viewVideo.php');
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $connect->error;
        }
    } else {
        echo "Failed to upload video.";
    }
} else {
    echo "No video file uploaded.";
}

$connect->close();
?>
