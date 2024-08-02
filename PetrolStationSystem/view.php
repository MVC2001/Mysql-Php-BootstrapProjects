<?php
// Database connection
$conn = mysqli_connect("localhost", "username", "password", "database_name");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM orders";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>View Orders</title>
</head>
<body>
    <div class="container">
        <h2>Orders</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Customer Name</th>
                    <th>Location</th>
                    <th>Category</th>
                    <th>Volume</th>
                    <th>Price</th>
                    <th>Payment Method</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?php echo $row['customername']; ?></td>
                        <td><?php echo $row['location']; ?></td>
                        <td><?php echo $row['category']; ?></td>
                        <td><?php echo $row['volume']; ?></td>
                        <td><?php echo $row['price']; ?></td>
                        <td><?php echo $row['paymentmethod']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
