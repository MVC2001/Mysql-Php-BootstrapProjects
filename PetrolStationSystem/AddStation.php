<?php
$success_message = '';

if(isset($_POST['submit'])) {
    $station_point = isset($_POST['station_point']) ? $_POST['station_point'] : '';
    $image = isset($_FILES['image']['name']) ? $_FILES['image']['name'] : '';
    $service = isset($_POST['service']) ? $_POST['service'] : '';
    $weblink = isset($_POST['weblink']) ? $_POST['weblink'] : '';
    $contact = isset($_POST['contact']) ? $_POST['contact'] : '';
    $location = isset($_POST['location']) ? $_POST['location'] : '';
    $diesel = isset($_POST['diesel']) ? $_POST['diesel'] : '';
    $petrol = isset($_POST['petrol']) ? $_POST['petrol'] : '';
    $kerosene = isset($_POST['kerosene']) ? $_POST['kerosene'] : '';

    // Database connection
    $conn = mysqli_connect("localhost", "root", "", "petrol_stationdb");

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // File upload
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);

    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        $success_message = "The file " . htmlspecialchars(basename($_FILES["image"]["name"])) . " has been uploaded.";
    } else {
        $success_message = "Sorry, there was an error uploading your file.";
    }

    $sql = "INSERT INTO petrol_station (station_point, image, service, weblink, contact, location, diesel, petrol, kerosene) VALUES ('$station_point', '$image', '$service', '$weblink', '$contact', '$location', '$diesel', '$petrol', '$kerosene')";
    
    if (mysqli_query($conn, $sql)) {
        $success_message .= "<br>New record created successfully";
    } else {
        $success_message .= "<br>Error: " . $sql . "<br>" . mysqli_error($conn);
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
<center><h4>PETROL STATION REGISTRATION</h4></center>

    <div class="m-4">
    <form action="" method="post" enctype="multipart/form-data">
        <div class="row align-items-center g-3">
         <div class="col-sm-4">
                <label class="visually-hidden" for="inputservice">Station Name</label>
                <input type="text" name="station_point" required class="form-control" id="inputservice" placeholder="" required>
            </div>
            <div class="col-sm-4">
                <label class="visually-hidden" for="inputservice">Service</label>
                <input type="text" name="service" required class="form-control" id="inputservice" placeholder="" required>
            </div>
             <div class="col-sm-4">
                <label class="visually-hidden" for="inputweblink">WebLink</label>
                <input type="text" name="weblink" required class="form-control" id="inputservice" placeholder="" required>
            </div>
        </div>

        <div class="row py-3 align-items-center g-3">
            <div class="col-sm-6">
                <label class="visually-hidden" for="inputcontact">Contact</label>
                <input type="text" name="contact" required class="form-control" id="inputcontact" placeholder="" required>
            </div>
             <div class="col-sm-6">
                <label class="visually-hidden" for="inputlocation">Location/Place</label>
                <input type="text" name="location" required class="form-control" id="inputservice" placeholder="" required>
            </div>
        </div>


        <div class="row py-3 align-items-center g-3">
            <div class="col-sm-4">
                <label class="visually-hidden" for="inputdiesel">Diesel</label>
                <input type="text" name="diesel" required class="form-control" id="inputdiesel" placeholder="" required>
            </div>
             <div class="col-sm-4">
                <label class="visually-hidden" for="inputpetrol">Location/Place</label>
                <input type="text" name="petrol" required class="form-control" id="inputpetrol" placeholder="" required>
            </div>
             <div class="col-sm-4">
                <label class="visually-hidden" for="inputkerosene">Kerosene</label>
                <input type="text" name="kerosene" required class="form-control" id="inputservice" placeholder="" required>
            </div>
        </div>

        <div class="row py-3 align-items-center g-3">
            <div class="col-sm-12">
                <label class="visually-hidden" for="inputdiesel">Photo/Poster</label>
                <input type="file" id="image" name="image" required class="form-control" id="inputdiesel" placeholder="" required>
            </div>
        </div>
        
      
          <div class="row py-2 align-items-center g-3">
          <button type="submit" name="submit" class="btn btn-block" style="background-color:#0A2D54;width:230px;color:white;margin-left:10px">Create</button>
              </form>
          <span><a href="./stations.php"><button type="button" class="btn btn-block" style="background-color:#543B0A ;width:230px;color:white">Cancel</button></a></span>
          </div>

          <?php if (!empty($success_message)) : ?>
            <div class="alert alert-success mt-4" role="alert">
                <?php echo $success_message; ?>
            </div>
          <?php endif; ?>

</div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
