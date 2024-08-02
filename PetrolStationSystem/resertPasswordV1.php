<?php
include("./connection/include.php");
session_start(); 

// Check if user is not logged in or not an admin, then redirect to login page
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'station_manager') {
    header('location:Error404.php');
    exit; // Ensure script execution stops after redirection
}

if (isset($_POST['resert-function'])) {
    $email = $_POST['email'];
    $oldPassword = md5($_POST['old-password']);
    $newPassword = md5($_POST['new-password']);

    // Validate inputs (you can add more validation as needed)
    if (empty($email) || empty($oldPassword) || empty($newPassword)) {
        $errorMessage = "Please fill in all fields.";
    } else {
        // Check if the provided email and old password match an existing user
        $query = mysqli_query($connect, "SELECT * FROM `users` WHERE `email` = '$email' AND `password` = '$oldPassword'");
        $row = mysqli_fetch_assoc($query);

        if ($row) {
            // Update password with the new one
            $updateQuery = mysqli_query($connect, "UPDATE `users` SET `password` = '$newPassword' WHERE `email` = '$email'");
            if ($updateQuery) {
                $successMessage = "Password resert successfully.";
            } else {
                $errorMessage = "Failed to reset password. Please try again.";
            }
        } else {
            $errorMessage = "Invalid email or old password.";
        }
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
    <title>Update User</title>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#"></a>
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
                    <a class="dropdown-item" href="resertPasswordV1.php">Account Settings</a>
                      <a class="dropdown-item" href="login.php">Logout</a>
                </div>
            </li>
           
        </ul>
    </div>
</nav>

<div class="sidebar" style="box-shadow: rgba(0, 0, 0, 0.16) 0px 3px 6px, rgba(0, 0, 0, 0.23) 0px 3px 6px;">
    <ul class="text-center" style="margin-top: 80px;"><br>
        <a href="./station_manager.php"><div class="card text-success" style="box-shadow: rgba(0, 0, 0, 0.16) 0px 3px 6px, rgba(0, 0, 0, 0.23) 0px 3px 6px;"><h4>DASHBOARD</h4></div></a>
        <br><hr style="background-color:white">
        <li><a href="./orders.php"  style="color: white;font-size: 20px;font-family: sans-serif;font-weight:bold;">New-Order</a></li>
        <li><a href="./stations.php" style="color:white;font-size: 20px;font-family: sans-serif;font-weight:bold;">Your-Station</a></li>
        <li><a href="comfimedOnes.php"  style="color: white;font-size: 20px;font-family: sans-serif;font-weight:bold;">Comfirmed-Order</a></li>
    </ul>
</div>

<div class="main-content text-center shadow-sm" style="margin-top: 20px;background-color: white;">
<br>
<center><h4>RESER YOUR PASSWORD</h4></center>
   <?php if (isset($errorMessage)) { ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $errorMessage; ?>
                </div>
            <?php } ?>
            <?php if (isset($successMessage)) { ?>
                <div class="alert alert-success" role="alert">
                    <?php echo $successMessage; ?>
                </div>
            <?php } ?>

    <div class="m-4">
    <form action="" method="post">
    

         <div class="row py-2 align-items-center g-3">
         <div class="col-sm-6">
                <label class="visually-hidden" for="inputEmail">Email</label>
                <input type="email" name="email" class="form-control" id="inputEmail" placeholder="Enter email" required>
            </div>
            
               <div class="col-sm-6">
                <label class="visually-hidden" for="inputNewP">New-Password</label>
                <input type="password" name="new-password" class="form-control" id="inputold-password" placeholder="New current password" required>
            </div>
          
         </div>

          <div class="row py-2 align-items-center g-3">
           <div class="col-sm-12">
                <label class="visually-hidden" for="inputOldP">Current-Password</label>
                <input type="password" name="old-password" class="form-control" id="inputold-password" placeholder="Enter current password" required>
            </div>
        
         </div>


          <div class="row py-2 align-items-center g-3">
              <button type="submit" name="resert-function" class="btn btn-block" style="background-color:#0A2D54;width:230px;color:white;margin-left:10px">Update</button>
              </form>
              <span><a href="./station_manager.php"><button type="button" class="btn btn-block" style="background-color:#543B0A ;width:230px;color:white">Cancel</button></a></span>
          </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
