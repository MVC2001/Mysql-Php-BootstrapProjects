<?php
include("./connection/include.php");
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'supervisor') {
    header('location:Error404.php');
    exit;
}

function addMarks($connect, $supervisor, $student, $course, $marks) {
    if (!is_numeric($marks) || $marks > 10) {
        return "Marks must be a numeric value and not exceed 10.";
    }

    $insertQuery = mysqli_query($connect, "INSERT INTO `marks` (`supervisor`, `student`, `course`, `marks`) VALUES ('$supervisor', '$student', '$course', '$marks')");
    if ($insertQuery) {
        return "Marks added successfully.";
    } else {
        return "Failed to add marks.";
    }
}

if (isset($_POST['add-marks'])) {
    $supervisor = $_POST['supervisor'];
    $student = $_POST['student'];
    $course = $_POST['course'];
    $marks = $_POST['marks'];

    $result = addMarks($connect, $supervisor, $student, $course, $marks);
    if (strpos($result, 'successfully') !== false) {
        $_SESSION['success_message'] = $result;
    } else {
        $_SESSION['error_message'] = $result;
    }
    header("Location: {$_SERVER['PHP_SELF']}");
    exit();
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT training.fullName 
        FROM training 
        JOIN user ON training.supervisor = user.fullName 
        WHERE user.user_id='$user_id' 
        ORDER BY training.id DESC";

$result = $connect->query($sql);

if ($connect->error) {
    die("Query failed: " . $conn->error);
}

$fullNames = [];
while ($row = $result->fetch_assoc()) {
    $fullNames[] = $row['fullName'];
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
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>
<body id="page-top">
    <div id="wrapper">
        <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color: #0F5091;">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="./studentDailyReport.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Dashboard</div>
            </a>
            <hr>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Users</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="./studentDailyReport.php">Manage</a>
                    </div>
                </div>
            </li>
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
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
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
                <div class="container-fluid">
                    <div class="row">
                        <form class="form-inline" action="" method="POST" onsubmit="return validateMarks()">
                            <?php if(isset($_SESSION['success_message'])): ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <?php echo $_SESSION['success_message']; ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">&times;</button>
                            </div>
                            <?php unset($_SESSION['success_message']); ?>
                            <?php endif; ?>
                            <?php if(isset($_SESSION['error_message'])): ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <?php echo $_SESSION['error_message']; ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">&times;</button>
                            </div>
                            <?php unset($_SESSION['error_message']); ?>
                            <?php endif; ?>
                            <div class="card">
                                <div class="card-header">
                                </div>
                                <div class="card-body">
                                    <div class="basic-form">
                                        <div class="form-row">
                                            <input name="supervisor" required type="hidden"
                                                <?php 
                                                $select_all_roles = "SELECT fullName FROM user WHERE `user_id`='$_SESSION[user_id]'" or die(mysqli_error($connect));
                                                $result = mysqli_query($connect, $select_all_roles);
                                                $number = mysqli_num_rows($result);
                                                if ($number > 0) {
                                                    while($row = mysqli_fetch_assoc($result)) {
                                                        echo 'value="' . $row['fullName'] . '"';
                                                    }
                                                }
                                                ?> class="form-control">
                                            <div class="col-sm-6 mt-2 mt-sm-0">
                                                <select type="text" name="student" id="student" class="form-control" required>
                                                    <option value="" disabled selected>Select a student</option>
                                                    <?php foreach ($fullNames as $fullName): ?>
                                                        <option value="<?php echo htmlspecialchars($fullName); ?>">
                                                            <?php echo htmlspecialchars($fullName); ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="col-sm-6 mt-2 mt-sm-0">
                                                <input name="course" required type="text" class="form-control" placeholder="Course">
                                            </div>
                                            <div class="col-sm-6 mt-2 mt-sm-0">
                                                <br>
                                                <input name="marks" id="marks" required type="number" class="form-control" placeholder="Marks" max="10">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <div class="basic-form">
                                        <button type="submit" name="add-marks" class="btn btn-primary mb-2" style="background-color:#0F5091">Add Marks</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                                       </div>
            </div>
        </div>
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <a class="btn btn-primary" href="./logout.php">Logout</a>
                    </div>
                </div>
            </div>
        </div>
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
        <script src="js/sb-admin-2.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        <script>
            function validateMarks() {
                var marks = document.getElementById('marks').value;
                if (marks > 10) {
                    toastr.error('Marks cannot exceed 10.');
                    return false;
                }
                return true;
            }
        </script>
    </div>
</body>
