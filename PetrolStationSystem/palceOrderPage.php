<?php
session_start();
include("./connection/include.php");

function insertOrder($connect, $station_point, $client, $phoneNo, $location, $category, $volume) {
    // Use prepared statements to prevent SQL injection
    $insertQuery = mysqli_prepare($connect, "INSERT INTO `orders` (`station_point`, `client`, `phoneNo`, `location`, `category`, `volume`) VALUES (?, ?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($insertQuery, "ssssss", $station_point, $client, $phoneNo, $location, $category, $volume);
    
    if (mysqli_stmt_execute($insertQuery)) {
        return "Order placed successfully.";
    } else {
        return "Failed to place order: " . mysqli_error($connect);
    }
}

if (isset($_POST['place-order'])) {
    $station_point = $_POST['station_point'];
    $client = $_POST['client'];
    $phoneNo = $_POST['phoneNo'];
    $location = $_POST['location'];
    $category = $_POST['category'];
    $volume = $_POST['volume'];

    $result = insertOrder($connect, $station_point, $client, $phoneNo, $location, $category, $volume);
    if (strpos($result, 'successfully') !== false) {
        $_SESSION['success_message'] = $result;
    } else {
        $_SESSION['error_message'] = $result;
    }
    header("Location: successfullPage.php");
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
    <title>Order pannel</title>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Orders</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent" style="box-shadow: rgba(9, 30, 66, 0.25) 0px 1px 1px, rgba(9, 30, 66, 0.13) 0px 0px 1px 1px;">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">
                    HOME
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="./index.php">Logout</a>
                </div>
            </li>
           
        </ul>
    </div>
</nav>

<div class="sidebar" style="box-shadow: rgba(0, 0, 0, 0.16) 0px 3px 6px, rgba(0, 0, 0, 0.23) 0px 3px 6px;">
    <ul class="text-center" style="margin-top: 80px;"><br>
        <div class="card text-success" style="box-shadow: rgba(0, 0, 0, 0.16) 0px 3px 6px, rgba(0, 0, 0, 0.23) 0px 3px 6px;"><h4>MENU</h4></div>
        <br>
        <li><a href="./users.php" style="color:white;font-size: 20px;font-family: sans-serif;font-weight:bold;">Addlocation-Your</a></li>
    </ul>
</div>

<div class="main-content text-center shadow-sm shadow-sm" style="margin-top: 20px">
<br>
<p>PLACE ORDER HERE</p>
<hr>
  <div class="form">
 <form action="" method="post" enctype="multipart/form-data">
                    <?php
                $select_user = "select * from petrol_station where id = '" .$_GET['id']. "'";
                $result = mysqli_query($connect, $select_user);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) { ?>

        <div class="row align-items-center g-3">
         <div class="col-sm-4">
                <label class="visually-hidden" for="inputservice">Station Name</label>
                <input type="text"  value="<?php echo $row['station_point']; ?>" name="station_point" required class="form-control" id="inputservice" placeholder="" required>
            </div>
            <div class="col-sm-4">
                <label class="visually-hidden" for="inputservice">Service</label>
                <input type="text" name="service" value="<?php echo $row['service']; ?>" required class="form-control" id="inputservice" placeholder="" required>
            </div>
             <div class="col-sm-4">
                <label class="visually-hidden" for="inputweblink">WebLink</label>
                <input type="text" name="weblink" value="<?php echo $row['weblink']; ?>" required class="form-control" id="inputservice" placeholder="" required>
            </div>
        </div>

        <div class="row py-3 align-items-center g-3">
            <div class="col-sm-6">
                <label class="visually-hidden" for="inputcontact">Contact</label>
                <input type="text" name="contact" value="<?php echo $row['contact']; ?>" required class="form-control" id="inputcontact" placeholder="" required>
            </div>
             <div class="col-sm-6">
                <label class="visually-hidden" for="inputlocation">Location/Place</label>
                <input type="text" name="location" value="<?php echo $row['location']; ?>" required class="form-control" id="inputservice" placeholder="" required>
            </div>
        </div>


        <div class="row py-3 align-items-center g-3">
            <div class="col-sm-4">
                <label class="visually-hidden" for="inputdiesel">Diesel</label>
                <input type="text" name="diesel" value="<?php echo $row['diesel']; ?>" required class="form-control" id="inputdiesel" placeholder="" required>
            </div>
             <div class="col-sm-4">
                <label class="visually-hidden" for="inputpetrol">Location/Place</label>
                <input type="text" name="petrol" value="<?php echo $row['petrol']; ?>" required class="form-control" id="inputpetrol" placeholder="" required>
            </div>
             <div class="col-sm-4">
                <label class="visually-hidden" for="inputkerosene">Kerosene</label>
                <input type="text" name="kerosene" value="<?php echo $row['kerosene']; ?>" required class="form-control" id="inputservice" placeholder="" required>
            </div>
        </div>
         <?php }}?>
          
          <br>
          <hr>
          <center><h4 style="color:teal;font-size:30px">FILL THIS FORM TO PLACE ORDER NOW</h4></center>
          <div class="comtainerOrder text-success shadow-sm">
          <div class="row py-3 align-items-center g-3">
            <div class="col-sm-6">
                <label class="visually-hidden" for="inputdiesel">Enter fullName</label>
                <input type="text" name="client" required class="form-control" id="inputdiesel" placeholder="" required>
            </div>
             
             <div class="col-sm-6">
                <label class="visually-hidden" for="inputkerosene">Enter Contact/PhoneNumber</label>
                <input type="text" name="phoneNo"  required class="form-control" id="inputservice" placeholder="" required>
            </div>
        </div>
          </div>


          <div class="row text-success py-3 align-items-center g-3">
            <div class="col-sm-4">
                <label class="visually-hidden" for="inputdiesel">Enter Current Location/Place Your</label>
                <input type="text" name="location" required class="form-control" id="inputdiesel" placeholder="" required>
            </div>

             <div class="col-sm-4">
                <label class="visually-hidden" for="inputdiesel">Enter fule type(.eg kerosene) </label>
                <input type="text" name="category" required class="form-control" id="inputdiesel" placeholder="" required>
            </div>
             
             <div class="col-sm-4">
                <label class="visually-hidden" for="inputkerosene">Enter volume total volume(Litre) </label>
                <input type="text" name="volume"  required class="form-control" id="inputservice" placeholder="" required>
            </div>
        </div>
          </div>
        
        
      
          <div class="row py-2 align-items-center g-3">
          <button type="submit" name="place-order" class="btn btn-block" style="background-color:#0A2D54;width:230px;color:white;margin-left:10px">Add order now</button>
              </form>
          <span><a href="./index.php"><button type="button" class="btn btn-block" style="background-color:#543B0A ;width:230px;color:white">Cancel</button></a></span>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
