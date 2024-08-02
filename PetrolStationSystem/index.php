<?php
session_start();
include './connection/include.php';

// Search logic
$search_query = "";
if (isset($_GET['search'])) {
    $search_query = htmlspecialchars($_GET['search']);
    // Prepare search query to prevent SQL injection
    $search_query = mysqli_real_escape_string($connect, $search_query);
    // Add search conditions to the SQL query
    $select_all_users = "SELECT * FROM `petrol_station` WHERE `station_point` LIKE '%$search_query%' OR `service` LIKE '%$search_query%' ORDER BY id DESC";
} else {
    // Default query without search
    $select_all_users = "SELECT * FROM `petrol_station` ORDER BY id DESC";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.3/dist/css/bootstrap.min.css">
     <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <title>Station points</title>
</head>
<body>
    <div class="container py-5">
        <!-- Search Form -->
        <div class="row mb-3">
            <div class="col">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6"><p style="color:#0A2D54;font-size: 17px;font-weight: bold;font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif ;"> <i class="fas fa-envelope"></i>nyemamudhihir@gmail.com</p></div>
                        <div class="col-md-6"><a href="./login.php"><button class="btn btn-success" style="margin-left: 380px;background-color: #0A2D54;width:100px"><i class="fas fa-user"></i>LOGIN</button></a></div>
                    </div>
                </div>
                <br>
                <div class="card shadow-sm">
                    <div class="card-body">
                        <form method="GET">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search..." name="search" value="<?php echo $search_query; ?>">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="submit">Search</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    
        <!-- Display Cards -->
        <div class="row">
            <?php 
            $result = mysqli_query($connect, $select_all_users);
            if ($result && mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) { ?>
                    <div class="col-md-4 mb-4">
                        <div class="card text-center shadow">
                            <div class="card-header" style="background-color: #0A2D54;color: white;"><?php echo htmlspecialchars($row['station_point']); ?></div>
                            <div class="card-body">
                                <?php if(!empty($row['image'])) { ?>
                                    <img src="uploads/<?php echo htmlspecialchars($row['image']); ?>" class="img-fluid mb-3" alt="<?php echo htmlspecialchars($row['station_point']); ?>" style="height:250px;width:300px">
                                <?php } ?>
                                <p class="mb-2">Weblink: <a href="<?php echo htmlspecialchars($row['weblink']); ?>">Link</a></p>
                                <p class="mb-2" style="color:#0A2D54">Location: <?php echo htmlspecialchars($row['location']); ?></p>
                                <p class="mb-2" style="color:#0A2D54">Contact: <?php echo htmlspecialchars($row['contact']); ?></p>
                                <p class="mb-2" style="color:#0A2D54">Services: <?php echo htmlspecialchars($row['service']); ?></p>
                                <hr>
                                <p class="mb-2" style="color:#0A2D54">Petrol: <?php echo htmlspecialchars($row['petrol']); ?></p>
                                <p class="mb-2" style="color:#0A2D54">Diesel: <?php echo htmlspecialchars($row['diesel']); ?></p>
                                <p class="mb-2"style="color:#0A2D54">Kerosene: <?php echo htmlspecialchars($row['kerosene']); ?></p>
                                <button class=" text-white btn-block btn-" style="background-color: #0A2D54;"><a href="palceOrderPage.php?id=<?php echo $row['id'] ?>"><i class="fas fa-shopping-cart"></i></a>Order Now</button>
                            </div>
                        </div>
                    </div>
                <?php } 
            } else {
                echo "<div class='col'><p>No results found.</p></div>";
            }
            ?>
        </div>
    </div>
</body>
</html>
