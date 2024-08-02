
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
    $select_query = "SELECT * FROM `orders` WHERE id = $id";
    $result = mysqli_query($connect, $select_query);
    $station = mysqli_fetch_assoc($result);
} else {
    $_SESSION['error_message'] = "Invalid request!";
    header('Location: comfirmOrder.php');
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
 <form action="comfirmCodes.php" method="post" enctype="multipart/form-data">
                
        <div class="row text-success align-items-center g-3">
         <div class="col-sm-4">
          <input type="hidden" name="id" value="<?php echo $station['id']; ?>">
                <label class="visually-hidden" for="inputservice">Station Name</label>
                <input type="text"  value="<?php echo $station['station_point']; ?>" name="station_point" required class="form-control" id="inputservice" placeholder="" required>
            </div>
            <div class="col-sm-4">
                <label class="visually-hidden" for="inputdiesel">Client</label>
                <input type="text" name="client" value="<?php echo $station['client']; ?>" required class="form-control" id="inputdiesel" placeholder="" required>
            </div>
               <div class="col-sm-4">
                <label class="visually-hidden" for="inputkerosene">Contact/PhoneNumber</label>
                <input type="text" name="phoneNo" value="<?php echo $station['phoneNo']; ?>" required class="form-control" id="inputservice" placeholder="" required>
            </div>
        </div>



          <div class="row text-success py-4 align-items-center g-3">
            <div class="col-sm-4">
                <label class="visually-hidden" for="inputdiesel">Current Location/Place</label>
                <input type="text" name="location" value="<?php echo $station['location']; ?>" required class="form-control" id="inputdiesel" placeholder="" required>
            </div>

             <div class="col-sm-4">
                <label class="visually-hidden" for="inputdiesel">Fueltype </label>
                <input type="text" name="category" value="<?php echo $station['category']; ?>"  required class="form-control" id="inputdiesel" placeholder="" required>
            </div>
             
             <div class="col-sm-4">
                <label class="visually-hidden" for="inputkerosene">Volume(Litre) </label>
                <input type="text" name="volume" value="<?php echo $station['volume']; ?>"   required class="form-control" id="inputservice" placeholder="" required>
            </div>
            </div>

            <div class="row text-success py-4 align-items-center g-3">
             <div class="col-sm-4">
                <label class="visually-hidden" for="inputkerosene">Comfirm here </label>
                   <select type="text" name="comfirmation" required class="form-control">
                                        <option value="comfirmed">Comfirm</option>
                                <option value="not-comfirmed">Not-comfirmed</option>
                     </select>
            </div>
        </div>
          </div>
        
      
          <div class="row py-2 align-items-center g-3">
          <button type="submit" name="add-function" class="btn btn-block" style="background-color:#0A2D54;width:230px;color:white;margin-left:10px">Comfirm now</button>
              </form>
          <span><a href="./orders.php"><button type="button" class="btn btn-block" style="background-color:#543B0A ;width:230px;color:white">Cancel</button></a></span>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
