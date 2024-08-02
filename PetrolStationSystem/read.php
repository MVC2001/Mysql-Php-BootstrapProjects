<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: login.php");
    exit;
}

// Database connection
$conn = mysqli_connect("localhost", "username", "password", "database_name");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM petrol_station";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Read Petrol Stations</title>
</head>
<body>
    <h2>Petrol Stations</h2>
    <table border="1">
        <tr>
            <th>Point</th>
            <th>Service</th>
            <th>Weblink</th>
            <th>Contact</th>
            <th>Location</th>
            <th>Action</th>
        </tr>
        <?php while($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?php echo $row['point']; ?></td>
                <td><?php echo $row['service']; ?></td>
                <td><?php echo $row['weblink']; ?></td>
                <td><?php echo $row['contact']; ?></td>
                <td><?php echo $row['location']; ?></td>
                <td>
                    <a href="update.php?id=<?php echo $row['id']; ?>">Update</a>
                    <a href="delete.php?id=<?php echo $row['id']; ?>">Delete</a>
                </td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>
