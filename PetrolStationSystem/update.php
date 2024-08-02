<?php
if(isset($_POST['submit'])) {
    $id = $_POST['id'];
    $point = $_POST['point'];
    $service = $_POST['service'];
    $weblink = $_POST['weblink'];
    $contact = $_POST['contact'];
    $location = $_POST['location'];

    // Database connection
    $conn = mysqli_connect("localhost", "username", "password", "database_name");

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "UPDATE petrol_station SET point='$point', service='$service', weblink='$weblink', contact='$contact', location='$location' WHERE id=$id";
    
    if (mysqli_query($conn, $sql)) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}

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
    <title>Update Petrol Station</title>
</head>
<body>
    <h2>Update Petrol Station</h2>
    <form method="post">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <div>
            <label for="point">Point:</label>
            <input type="text" id="point" name="point" value="<?php echo $row['point']; ?>" required>
        </div>
        <div>
            <label for="service">Service:</label>
            <input type="text" id="service" name="service" value="<?php echo $row['service']; ?>" required>
        </div>
        <div>
            <label for="weblink">Weblink:</label>
            <input type="text" id="weblink" name="weblink" value="<?php echo $row['weblink']; ?>" required>
        </div>
        <div>
            <label for="contact">Contact:</label>
            <input type="text" id="contact" name="contact" value="<?php echo $row['contact']; ?>" required>
        </div>
        <div>
            <label for="location">Location:</label>
            <input type="text" id="location" name="location" value="<?php echo $row['location']; ?>" required>
        </div>
        <button type="submit" name="submit">Update</button>
    </form>
</body>
</html>
