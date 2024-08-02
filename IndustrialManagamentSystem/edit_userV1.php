<?php
include("./connection/include.php");
session_start();

// Process form submission
if (isset($_POST['addToTrangiTbl'])) {
    // Retrieve form data
    $fullName = $_POST['fullName'];
    $course = $_POST['course'];
    $fieldName = $_POST['fieldName'];
    $location = $_POST['location'];
    $address = $_POST['address'];
    $trainer = $_POST['trainer'];
    $supervisor = $_POST['supervisor'];
    $start_from = $_POST['start_from'];
    $end_to = $_POST['end_to'];
    $assign = $_POST['assign'];

    // SQL query to insert data into training table
    $query = "INSERT INTO training (fullName, course, fieldName, location, address, trainer, supervisor, start_from, end_to, assign)
              VALUES ('$fullName', '$course', '$fieldName', '$location', '$address', '$trainer', '$supervisor', '$start_from', '$end_to', '$assign')";
    
    // Execute query and handle success or error
    if (mysqli_query($connect, $query)) {
        header('Location: assignedStudents.php');
        exit();
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($connect);
    }
}

// Fetch user data for dropdowns
$select_trainers = "SELECT * FROM user WHERE role = 'IndustrialField_trainer'";
$result_trainers = mysqli_query($connect, $select_trainers);

$select_supervisors = "SELECT * FROM user WHERE role = 'supervisor'";
$result_supervisors = mysqli_query($connect, $select_supervisors);
?>

 
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
 <!-- Sidebar -->
        <ul class="navbar-nav  sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color: #0F5091 ;">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="./IndustrialField_coordinator.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Dashboard</div>
            </a>
            <hr>            
           

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <!-- End of Sidebar -->
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                  

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                       
                       

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"> <?php   $query = mysqli_query($connect, "SELECT * FROM `user` WHERE `user_id`='$_SESSION[user_id]'") or die(mysqli_connect_error());
                                   $fetch = mysqli_fetch_array($query);
                                  echo "" . $fetch['email'] . " "; ?></span>
                                <img class="img-profile rounded-circle"
                                    src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                             
                                <a class="dropdown-item" href="./changePassword.php">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                            
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="./logout.php" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Content Row -->
                    <div class="row">
             <form class="form-inline" action="" method="POST">

              <?php
                $select_user = "select * from user where user_id = '" .$_GET['user_id']. "'";
                $result = mysqli_query($connect, $select_user);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) { ?>
                        </div>


                        <div class="card">
                            <div class="card-header">
                
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                
                                        <div class="form-row">
    
                                            <div class="col-sm-6 mt-2 mt-sm-0">
                                                <input name="fullName" value="<?php echo $row['fullName']; ?>" type="text" class="form-control" placeholder="fullName">
                                            </div>

                                            
                                            <div class="col-sm-6 mt-2 mt-sm-0">
                                                <input name="role" value="<?php echo $row['role']; ?>" type="text" class="form-control" placeholder="Role">
                                            </div>
                                        </div>
                            
                                </div>
                            </div>
                        </div>



                        
                        <div class="card">
                            <div class="card-header">
                
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                
                                        <div class="form-row">
    
                                            <div class="col-sm-6 mt-2 mt-sm-0">
                                                <input name="course" value="<?php echo $row['course']; ?>" type="text" class="form-control" placeholder="course is for students, others optional">
                                            </div>

                                            
                                            <div class="col-sm-6 mt-2 mt-sm-0">
                                                <input name="status" value="<?php echo $row['status']; ?>" type="text" class="form-control" placeholder="stataus active or not-active">
                                            </div>
                                        </div>
                            
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="form-row">
                         <h4 class="text-center" style="margin-left:35px;color:#0F5091">FILL INPUTS FIELD BELOW TO ASSIGN STUDENT TO INDUSTRIAL FIELD</h4>
                                        </div>


                                  <div class="card">
                            <div class="card-header">
                
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                
                                        <div class="form-row">
    
                                            <div class="col-sm-6 mt-2 mt-sm-0">
                                              <label for="fieldName">fieldName</label>
                                                <input name="fieldName"  type="text" class="form-control" placeholder="">
                                            </div>

                                            
                                            <div class="col-sm-6 mt-2 mt-sm-0">
                                             <label for="location">location</label>
                                                <input name="location" type="text" class="form-control" placeholder="">
                                            </div>
                                        </div>
                            
                                </div>
                            </div>
                        </div>


                           <div class="card">
                            <div class="card-header">
                
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                
                                        <div class="form-row">
    
                                            <div class="col-sm-6 mt-2 mt-sm-0">
                                             <label for="address">address</label>
                                                <input name="address"  type="text" class="form-control" placeholder="">
                                            </div>

                                            
                                            <!-- Inside your form -->
<div class="col-sm-6 mt-2 mt-sm-0">
    <label for="trainer">Trainer</label>
    <select name="trainer" class="form-control" required>
        <option value="">Select Trainer</option>
        <?php while ($row = mysqli_fetch_assoc($result_trainers)) { ?>
            <option value="<?php echo $row['user_id']; ?>"><?php echo $row['fullName']; ?></option>
        <?php } ?>
    </select>
</div>
                                        </div>
                            
                                </div>
                            </div>
                        </div>



                            
                         <div class="card">
                            <div class="card-header">
                
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                
                                        <div class="form-row">
    
                                           <div class="col-sm-6 mt-2 mt-sm-0">
    <label for="supervisor">Supervisor</label>
    <select name="supervisor" class="form-control" required>
        <option value="">Select Supervisor</option>
        <?php mysqli_data_seek($result_supervisors, 0); // Reset result pointer ?>
        <?php while ($row = mysqli_fetch_assoc($result_supervisors)) { ?>
            <option value="<?php echo $row['user_id']; ?>"><?php echo $row['fullName']; ?></option>
        <?php } ?>
    </select>
</div>
                                            
                                            <div class="col-sm-6 mt-2 mt-sm-0">
                                            <label for="start_from">start_from	</label>
                                                <input name="start_from" type="date" class="form-control" placeholder="start_from">
                                            </div>
                                        </div>
                            
                                </div>
                            </div>
                        </div>


                           <div class="card">
                            <div class="card-header">
                
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                
                                        <div class="form-row">
    
                                            <div class="col-sm-6 mt-2 mt-sm-0">
                                             <label for="end_to">end_to</label>
                                                <input name="end_to"  type="date" class="form-control" placeholder="">
                                            </div>

                                            
                                            <div class="col-sm-6 mt-2 mt-sm-0">
                                            <label for="start_from">Assign	</label>
                                                <select name="assign" required  type="text" class="form-control" placeholder="">
                            <option selected>Select to assign</option>
                            <option value="assigned">Assign now</option>
                            <option value="not-assigned">Not-assigned</option>
            
                        </select>
                                            </div>
                                        </div>
                            
                                </div>
                            </div>
                        </div>
                        
                          <?php }}?>
                       
                        <div class="card">
                          
                            <div class="card-body">
                                <div class="basic-form">
                                
                                        <button type="submit" name="addToTrangiTbl" class="btn btn-primary mb-2" style="background-color:#0F5091">update</button>
                                    </form>

                        </div>

                    
        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="./logout.php">Logout now</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>