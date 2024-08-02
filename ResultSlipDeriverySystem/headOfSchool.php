<?php
session_start();
include("./connection/include.php");

// Check if user is not logged in or not an admin, then redirect to login page
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'head_of_school') {
    header('location:index.php');
    exit; // Ensure script execution stops after redirection
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>HOS </title>
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
            <a href="index.html" class="brand-logo">
               HEAD OF SCHOOL
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
                            <li><a href="./resertPassword.php">Resert</a></li>
                        </ul>
                    </li>
                

                   <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                class="fa fa-list"></i><span class="nav-text">Applications</span></a>
        <ul aria-expanded="false">
            <li><a href="./allRequets.php">Manage</a></li>
        </ul>      


        
                   <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                class="fa fa-list"></i><span class="nav-text">All students</span></a>
        <ul aria-expanded="false">
            <li><a href="./students.php">Manage</a></li>
        </ul>
                
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                        class="fa fa-list"></i><span class="nav-text">Clearance-Forms</span></a>
                <ul aria-expanded="false">
                    <li><a href="./clearanceForms.php">Manage</a></li>
                </ul>

                  <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                        class="fa fa-list"></i><span class="nav-text">Result-Slips</span></a>
                <ul aria-expanded="false">
                    <li><a href="./viewSleep.php">Manage</a></li>
                </ul>
            </li>

        

          <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                        class="fa fa-list"></i><span class="nav-text">Sents</span></a>
                <ul aria-expanded="false">
                    <li><a href="./SentSleeps.php">view</a></li>
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
                                    <div class="stat-text">Users</div>
                                      <?php
                           $countv = mysqli_query($connect,"select user_id from users") or die(mysqli_error($connect));
                                $countv = mysqli_num_rows($countv);
                                    if(empty($countv) >= 0){  ?>
                                    <div class="stat-digit"> <i class="fa fa-users"></i><?php echo $countv;?></div>
                                    <?php }?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="stat-widget-two card-body">
                                <div class="stat-content">
                                    <div class="stat-text">Result-Slips</div>
                                     <?php
                           $count = mysqli_query($connect,"SELECT id FROM resultsleep_tbl") or die(mysqli_error($connect));
                                $count = mysqli_num_rows($count);
                                    if(empty($count) >= 0){  ?>
                                    <div class="stat-digit"> <i class="fa fa-list"></i><?php echo $count;?></div>
                                     <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="stat-widget-two card-body">
                                <div class="stat-content">
                                    <div class="stat-text">Clearance Forms</div>
                                      <?php
                           $countv1 = mysqli_query($connect,"SELECT id FROM clearance_forms ") or die(mysqli_error($connect));
                                $countv1 = mysqli_num_rows($countv1);
                                    if(empty($countv1) >= 0){  ?>
                                    <div class="stat-digit"> <i class="fa fa-file"></i><?php echo $countv1;?></div>
                                     <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="stat-widget-two card-body">
                                <div class="stat-content">
                                    <div class="stat-text">Applications</div>
                                    <div class="stat-digit"> 
                                       <?php
                           $countv1 = mysqli_query($connect,"SELECT id FROM request_tbl ") or die(mysqli_error($connect));
                                $countv1 = mysqli_num_rows($countv1);
                                    if(empty($countv1) >= 0){  ?>
                                    <div class="stat-digit"> <i class="fa fa-file"></i><?php echo $countv1;?></div>
                                     <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
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