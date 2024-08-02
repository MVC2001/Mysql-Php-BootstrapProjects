<?php
session_start();
include("./connection/include.php");

// Check if user is not logged in or not a student, then redirect to login page
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'student') {
    header('location:Error404.php');
    exit; // Ensure script execution stops after redirection
}

// Function to group results by week
function groupReportsByWeek($result) {
    $weeks = [];
    $week = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $week[] = $row;
        if ($row['day'] == 'Friday') {
            $weeks[] = $week;
            $week = [];
        }
    }
    // If there are remaining reports not forming a full week
    if (!empty($week)) {
        $weeks[] = $week;
    }
    return $weeks;
}

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
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color: #0F5091;">
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="./studentPorto.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Dashboard</div>
            </a>
            <hr>
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
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                    <?php
                                    $query = mysqli_query($connect, "SELECT * FROM `user` WHERE `user_id`='$_SESSION[user_id]'") or die(mysqli_connect_error());
                                    $fetch = mysqli_fetch_array($query);
                                    echo "" . $fetch['email'] . " ";
                                    ?>
                                </span>
                                <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
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
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- DataTables Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Your weekly Report</h6>
                            <a href="./addWeeklyReport.php"><button type="button" class="btn btn-primary mb-2" style="background-color:#0F5091">Add new report</button></a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No#</th>
                                            <th>Date</th>
                                            <th>Day</th>
                                            <th>WorkDone</th>
                                            <th>HoursWork</th>
                                            <th>Supervisor Remark</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $count = 1;
                                        $weekNumber = 1;
                                        $select_all_users = "SELECT * FROM `weeklyreport` ORDER BY id ASC";
                                        $result = mysqli_query($connect, $select_all_users);
                                        $weeks = groupReportsByWeek($result);

                                        foreach ($weeks as $week) {
                                            echo '<tr><td colspan="6" style="font-weight:bold;background-color:#e9ecef;">Week ' . $weekNumber . '</td></tr>';
                                            $weekNumber++;
                                            foreach ($week as $row) { ?>
                                                <tr>
                                                    <td><?php echo $count; ?></td>
                                                    <td><?php echo $row['created_at']; ?></td>
                                                    <td><?php echo $row['day']; ?></td>
                                                    <td><?php echo $row['activity']; ?></td>
                                                    <td><?php echo $row['hourswork']; ?></td>
                                                    <td><?php echo $row['supervisorRemark']; ?></td>
                                                </tr>
                                                <?php $count++; ?>
                                            <?php }
                                            echo '<tr><td colspan="6" style="background-color: #f8f9fc;"></td></tr>'; // Add space between weeks
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
            <!-- End of Main Content -->
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
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