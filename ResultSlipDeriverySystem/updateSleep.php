<?php
session_start();
include("./connection/include.php");


if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('location:index.php');
    exit; // Ensure script execution stops after redirection
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize form inputs (not implemented in this example)

    $fullName = $_POST['fullName'];
    $indexNo = $_POST['indexNo'];
    $status = $_POST['status'];

    // Update data in resultsleep_tbl
    $updateQuery = mysqli_query($connect, "UPDATE `resultsleep_tbl` SET `status` = '$status' WHERE `fullName` = '$fullName' AND `indexNo` = '$indexNo'");

    if ($updateQuery) {
        header('Location: viewSleep.php');
        exit();
    } else {
        echo "Error updating sleep record.";
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

    <!-- Form for updating sleep record -->
    <form method="POST" action="">
        <input type="text" name="fullName" placeholder="Full Name" required>
        <input type="text" name="indexNo" placeholder="Index No" required>
        <select name="status" required>
            <option value="active">Active</option>
            <option value="inactive">Inactive</option>
        </select>
        <button type="submit">Update Sleep Record</button>
    </form>

    <!-- Footer, scripts, etc. -->
</body>

</html>
