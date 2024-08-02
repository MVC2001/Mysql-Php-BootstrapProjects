<?php
session_start();
include("./connection/include.php");

// Check if user is not logged in or not a supervisor, then redirect to login page
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'supervisor') {
    header('location:Error404.php');
    exit; // Ensure script execution stops after redirection
}

// Fetch user information from session
$query = mysqli_query($connect, "SELECT * FROM `user` WHERE `user_id`='$_SESSION[user_id]'") or die(mysqli_connect_error());
$fetch = mysqli_fetch_array($query);
$trainerFullName = $fetch['fullName'];

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
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>
<body id="page-top">
    <div id="wrapper">
        <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color: #0F5091;">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="./supervisor.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Dashboard</div>
            </a>
            <hr>
            <!-- Add a link to the reports page -->
            <li class="nav-item">
                <a class="nav-link" href="./weeklyReportV1.php?id=<?php echo $id; ?>">
                    <i class="fas fa-fw fa-table"></i>
                    <span>My Reports</span>
                </a>
            </li>
        </ul>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <ul class="navbar-nav ml-auto">
                        <div class="topbar-divider d-none d-sm-block"></div>
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                    <?php echo $trainerFullName; ?>
                                </span>
                                <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="./logout.php" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <div class="container-fluid">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No#</th>
                                            <th>Week</th>
                                            <th>Day</th>
                                            <th>Student</th>
                                            <th>Activity/WorkDone</th>
                                            <th>HoursWork</th>
                                            <th>Remark</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       <?php
                                       $count = 1;
                                       $current_week = 1; // Initialize week counter
                                       $prev_day = null; // Track previous day to determine new week

                                       $query = "
                                           SELECT weeklyreport.*, weeklyreport.fullName
                                           FROM weeklyreport
                                           JOIN user ON weeklyreport.supervisor = user.fullName
                                           WHERE user.user_id = '$_SESSION[user_id]'
                                           ORDER BY weeklyreport.id ASC"; // Assuming 'id' is the primary key and auto-incrementing
                                       $result = mysqli_query($connect, $query);
                                       $number = mysqli_num_rows($result);
                                       if ($number > 0) {
                                           while ($row = mysqli_fetch_assoc($result)) {
                                               $current_day = date('l', strtotime($row['day']));
                                               if ($prev_day !== null && $prev_day === 'Friday' && $current_day !== 'Friday') {
                                                   // Start new row for a new week
                                                   $current_week++;
                                               }
                                       ?>
                                               <tr>
                                                   <td><?php echo $count; ?></td>
                                                   <td><?php echo $current_week; ?></td>
                                                   <td><?php echo $row['day']; ?></td>
                                                   <td><?php echo $row['fullName']; ?></td>
                                                   <td><?php echo $row['activity']; ?></td>
                                                   <td><?php echo $row['hourswork']; ?></td>
                                                   <td><?php echo $row['supervisorRemark']; ?></td>
                                                   <td><?php echo $row['created_at']; ?></td>
                                                   <td>
                                                       <a href="remarkReportV3.php?id=<?php echo $row['id']; ?>">
                                                           <button class="btn btn-warning btn-sm">Remark</button>
                                                       </a>
                                                   </td>
                                               </tr>
                                       <?php
                                               $count++;
                                               $prev_day = $current_day;
                                           }
                                       }
                                       ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Content Wrapper -->
        </div>
        <!-- End of Page Wrapper -->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <a class="btn btn-primary" href="./logout.php">Logout now</a>
                    </div>
                </div>
            </div>
        </div>
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
        <script src="js/sb-admin-2.min.js"></script>
        <script src="vendor/chart.js/Chart.min.js"></script>
        <script src="js/demo/chart-area-demo.js"></script>
        <script src="js/demo/chart-pie-demo.js"></script>
    </div>
</body>
</html>
