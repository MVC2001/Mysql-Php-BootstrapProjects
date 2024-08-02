<?php
session_start();
include("./connection/include.php");
if (!isset($_SESSION['user_id'])) {
    header('location:index.php');
    exit; // Make sure to exit after redirecting
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>student</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="./images/favicon.png">
    <link rel="stylesheet" href="./vendor/owl-carousel/css/owl.carousel.min.css">
    <link rel="stylesheet" href="./vendor/owl-carousel/css/owl.theme.default.min.css">
    <link href="./vendor/jqvmap/css/jqvmap.min.css" rel="stylesheet">
    <link href="./css/style.css" rel="stylesheet">



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
            <a href="" class="brand-logo">
               WELCOME STUDENT
            </a>

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
                        <div class="header-left">
                            <div class="search_bar dropdown">
                                <div class="dropdown-menu p-0 m-0">
                                </div>
                            </div>
                        </div>

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
        <div class="quixnav" style="background-color:#11517c;">
            <div class="quixnav-scroll">
                <ul class="metismenu" id="menu">
                   
                 
                    <hr>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                class="fa fa-list"></i><span class="nav-text">Resert-Password</span></a>
                        <ul aria-expanded="false">
                            <li><a href="./resertPasswordv1.php">Resert here</a></li>
                        </ul>
                    </li>
                     <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                class="fa fa-list"></i><span class="nav-text">Apply now</span></a>
                        <ul aria-expanded="false">
                            <li><a href="./requestSleep.php">here</a></li>
                        </ul>
                    </li>

                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                class="fa fa-list"></i><span class="nav-text">Download-slip</span></a>
                        <ul aria-expanded="false">
                            <li><a href="./yourSleep.php">Download here</a></li>
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
            <!-- row -->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="stat-widget-two card-body">
                                <div class="stat-content">
                                    <div class="stat-text">Your-slip</div>
                                       <?php 
$select_all_users = "SELECT resultsleep_tbl.id,resultsleep_tbl.sleep_file,resultsleep_tbl.approved, resultsleep_tbl.fullName, users.fullName FROM resultsleep_tbl JOIN users ON resultsleep_tbl.fullName = users.fullName WHERE user_id=$_SESSION[user_id] AND approved ='approved'";
$result = mysqli_query($connect, $select_all_users);
$number = mysqli_num_rows($result);
if ($number > 0) {
    while($row = mysqli_fetch_assoc($result)) { 
        if ($row['approved'] == 'approved') { ?>
            <div class="stat-digit"> <i class="fa fa-book" style="color:green;font-size:20px"></i>
                <?php echo $row['sleep_file']; ?>
            </div>
        <?php }
        }
    } else { ?>
        <div class="stat-digit">
            <i class="fa fa-danger" style="color:red;font-size:30px"></i>
            <p style="color:red">File not found (404)<p>
        </div>
    <?php } ?>                       </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                    </div>
                   
                    <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="stat-widget-two card-body">
                                <div class="stat-content">
                                    <div class="stat-text">Status</div>
                              <?php 
$select_all_users = "SELECT resultsleep_tbl.id, resultsleep_tbl.approved, resultsleep_tbl.fullName, users.fullName FROM resultsleep_tbl JOIN users ON resultsleep_tbl.fullName = users.fullName WHERE user_id=$_SESSION[user_id]";
$result = mysqli_query($connect, $select_all_users);
$number = mysqli_num_rows($result);
if ($number > 0) {
    while($row = mysqli_fetch_assoc($result)) { 
        if ($row['approved'] == 'approved') { ?>
            <div class="stat-digit"> <i class="fa fa-check" style="color:green;font-size:30px"></i>
                <?php echo $row['approved']; ?>
            </div>
       <?php }
        }
    } else { ?>
        <div class="stat-digit">
            <i class="fa fa-danger" style="color:red;font-size:30px"></i>
            <p style="color:red">Wait for approve<p>
        </div>
    <?php } ?>                       </div>
                 

                             
                            </div>
                        </div>
                    </div>
                   
                    <div class="col-lg-3 col-sm-6">
                        <!-- /# card -->
                    </div>
                    <!-- /# column -->
                </div></div>
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


    <!-- Vectormap -->
    <script src="./vendor/raphael/raphael.min.js"></script>
    <script src="./vendor/morris/morris.min.js"></script>


    <script src="./vendor/circle-progress/circle-progress.min.js"></script>
    <script src="./vendor/chart.js/Chart.bundle.min.js"></script>

    <script src="./vendor/gaugeJS/dist/gauge.min.js"></script>

    <!--  flot-chart js -->
    <script src="./vendor/flot/jquery.flot.js"></script>
    <script src="./vendor/flot/jquery.flot.resize.js"></script>

    <!-- Owl Carousel -->
    <script src="./vendor/owl-carousel/js/owl.carousel.min.js"></script>

    <!-- Counter Up -->
    <script src="./vendor/jqvmap/js/jquery.vmap.min.js"></script>
    <script src="./vendor/jqvmap/js/jquery.vmap.usa.js"></script>
    <script src="./vendor/jquery.counterup/jquery.counterup.min.js"></script>


    <script src="./js/dashboard/dashboard-1.js"></script>

</body>

</html>