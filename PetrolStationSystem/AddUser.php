<?php
include("./connection/include.php");
session_start(); 

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('location:Error404.php');
    exit; // Ensure script execution stops after redirection
}

function addUser($connect, $fullName, $role,$status,$station_point, $email, $password) {
    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return "Invalid email format.";
    }

    // Check if the role is selected
    if ($role == "None-user") {
        return "Please select a role.";
    }

    // Check if email already exists
    $checkEmailQuery = mysqli_query($connect, "SELECT * FROM `users` WHERE `email` = '$email'");
    if (mysqli_num_rows($checkEmailQuery) > 0) {
        return "Email already exists.";
    }

    // Check if password already exists (optional, depends on your application logic)
    // For example, you can check the password uniqueness if needed

    // Hash the password
    $hashedPassword = md5($password);

    // Insert user into database
    $insertQuery = mysqli_query($connect, "INSERT INTO `users` (`fullName`, `role`,`status`,`station_point`, `email`, `password`) VALUES ('$fullName', '$role','$status','$station_point', '$email', '$hashedPassword')");
    if ($insertQuery) {
        return "User added successfully.";
    } else {
        return "Failed to add user.";
    }
}


// Usage example
if (isset($_POST['add-function'])) {
    // Assuming $connect is your database connection
    $fullName = $_POST['fullName'];
    $role = $_POST['role']; // Corrected name attribute
    $status =$_POST['status'];
    $station_point = $_POST['station_point'];
    $email = $_POST['email'];
    $password = $_POST['password'];


    $result = addUser($connect, $fullName, $role,$status,$station_point, $email, $password);
    if (strpos($result, 'successfully') !== false) {
        $_SESSION['success_message'] = $result;
    } else {
        $_SESSION['error_message'] = $result;
    }
    header("Location: {$_SERVER['PHP_SELF']}");
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
    <title>Add user</title>
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
        <li><a href="#" style="color:white;font-size: 20px;font-family: sans-serif;font-weight:bold;">Users</a></li>
        <li><a href="#"  style="color: white;font-size: 20px;font-family: sans-serif;font-weight:bold;">Roles</a></li>
    </ul>
</div>

<div class="main-content text-center shadow-sm" style="margin-top: 20px;background-color: white;">
<br>
<center><h4>USER REGISTRATION</h4></center>
<?php if(isset($_SESSION['success_message'])): ?>
    <div class="alert alert-success" role="alert">
        <?php echo $_SESSION['success_message']; ?>
    </div>
    <?php unset($_SESSION['success_message']); ?>
    <?php endif; ?>

    <!-- Error message -->
    <?php if(isset($_SESSION['error_message'])): ?>
    <div class="alert alert-danger" role="alert">
        <?php echo $_SESSION['error_message']; ?>
    </div>
    <?php unset($_SESSION['error_message']); ?>
    <?php endif; ?>
    <div class="m-4">
    <form action="" method="post">
        <div class="row align-items-center g-3">
            <div class="col-sm-6">
                <label class="visually-hidden" for="inputEmail">FullName</label>
                <input type="text" name="fullName" required class="form-control" id="inputfullName" placeholder="" required>
            </div>
            <div class="col-sm-6">
                <label class="visually-hidden" for="inputPassword">Role</label>
               <select type="text" name="role" required class="form-control">
                                          <option value="None-user">--Selct-----role--------</option>
                                          <option value="admin">System admin</option>
                                           <option value="station_manager"> Station Owner</option>
                                           <option value="">Guest</option>
                                           </select>
            </div>
        </div>
        
         <div class="row py-2 align-items-center g-3">

        <div class="col-sm-6">
                    <label class="visually-hidden" required for="inputPassword">Status</label>
               <select type="text" name="status" class="form-control">
                                          <option value="empty">--Selct-----status--------</option>
                                          <option value="active">Active</option>
                                           <option value="not-active">Not-active</option>
                </select>
            </div>
            <div class="col-sm-6">
                   <label class="visually-hidden" for="inputPassword">Station Point/Place</label>
                <input type="text" name="station_point" class="form-control" id="inputSpoint" placeholder="" required>
            </div>
        </div>

         <div class="row py-2 align-items-center g-3">
          <div class="col-sm-6">
                   <label class="visually-hidden" for="inputPassword">Email</label>
                <input type="email" name="email" class="form-control" id="inputemail" placeholder="" required>
            </div>

             <div class="col-sm-6">
                   <label class="visually-hidden" for="inputPassword">Password</label>
                <input type="password" name="password" class="form-control" id="inputPassword" placeholder="" required>
            </div>
         </div>

          <div class="row py-2 align-items-center g-3">
          <button type="submit" name="add-function" class="btn btn-block" style="background-color:#0A2D54;width:230px;color:white;margin-left:10px">Create</button>
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
