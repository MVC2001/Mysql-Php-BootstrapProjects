<?php
if(isset($_POST['submit'])) {
    $id = $_POST['id'];
    $customername = $_POST['customername'];
    $location = $_POST['location'];
    $category = $_POST['category'];
    $volume = $_POST['volume'];
    $price = $_POST['price'];
    $paymentmethod = $_POST['paymentmethod'];

    // Database connection
    $conn = mysqli_connect("localhost", "username", "password", "database_name");

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "UPDATE orders SET customername='$customername', location='$location', category='$category', volume='$volume', price='$price', paymentmethod='$paymentmethod' WHERE id=$id";
    
    if (mysqli_query($conn, $sql)) {
        echo "Order updated successfully";
    } else {
        echo "Error updating order: " . mysqli_error($conn);
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

$sql = "SELECT * FROM orders WHERE id=$id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Update Order</title>
</head>
<body>
    <div class="container">
        <h2>Update Order</h2>
        <form method="post">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <div class="form-group">
                <label for="customername">Customer Name:</label>
                <input type="text" class="form-control" id="customername" name="customername" value="<?php echo $row['customername']; ?>" required>
            </div>
            <div class="form-group">
                <label for="location">Location:</label>
                <input type="text" class="form-control" id="location" name="location" value="<?php echo $row['location']; ?>" required>
            </div>
            <div class="form-group">
                <label for="category">Category:</label>
                <input type="text" class="form-control" id="category" name="category" value="<?php echo $row['category']; ?>" required>
            </div>
            <div class="form-group">
                <label for="volume">Volume:</label>
                <input type="text" class="form-control" id="volume" name="volume" value="<?php echo $row['volume']; ?>" required>
            </div>
            <div class="form-group">
                <label for="price">Price:</label>
                <input type="text" class="form-control" id="price" name="price" value="<?php echo $row['price']; ?>" required>
            </div>
            <div class="form-group">
                <label for="paymentmethod">Payment Method:</label>
                <input type="text" class="form-control" id="paymentmethod" name="paymentmethod" value="<?php echo $row['paymentmethod']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Update Order</button>
        </form>
    </div>
</body>
</html>
