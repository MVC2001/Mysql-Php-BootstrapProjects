<?php
include("./connection/include.php");
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('location:Error404.php');
    exit; // Ensure script execution stops after redirection
}

// Update user function with $user_id as parameter
function updateUser($connect, $user_id, $fullName, $role, $status, $station_point, $email) {
    // Update user in the database
    $updateQuery = mysqli_query($connect, "UPDATE `users` SET `fullName`='$fullName', `role`='$role', `status`='$status', `station_point`='$station_point', `email`='$email' WHERE `user_id`='$user_id'");
    if ($updateQuery) {
        return "User updated successfully.";
    } else {
        return "Failed to update user.";
    }
}

// Usage example
if (isset($_POST['update-function'])) {
    $user_id = $_POST['user_id'];
    $fullName = $_POST['fullName'];
    $role = $_POST['role'];
    $status = $_POST['status'];
    $station_point = isset($_POST['station_point']) ? $_POST['station_point'] : '';
    $email = $_POST['email'];

    $result = updateUser($connect, $user_id, $fullName, $role, $status, $station_point, $email);
    if (strpos($result, 'successfully') !== false) {
        $_SESSION['success_message'] = $result;
    } else {
        $_SESSION['error_message'] = $result;
    }
    header("Location: users.php");
    exit();
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
                    <a class="dropdown-item" href="#">Account Settings</a>
                      <a class="dropdown-item" href="login.php">Logout</a>
                </div>
            </li>
           
        </ul>
    </div>
</nav>

<div class="sidebar" style="box-shadow: rgba(0, 0, 0, 0.16) 0px 3px 6px, rgba(0, 0, 0, 0.23) 0px 3px 6px;">
    <ul class="text-center" style="margin-top: 80px;"><br>
        <div class="card text-success" style="box-shadow: rgba(0, 0, 0, 0.16) 0px 3px 6px, rgba(0, 0, 0, 0.23) 0px 3px 6px;"><h4>DASHBOARD</h4></div>
        <br>
        <li><a href="./users.php" style="color:white;font-size: 20px;font-family: sans-serif;font-weight:bold;">Users</a></li>
        <li><a href="./stations.php"  style="color: white;font-size: 20px;font-family: sans-serif;font-weight:bold;">ViewStations</a></li>
    </ul>
</div>

<div class="main-content text-center shadow-sm" style="margin-top: 20px;background-color: white;">
<br>
<center><h4>UPDATE USER PROFILE</h4></center>

    <div class="m-4">
    <form action="" method="post">
        <?php
                $select_user = "select * from users where user_id = '" .$_GET['user_id']. "'";
                $result = mysqli_query($connect, $select_user);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) { ?>
        <div class="row align-items-center g-3">
            <div class="col-sm-6">
                <label class="visually-hidden" for="inputFullName">Full Name</label>
                <input type="text" name="fullName"  value="<?php echo $row['fullName']; ?>" required class="form-control" id="inputFullName" placeholder="" required>
            </div>
            <div class="col-sm-6">
                <label class="visually-hidden" for="inputRole">Role</label>
                <input type="text" name="role"  value="<?php echo $row['role']; ?>" required class="form-control" id="inputRole" placeholder="" required>
            </div>
        </div>
        
         <div class="row py-2 align-items-center g-3">

            <div class="col-sm-6">
                <label class="visually-hidden" required for="inputStatus">Status</label>
                <input type="text" name="status"  value="<?php echo $row['status']; ?>" required class="form-control" id="inputStatus" placeholder="" required>
            </div>
            <div class="col-sm-6">
                <label class="visually-hidden" for="inputStationPoint">Station Point/Place</label>
                <input type="text" name="station_point" value="<?php echo isset($row['station_point']) ? $row['station_point'] : ''; ?>" class="form-control" id="inputStationPoint" placeholder="" required>
            </div>
        </div>

         <div class="row py-2 align-items-center g-3">
            <div class="col-sm-6">
                <label class="visually-hidden" for="inputEmail">Email</label>
                <input type="email" name="email" value="<?php echo $row['email']; ?>" class="form-control" id="inputEmail" placeholder="" required>
            </div>
         </div>

         <?php }}?>

          <div class="row py-2 align-items-center g-3">
              <input type="hidden" name="user_id" value="<?php echo $_GET['user_id']; ?>">
              <button type="submit" name="update-function" class="btn btn-block" style="background-color:#0A2D54;width:230px;color:white;margin-left:10px">Update</button>
              </form>
              <span><a href="users.php"><button type="button" class="btn btn-block" style="background-color:#543B0A ;width:230px;color:white">Cancel</button></a></span>
          </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
