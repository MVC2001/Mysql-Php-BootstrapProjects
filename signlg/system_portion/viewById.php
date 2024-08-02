<?php
include("./connection/include.php");

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    $id = $_GET["id"];

    $sql = "SELECT * FROM video_tb WHERE v_id = $id";
    $result = $connect->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo "ID: " . $row["v_id"] . " - Description: " . $row["description"] . "<br>";
        echo '<video width="320" height="240" controls>';
        echo '<source src="' . $row["v_upload"] . '" type="video/mp4">';
        echo 'Your browser does not support the video tag.';
        echo '</video>';
    } else {
        echo "Video not found";
    }
} else {
    echo "Invalid request";
}

$connect->close();
?>
