<?php
include("./connection/include.php");

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    $id = $_GET["id"];

    $sql = "SELECT v_upload FROM video_tb WHERE v_id = $id";
    $result = $connect->query($sql);

    if ($result->num_rows > 0) {
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
} else {
    echo "Invalid request";
}

$connect->close();
?>
