<?php
session_start();
include("./connection/include.php");


if (!isset($_SESSION['user_id'])) {
    header('location:index.php');
    exit; // Ensure script execution stops after redirection
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize form inputs (not implemented in this example)

    $fullName = $_POST['fullName'];
    $indexNo = $_POST['indexNo'];

    // Fetch sleep file name from resultsleep_tbl
    $query = mysqli_query($connect, "SELECT resultsleep_tbl.id,resultsleep_tbl.sleep_file,resultsleep_tbl.approved,resultsleep_tbl.fullName,resultsleep_tbl.status,resultsleep_tbl.indexNo,resultsleep_tbl.created_at, users.fullName FROM resultsleep_tbl JOIN users ON resultsleep_tbl.fullName = users.fullName WHERE user_id=$_SESSION[user_id] AND approved ='approved'");
    $result = mysqli_fetch_assoc($query);
    $sleepFileName = $result['sleep_file'];

    // Download sleep file
    $file = './uploads/' . $sleepFileName;
    if (file_exists($file)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($file) . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file));
        readfile($file);
        exit;
    } else {
        echo "Sleep file not found.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta tags, title, stylesheet links -->
</head>

<body>
    <!-- Header, navigation, etc. -->

    <!-- Form for downloading sleep file -->
    <form method="POST" action="">
        <input type="text" name="fullName" placeholder="Full Name" required>
        <input type="text" name="indexNo" placeholder="Index No" required>
        <button type="submit">Download Sleep File</button>
    </form>

    <!-- Footer, scripts, etc. -->
</body>

</html>
