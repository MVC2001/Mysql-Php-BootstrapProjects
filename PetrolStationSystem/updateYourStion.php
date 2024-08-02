

<?php
session_start();
include("./connection/include.php");

// Check if user is logged in and has the necessary permissions
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'station_manager') {
    header('location:index.php');
    exit;
}

// Check if expenditure ID is set
if(isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch byid details from the database
    $select_query = "SELECT * FROM `petrol_station` WHERE id = $id";
    $result = mysqli_query($connect, $select_query);
    $station = mysqli_fetch_assoc($result);
} else {
    $_SESSION['error_message'] = "Invalid request!";
    header('Location: updateYourStion.php');
    exit;
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
    <title>Edit point</title>
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
        <a href="./station_manager.php"><div class="card text-success" style="box-shadow: rgba(0, 0, 0, 0.16) 0px 3px 6px, rgba(0, 0, 0, 0.23) 0px 3px 6px;"><h4>DASHBOARD</h4></div></a>
        <br><hr style="background-color:white">
        <li><a href="./orders.php"  style="color: white;font-size: 20px;font-family: sans-serif;font-weight:bold;">New-Order</a></li>
        <li><a href="./stations.php" style="color:white;font-size: 20px;font-family: sans-serif;font-weight:bold;">Your-Station</a></li>
        <li><a href="comfimedOnes.php"  style="color: white;font-size: 20px;font-family: sans-serif;font-weight:bold;">Comfirmed-Order</a></li>
    </ul>
</div>

<div class="main-content text-center shadow-sm" style="margin-top: 20px;background-color: white;">
<br>
<center><h4>EDIT STATION</h4></center>

    <div class="m-4">
    <form action="updatecodes.php" method="post" enctype="multipart/form-data">
       
        <div class="row align-items-center g-3">
         <div class="col-sm-4">
                <label class="visually-hidden" for="inputservice">Station Name</label>
                 <input type="hidden" name="id" value="<?php echo $station['id']; ?>">
                <input type="text" name="" value="<?php echo $station['station_point']; ?>"   required class="form-control" id="inputservice" placeholder="" required>
            </div>
            <div class="col-sm-4">
                <label class="visually-hidden" for="inputservice">Service</label>
                <input type="text" name="service" value="<?php echo $station['service']; ?>" required class="form-control" id="inputservice" placeholder="" required>
            </div>
             <div class="col-sm-4">
                <label class="visually-hidden" for="inputweblink">WebLink</label>
                <input type="text" name="weblink" value="<?php echo $station['weblink']; ?>" required class="form-control" id="inputservice" placeholder="" required>
            </div>
        </div>

        <div class="row py-3 align-items-center g-3">
            <div class="col-sm-6">
                <label class="visually-hidden" for="inputcontact">Contact</label>
                <input type="text" name="contact" value="<?php echo $station['contact']; ?>" required class="form-control" id="inputcontact" placeholder="" required>
            </div>
             <div class="col-sm-6">
                <label class="visually-hidden" for="inputlocation">Location/Place</label>
                <input type="text" name="location" value="<?php echo $station['location']; ?>" required class="form-control" id="inputservice" placeholder="" required>
            </div>
        </div>


        <div class="row py-3 align-items-center g-3">
            <div class="col-sm-4">
                <label class="visually-hidden" for="inputdiesel">Diesel</label>
                <input type="text" name="diesel" value="<?php echo $station['diesel']; ?>" required class="form-control" id="inputdiesel" placeholder="" required>
            </div>
             <div class="col-sm-4">
                <label class="visually-hidden" for="inputpetrol">Petrol</label>
                <input type="text" name="petrol" value="<?php echo $station['petrol']; ?>" required class="form-control" id="inputpetrol" placeholder="" required>
            </div>
             <div class="col-sm-4">
                <label class="visually-hidden" for="inputkerosene">Kerosene</label>
                <input type="text" name="kerosene" value="<?php echo $station['kerosene']; ?>" required class="form-control" id="inputservice" placeholder="" required>
            </div>
        </div>

       

      
          <div class="row py-2 align-items-center g-3">
          <button type="submit" name="add-function" class="btn btn-block" style="background-color:#0A2D54;width:230px;color:white;margin-left:10px">Edit</button>
              </form>
          <span><a href="./stations.php"><button type="button" class="btn btn-block" style="background-color:#543B0A ;width:230px;color:white">Cancel</button></a></span>
          </div>

        
</div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
