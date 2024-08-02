<?php
session_start();
include("./connection/include.php");

// Check if user is not logged in or not a student, then redirect to error page
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'student') {
    header('location:Error404.php');
    exit; // Ensure script execution stops after redirection
}

// Fetch user information from session
$userId = mysqli_real_escape_string($connect, $_SESSION['user_id']);
$query = "SELECT * FROM `user` WHERE `user_id`='$userId'";
$result = mysqli_query($connect, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $fetch = mysqli_fetch_array($result);
    $userFullName = htmlspecialchars($fetch['fullName'], ENT_QUOTES, 'UTF-8');
    $email = htmlspecialchars($fetch['email'], ENT_QUOTES, 'UTF-8');

    // Fetch the trainer associated with the user
    $trainerQuery = "SELECT training.trainer FROM training JOIN user ON training.fullName = user.fullName WHERE user.user_id = '$userId' LIMIT 1";
    $trainerResult = mysqli_query($connect, $trainerQuery);
    $trainerFetch = mysqli_fetch_array($trainerResult);
    $trainerName = $trainerFetch ? htmlspecialchars($trainerFetch['trainer'], ENT_QUOTES, 'UTF-8') : 'N/A';

    // Fetch the supervisor associated with the user's training
    $supervisorQuery = "SELECT training.supervisor FROM training JOIN user ON training.fullName = user.fullName WHERE user.user_id = '$userId' LIMIT 1";
    $supervisorResult = mysqli_query($connect, $supervisorQuery);
    $supervisorFetch = mysqli_fetch_array($supervisorResult);
    $supervisorName = $supervisorFetch ? htmlspecialchars($supervisorFetch['supervisor'], ENT_QUOTES, 'UTF-8') : 'N/A';
} else {
    // Handle case where user data is not found
    $userFullName = 'N/A';
    $trainerName = 'N/A';
    $supervisorName = 'N/A';
    $email = 'N/A';
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
    <div id="wrapper">
        <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color: #0F5091;">
            <!-- Sidebar Menu -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="./studentPorto.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Dashboard</div>
            </a>
            <hr>
            <hr class="sidebar-divider d-none d-md-block">
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
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
                                    <?php echo $email; ?>
                                </span>
                                <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="./changePassword.php">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i> Settings
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="./logout.php" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i> Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <div class="container-fluid">
                    <div class="container">
                        <h2>Weekly Report</h2>
                        <form id="weeklyReportForm" method="post" action="submit_reports.php">
                            <div id="reportEntries">
                                <!-- Report Entry Template -->
                                <div class="report-entry border p-3 mb-3">
                                    <div class="form-group">
                                        <label for="day">Day:</label>
                                        <input type="text" class="form-control" name="day" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="hidden" class="form-control" name="fullName" value="<?php echo $userFullName; ?>" readonly required>
                                    </div>
                                    <div class="form-group">
                                        <input type="hidden" class="form-control" name="trainer" value="<?php echo $trainerName; ?>" readonly required>
                                    </div>
                                    <div class="form-group">
                                        <input type="hidden" class="form-control" name="supervisor" value="<?php echo $supervisorName; ?>" readonly required>
                                    </div>
                                    <div class="form-group">
                                        <label for="activity">Activity/Work Done:</label>
                                        <input type="text" class="form-control" name="activity" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="hourswork">Hours Work:</label>
                                        <input type="text" class="form-control" name="hourswork" rows="3" required>
                                    </div>
                                </div>
                            </div>
                           
                            <button type="submit" class="btn btn-success">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
