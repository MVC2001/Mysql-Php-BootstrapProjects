<?php
session_start();
include("./connection/include.php");

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'head_of_school') {
    header('location:index.php');
    exit; // Ensure script execution stops after redirection
}

//sent request logic
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if ID is provided
    if (isset($_POST['id'])) {
        // Sanitize input to prevent SQL injection
        $id = mysqli_real_escape_string($connect, $_POST['id']);
        $fullName = mysqli_real_escape_string($connect, $_POST['fullName']);
        $indexNo = mysqli_real_escape_string($connect, $_POST['indexNo']);
        $sleep_file = mysqli_real_escape_string($connect, $_POST['sleep_file']);
        $status = mysqli_real_escape_string($connect, $_POST['status']);
        $approved = mysqli_real_escape_string($connect, $_POST['approved']);
        $school = mysqli_real_escape_string($connect, $_POST['school']);

        // Check if student is already approved
        $check_query = "SELECT approved FROM resultsleep_tbl WHERE id = $id";
        $check_result = mysqli_query($connect, $check_query);
        $row = mysqli_fetch_assoc($check_result);
        if ($row['approved'] === 'approved') {
            echo "<script>alert('Sleep already sent to this user.');</script>";
        } else {
            // Update the request details in the database
            $query = "UPDATE `resultsleep_tbl` SET fullName='$fullName', indexNo='$indexNo', sleep_file='$sleep_file', status='$status', approved='$approved',school='$school'  WHERE id=$id";

            if (mysqli_query($connect, $query)) {
                // Redirect to the page where the request details are displayed
                header("Location: viewSleep.php?id=$id");
                exit();
            } else {
                echo "Error updating record: " . mysqli_error($connect);
            }
        }
    } else {
        echo "ID not provided.";
    }
} else {
    echo "Invalid request method.";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Reset password </title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="./images/favicon.png">
    <!-- Custom Stylesheet -->
    <link href="./css/style.css" rel="stylesheet">

</head>

<body>

    <!-- Main wrapper start -->
    <div id="main-wrapper">

        <!-- Nav header start -->
        <div class="nav-header">
            <div class="nav-control">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span><span class="line"></span>
                </div>
            </div>
        </div>
        <!-- Nav header end -->

        <!-- Header start -->
        <div class="header">
            <div class="header-content">
                <nav class="navbar navbar-expand">
                    <div class="collapse navbar-collapse justify-content-between">
                        <div class="header-left"></div>
                        <ul class="navbar-nav header-right">
                            <li class="nav-item dropdown header-profile">
                                <a class="nav-link" href="#" role="button" data-toggle="dropdown">
                                    <i class="mdi mdi-account"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="./logout.php" class="dropdown-item">
                                        <i class="icon-key"></i>
                                        <span class="ml-2">Logout </span>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <!-- Header end -->

        <!-- Sidebar start -->
        <div class="quixnav" style="background-color:#11517c;">
            <div class="quixnav-scroll">
                <ul class="metismenu" id="menu">
                    <hr>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i class="icon icon-single-04"></i><span class="nav-text">Back-home</span></a>
                        <ul aria-expanded="false">
                            <li><a href="./allRequets.php">Back-now</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <!-- Sidebar end -->

        <!-- Content body start -->
        <div class="content-body">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Student slip Details</h5>
                            </div>
                            <div class="card-body">
                                <?php
                                // Check if the request ID is provided in the URL
                                if (isset($_GET['id'])) {
                                    $request_id = $_GET['id'];

                                    // Fetch the details of the request from the database
                                    $query = mysqli_query($connect, "SELECT * FROM `resultsleep_tbl` WHERE id = $request_id");
                                    $request = mysqli_fetch_assoc($query);

                                    // Display the details
                                    if ($request) {
                                        // Display request details here
                                ?>
                                        <form action="" method="POST">
                                            <input type="hidden" name="id" value="<?php echo $request_id; ?>">
                                            <div class="form-group">
                                                <label for="fullName">Full Name</label>
                                                <input type="text" class="form-control" id="fullName" name="fullName" value="<?php echo $request['fullName']; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="indexNo">Index No</label>
                                                <input type="text" class="form-control" id="indexNo" name="indexNo" value="<?php echo $request['indexNo']; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="sleep_file">Result Sleep</label>
                                                <input type="text" class="form-control" id="sleep_file" name="sleep_file" value="<?php echo $request['sleep_file']; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="sleep_file">School</label>
                                                <input type="text" class="form-control" id="school" name="school" value="<?php echo $request['school']; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="status">Status</label>
                                                <input type="text" class="form-control" id="status" name="status" value="<?php echo $request['status']; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="approved">Approved</label>
                                                <select type="text"  name="approved" class="form-control" id="approved" >
                                           <option value="None">--Select-----status--------</option>
                                              <option value="approved">Approved</option>
                                       <option value="not-approved">Not-approved</option> 
                                           </select>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Send-Sleep</button>
                                             <span><button class="btn btn-danger btn-sm"><a href="./viewSleep.php" style="color:white">Cancel</a></button></span>
                                        </form>
                                <?php
                                    } else {
                                        echo "<p>Request not found.</p>";
                                    }
                                } else {
                                    echo "<p>Request ID not provided.</p>";
                                }
                                ?>
                            
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Content body end -->

    </div>
    <!-- Main wrapper end -->

    <!-- Scripts -->
    <!-- Required vendors -->
    <script src="./vendor/global/global.min.js"></script>
    <script src="./js/quixnav-init.js"></script>
    <script src="./js/custom.min.js"></script>

</body>

</html>
