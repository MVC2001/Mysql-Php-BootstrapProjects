<?php
if(isset($_POST['submit'])) {
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

    $sql = "INSERT INTO orders (customername, location, category, volume, price, paymentmethod) VALUES ('$customername', '$location', '$category', '$volume', '$price', '$paymentmethod')";
    
    if (mysqli_query($conn, $sql)) {
        echo "Order placed successfully";
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Place Order</title>
</head>
<body>
    <div class="container">
        <h2>Place Order</h2>
        <form method="post">
            <div class="form-group">
                <label for="customername">Customer Name:</label>
                <input type="text" class="form-control" id="customername" name="customername" required>
            </div>
            <div class="form-group">
                <label for="location">Location:</label>
                <input type="text" class="form-control" id="location" name="location" required>
            </div>
            <div class="form-group">
                <label for="category">Category:</label>
                <input type="text" class="form-control" id="category" name="category" required>
            </div>
            <div class="form-group">
                <label for="volume">Volume:</label>
                <input type="text" class="form-control" id="volume" name="volume" required>
            </div>
            <div class="form-group">
                <label for="price">Price:</label>
                <input type="text" class="form-control" id="price" name="price" required>
            </div>
            <div class="form-group">
                <label for="paymentmethod">Payment Method:</label>
                <input type="text" class="form-control" id="paymentmethod" name="paymentmethod" required>
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Place Order</button>
        </form>
    </div>
</body>
</html>
