<?php
include("./connection/include.php");

// Check if the 'v_id' key is set in $_GET and is not empty
if (isset($_GET['v_id']) && !empty($_GET['v_id'])) {
    $v_id = $_GET['v_id'];

    // Sanitize the input (assuming it's an integer)
    $v_id = intval($v_id);

    // Prepare and execute the SQL query
    $sql = "SELECT v_upload FROM video_tb WHERE v_id=$v_id";
    $result = $connect->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();

        $videoPath = $row['v_upload'];
        $videoType = mime_content_type($videoPath);

        // Set the appropriate header for video streaming
        header("Content-type: $videoType");
        header('Content-Disposition: inline;');
        header('Content-Transfer-Encoding: binary');
        header('Accept-Ranges: bytes');

        // Stream the video file
        readfile($videoPath);
    } else {
        echo "Video not found";
    }

    // Close the database connection
    $connect->close();
} else {
    echo "Invalid or missing 'v_id' parameter";
}
