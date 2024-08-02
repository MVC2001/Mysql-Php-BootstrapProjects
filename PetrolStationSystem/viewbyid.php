<?php
$id = $_GET['id'];

// Database connection
$conn = mysqli_connect("localhost", "username", "password", "database_name");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM petrol_station WHERE id=$id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Petrol Station</title>
</head>
<body>
    <h2>Petrol Station Details</h2>
    <table>
        <tr>
            <td>Point:</td>
            <td><?php echo $row['point']; ?></td>
        </tr>
        <tr>
            <td>Service:</td>
            <td><?php echo $row['service']; ?></td>
        </tr>
        <tr>
            <td>Weblink:</td>
            <td><?php echo $row['weblink']; ?></td>
        </tr>
        <tr>
            <td>Contact:</td>
            <td><?php echo $row['contact']; ?></td>
        </tr>
        <tr>
            <td>Location:</td>
            <td><?php echo $row['location']; ?></td>
        </tr>
    </table>
</body>
</html>
