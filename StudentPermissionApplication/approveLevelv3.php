<?php
session_start();
include("./connection/include.php");

// Check if user is not logged in or not an admin, then redirect to login page
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'DeanOfSchl') {
    header('location:index.php');
    exit; // Ensure script execution stops after redirection
}

$query = mysqli_query($connect, "SELECT permission_tbl.id,permission_tbl.fullName,permission_tbl.regNo,permission_tbl.yearOfStudy,permission_tbl.approved1_at,permission_tbl.approveForDirOfStuService,permission_tbl.Course,permission_tbl.Dept,permission_tbl.School,permission_tbl.days,permission_tbl.departingOn,permission_tbl.returningOn,permission_tbl.reasonFor,permission_tbl.phoneNumber,permission_tbl.date,permission_tbl.cForDirOfStuService,permission_tbl.approved2_at,permission_tbl.approveForHoD,permission_tbl.cForHoD,permission_tbl.created_at, users.School FROM permission_tbl JOIN users ON permission_tbl.School = users.School WHERE user_id=$_SESSION[user_id] and approveForHoD='already_forwarded' and approveForDeanOfSchl != 'Permissioned_granted'");

$results = mysqli_fetch_all($query, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Approves </title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="./images/favicon.png">
    <!-- Datatable -->
    <link href="./vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
    <!-- Custom Stylesheet -->
    <link href="./css/style.css" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->


    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header">
            <div class="nav-control">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span><span class="line"></span>
                </div>
            </div>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->

        <!--**********************************
            Header start
        ***********************************-->
        <div class="header">
            <div class="header-content">
                <nav class="navbar navbar-expand">
                    <div class="collapse navbar-collapse justify-content-between">
                        <div class="header-left"></div>
                        <ul class="navbar-nav header-right">
                            <li class="nav-item dropdown header-profile">
                                <a class="nav-link" href="#" role="button" data-toggle="dropdown">
                                      <?php   $query = mysqli_query($connect, "SELECT * FROM `users` WHERE `user_id`='$_SESSION[user_id]'") or die(mysqli_connect_error());
                                   $fetch = mysqli_fetch_array($query);
                                  echo "" . $fetch['email'] . " "; ?><i class="mdi mdi-account"></i>
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
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

         <!--**********************************
            Sidebar start
        ***********************************-->
        <div class="quixnav">
            <div class="quixnav-scroll">
                <ul class="metismenu" id="menu">
                   <hr>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i class="icon icon-single-04"></i><span class="nav-text">Back-home</span></a>
                        <ul aria-expanded="false">
                            <li><a href="./DeanOfSchl.php">Back-now</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <!--**********************************
            Sidebar end
        ***********************************-->

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid">
                <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4>All application for-permission here</h4>
                        </div>
                    </div>
                </div>
                <!-- row -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example2" class="display" style="width:100%">
                                        <thead>
                                            <tr>
                                                 <th>Full Name</th>
                                                <th>RegNo</th>
                                                 <th>YearOfStudy</th>
                                                  <th>Course</th>
                                                <th>Dept</th>
                                                 <th>School</th>
                                                  
                                                       <th>HODLevel</th>
                                                      <th>Approved at</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($results as $result) : ?>
                                                <tr>
                                                    <td><?php echo $result['fullName']; ?></td>
                                                    <td><?php echo $result['regNo']; ?></td>
                                                     <td><?php echo $result['yearOfStudy']; ?></td>
                                                      <td><?php echo $result['Course']; ?></td>
                                                    <td><?php echo $result['Dept']; ?></td>
                                                     <td><?php echo $result['School']; ?></td>                  
                                                     <td><button class="btn btn-success btn-sm"><?php echo $result['approveForHoD']; ?></button></td>
                                                      <td><?php echo $result['approved2_at']; ?></td>
                                                    <td>
                                                        <!-- Buttons for delete, update, and download -->
                                                          <a href="approveHerev3.php?id=<?php echo $result['id']; ?>" class="btn btn-info btn-sm">Approve</a>
                                                        <form action="deletePermissionv2.php" method="POST" style="display: inline;">
                                                            <input type="hidden" name="fullName" value="<?php echo $result['fullName']; ?>">
                                                            <input type="hidden" name="regNo" value="<?php echo $result['regNo']; ?>">
                                                            <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->
    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="./vendor/global/global.min.js"></script>
    <script src="./js/quixnav-init.js"></script>
    <script src="./js/custom.min.js"></script>
    <!-- Datatable -->
    <script src="./vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="./js/plugins-init/datatables.init.js"></script>

</body>

</html>
