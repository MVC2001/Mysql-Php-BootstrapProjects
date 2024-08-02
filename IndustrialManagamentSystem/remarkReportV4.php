<?php
session_start();
include("./connection/include.php");

// Check if user is not logged in or not an admin, then redirect to login page
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'IndustrialField_trainer') {
    header('location:Error404.php');
    exit; // Ensure script execution stops after redirection
}

// Check if ID parameter is passed in URL
if (!isset($_GET['id'])) {
    header('location:Error404.php');
    exit;
}

$id = $_GET['id'];

// Fetch field report by ID
$query = mysqli_query($connect, "SELECT * FROM `weeklyreport` WHERE `id`='$id'") or die(mysqli_connect_error());
$row = mysqli_fetch_array($query);

// Check if field report exists
if (!$row) {
    echo "Field report not found!";
    exit;
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $trainerComment = $_POST['trainerComment'];
    $remark = $_POST['remark'];
      $marksv1 = $_POST['marksv1'];
    

    // Update field report with new values
    $update_query = "UPDATE weeklyreport SET trainerComment='$trainerComment',remark='$remark',marksv1='$marksv1' WHERE id='$id'";
    $update_result = mysqli_query($connect, $update_query);

    if ($update_result) {
        header('Location: ./dailyReporForStudent.php');
        exit;
    } else {
        echo "Failed to update field report!";
    }
}

// Fetch all field reports for the supervisor
$all_reports_query = "
    SELECT weeklyreport.* 
    FROM weeklyreport
    JOIN user ON weeklyreport.trainer = user.fullName
    WHERE user.user_id = '$_SESSION[user_id]'
    ORDER BY weeklyreport.id DESC";
$all_reports_result = mysqli_query($connect, $all_reports_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Update Field Report</title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>
<body id="page-top">
    <div id="wrapper">
        <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color: #0F5091;">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="./IndustrialField_trainer.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Dashboard</div>
            </a>
            <hr>
        </ul>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <ul class="navbar-nav ml-auto">
                      
                    </ul>
                </nav>
                <div class="container-fluid">

                <!-- Display all field reports -->
                    <div class="card shadow mb-4">
                       
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No#</th>
                                            <th>Date</th>
                                            <th>Activity</th>
                                            <th>Comment</th>
                                            <th>Remark</th>
                                            <th>Marks</th>
                                            <th>Trainer Comment</th>
                                            <th>Added at</th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $count = 1;
                                        while ($report = mysqli_fetch_assoc($all_reports_result)) {
                                        ?>
                                            <tr>
                                                <td><?php echo $count; ?></td>
                                                <td><?php echo $report['report_date']; ?></td>
                                                <td><?php echo $report['activity']; ?></td>
                                                <td><?php echo $report['comment']; ?></td>
                                                <td><?php echo $report['remark']; ?></td>
                                                <td><?php echo $report['marksv1']; ?></td>
                                                <td><?php echo $report['trainerComment']; ?></td>
                                                <td><?php echo $report['created_at']; ?></td>
                                               
                                            </tr>
                                        <?php
                                            $count++;
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Display the specific field report -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Remark now</h6>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="">
                                <div class="form-group">
                                    <label for="trainerComment">Trainer Comment:</label>
                                    <textarea type="text" class="form-control" id="trainerComment" name="trainerComment" value="<?php echo $row['trainerComment']; ?>" required></textarea>
                                </div>
                                 <div class="form-group">
                                    <label for="marksv1">Marks:</label>
                                    <input type="text" class="form-control" id="marksv1" name="marksv1" value="<?php echo $row['marksv1']; ?>" required></input>
                                </div>
                               
                                <div class="form-group">
                                    <label for="remark">Remark:</label>
                                    <select class="form-control" id="remark" name="remark">
                                        <option value="remarked" <?php if ($row['remark'] == 'remarked') echo 'selected'; ?>>Remark</option>
                                        <option value="not-remarked" <?php if ($row['remark'] == 'not-remarked') echo 'selected'; ?>>Not Remark</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </form>
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
</body
</html>