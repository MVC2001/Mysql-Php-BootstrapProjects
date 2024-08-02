<?php
if(isset($_POST['submit'])) {
    $point = $_POST['point'];
    $image = $_FILES['image']['name'];
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

    // File upload
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);

    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        echo "The file ". htmlspecialchars( basename( $_FILES["image"]["name"])). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }

    $sql = "INSERT INTO petrol_station (point, image, service, weblink, contact, location) VALUES ('$point', '$image', '$service', '$weblink', '$contact', '$location')";
    
    if (mysqli_query($conn, $sql)) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Petrol Station</title>
</head>
<body>
    <h2>Add Petrol Station</h2>
    <form method="post" enctype="multipart/form-data">
        <div>
            <label for="point">Point:</label>
            <input type="text" id="point" name="point" required>
        </div>
        <div>
            <label for="image">Image:</label>
            <input type="file" id="image" name="image" required>
        </div>
        <div>
            <label for="service">Service:</label>
            <input type="text" id="service" name="service" required>
        </div>
        <div>
            <label for="weblink">Weblink:</label>
            <input type="text" id="weblink" name="weblink" required>
        </div>
        <div>
            <label for="contact">Contact:</label>
            <input type="text" id="contact" name="contact" required>
        </div>
        <div>
            <label for="location">Location:</label>
            <input type="text" id="location" name="location" required>
        </div>
        <button type="submit" name="submit">Submit</button>
    </form>
</body>
</html>
