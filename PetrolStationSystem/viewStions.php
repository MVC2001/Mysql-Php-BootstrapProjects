<?php
session_start();
include("./connection/include.php");

// Check if user is not logged in or not an admin, then redirect to login page
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('location:Error404.php');
    exit; // Ensure script execution stops after redirection
}

//delete logic 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if id is set and not empty
    if (isset($_POST['id']) && !empty($_POST['id'])) {
        $id = $_POST['id'];
        
        // Delete the user from the database
        $deleteQuery = mysqli_query($connect, "DELETE FROM `petrol_station` WHERE `id` = $id");
        
        if ($deleteQuery) {
            // User deleted successfully
            header('Location: stations.php'); // Redirect to users page
            exit();
        } else {
            // Error deleting user
            echo "Error deleting station.";
        }
    } else {
        // user_id not set or empty
        echo "Invalid station ID.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        table{
    width:100%;
}
#example_filter{
    float:right;
}
#example_paginate{
    float:right;
}
label {
    display: inline-flex;
    margin-bottom: .5rem;
    margin-top: .5rem;
   
}
        .sidebar {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            background-color: #0A2D54;
            color: white;
            padding: 20px;
            width: 250px;
            transition: all 0.3s ease;
            overflow-y: auto;
        }
        .sidebar ul {
            list-style-type: none;
            padding: 0;
        }
        .sidebar ul li {
            margin-bottom: 10px;
        }
        .main-content {
            margin-left: 250px;
            padding: 20px;
        }
        @media (max-width: 768px) {
            .sidebar {
                width: 0;
                overflow: hidden;
            }
            .main-content {
                margin-left: 0;
            }
        }
    </style>
    <title>Seller</title>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Admin Dashboard</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent" style="box-shadow: rgba(9, 30, 66, 0.25) 0px 1px 1px, rgba(9, 30, 66, 0.13) 0px 0px 1px 1px;">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">
                    <?php   $query = mysqli_query($connect, "SELECT * FROM `users` WHERE `user_id`='$_SESSION[user_id]'") or die(mysqli_connect_error());
                                   $fetch = mysqli_fetch_array($query);
                                  echo "" . $fetch['email'] . " "; ?>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="./resertPassword.php">Account Settings</a>
                      <a class="dropdown-item" href="login.php">Logout</a>
                </div>
            </li>
           
        </ul>
    </div>
</nav>

<div class="sidebar" style="box-shadow: rgba(0, 0, 0, 0.16) 0px 3px 6px, rgba(0, 0, 0, 0.23) 0px 3px 6px;">
    <ul class="text-center" style="margin-top: 80px;"><br>
        <a href="./dashboard.php"><div class="card text-success" style="box-shadow: rgba(0, 0, 0, 0.16) 0px 3px 6px, rgba(0, 0, 0, 0.23) 0px 3px 6px;"><h4>DASHBOARD</h4></div></a>
    </ul>
</div>

<div class="main-content text-center shadow-sm" style="margin-top: 20px">
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card">
                <div class="card-body">
                   	<table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
            <th>No#</th>
                <th>StationName</th>
                <th>Service</th>
                <th>Loaction/Place</th>
                 <th>Diesel</th>
                  <th>Petrol</th>
                   <th>Kerosene</th>
                 <th>Image</th>
                 <th>Created_at</th>
            </tr>
        </thead>
        <tbody>
        
                           <?php 
                 $count=1;
                 $select_all_users = "SELECT * FROM petrol_station  ORDER BY id DESC";
                 $result = mysqli_query($connect,$select_all_users);
                 $number = mysqli_num_rows($result);
                 if ($number > 0) {
                     while($row = mysqli_fetch_assoc($result)) { ?>
                            <tr>
                            <td><?php echo $count ?></td>
                                <td><?php echo $row['station_point']; ?></td>
                                <td><?php echo $row['service']; ?></td>
                                <td><?php echo $row['location']; ?></td>
                                <td><?php echo $row['diesel']; ?></td>
                                <td><?php echo $row['petrol']; ?></td>
                                <td><?php echo $row['kerosene']; ?></td>
                                <td>
                                    <img src="uploads/<?php echo $row['image']; ?>" alt="<?php echo $row['image']; ?>" style="width: 100px;">
                                </td>
                                <td><?php echo $row['created_at']; ?></td>
                            </tr>
                            <?php $count++?>
                        <?php }} ?>
        </tbody>
       
    </table>
                </div>
            </div>
        </div>
       
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>




</body>
</html>
      