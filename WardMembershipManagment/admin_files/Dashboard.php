
<?php
session_start();
include("../include/connection.php");


?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Admin dash</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description">
        <meta content="Coderthemes" name="author">
        <!-- App favicon -->
        <!-- App css -->
        <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css">
        <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" id="light-style">
        <link href="assets/css/app-dark.min.css" rel="stylesheet" type="text/css" id="dark-style">

    </head>

    <body class="loading" data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>
        
       <?php if ($_SESSION['role'] == 'admin' ){ ?>
        <!-- Begin page -->
        <div class="wrapper">
            <!-- ========== Left Sidebar Start ========== -->
            <div class="leftside-menu" style="background-color: #003e6a;">
                <div class="h-100" id="leftside-menu-container" data-simplebar="" style="background-color:#003e6a">
                    <!--- Sidemenu -->
                    <ul class="side-nav">
                        <li class="side-nav-item">
                            <a data-bs-toggle="collapse" href="#sidebarDashboards" aria-expanded="false" aria-controls="sidebarDashboards" class="side-nav-link">
                                <i class="uil-home-alt" style="color:white;font-size:30px"></i>
                                <span style="color:white"><b>Admin Dashbord<hr></b> </span>
                            </a>
                        </li>

          <!------------citizen account----------->
                        <li class="side-nav-item">
                            <a data-bs-toggle="collapse" href="#sidebarEcommerce" aria-expanded="false" aria-controls="sidebarEcommerce" class="side-nav-link">
                                <i class="uil-user" style="color:white;font-size:30px"></i>
                                <span  style="color:white">CITIZEN ACCOUNT</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="sidebarEcommerce">
                                <ul class="side-nav-second-level">
                                    <li>
                                        <a href="./citizen_files/addCitizenDash.php"  style="color:white">Enroll_new_citizen</a>
                                    </li>
                                    <li>
                                        <a href="./citizen_files/CitizensAccount.php"  style="color:white">Manage_citizens</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                       

                           <!----------report pannel----------->
                           <li class="side-nav-item">
                            <a data-bs-toggle="collapse" href="#sidebarEmail" aria-expanded="false" aria-controls="sidebarEmail" class="side-nav-link">
                                <i class="uil-home" style="color:white;font-size:30px"></i>
                                <span  style="color:white">REPORT_PANNEL</span>
                                 <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="sidebarEmail">
                                <ul class="side-nav-second-level">
                                    <li>
                                        <a href="../View&print_reportAdmin.php"  style="color:white">View_&_PrintReport</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
      <!-------ends here----->
                </div>
            </div>
         <!-- Sidebar bar ends here -->

            <div class="content-page">
                <div class="content">
                    <!-- Topbar Start -->
                    <div class="navbar-custom">
                        <ul class="list-unstyled topbar-menu float-end mb-0">
                   <!-------header bar foR & account --->
                            <li class="dropdown notification-list">
                                <a class="nav-link dropdown-toggle nav-user arrow-none me-0" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                   <p style="color:teal" class="shadow"><b>Account</b></p>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated topbar-dropdown-menu profile-dropdown">
                                  <?php 
                              $select_adim_row = "select * from admin WHERE  role='admin'" or die(mysqli_error($connect));
                              $result = mysqli_query($connect,$select_adim_row);
                             $number = mysqli_num_rows($result);
                             if ($number > 0) {
                             while($row = mysqli_fetch_assoc($result)) { ?>       
                             <a href="AccountSetting.php?admin_id=<?php echo $row['admin_id'] ?>" style="color:teal;margin-left:30px">Profile</a>
                            <?php } }?>
                                         <!-- logout item-->
                                    <a href="../index.php" class="dropdown-item notify-item">
                                        <i class="mdi mdi-logout me-1">Logout</i></a>
                                </div>
                            </li>

                        </ul>
                        <button class="button-menu-mobile open-left">
                            <i class="mdi mdi-menu"></i>
                        </button>
                        <div class="app-search dropdown d-none d-lg-block">
                            <div class="dropdown-menu dropdown-menu-animated dropdown-lg" id="search-dropdown">
                            </div>
                        </div>
                    </div>
                    <!-- end Topbar -->
                    <!-- Start Content-->
                    <div class="container-fluid">
                        <!-- count for current user -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 
                        <div class="row" style="margin-top:200px">
                            <div class="col-12">
                                <div class="card widget-inline">
                                    <div class="card-body p-0">
                                        <div class="row g-0">
                                            <div class="col-sm-6 col-xl-3">
                                             <!----count card for sms of students av-->
                                                <div class="card shadow-none m-0 border-start" style="border-radius:10px;background-color:#003e6a">
                                                    <div class="card-body text-center">
                                                            <i class="dripicons-user-group text-muted shadow" style="font-size: 50px;color:white"></i>
                                                        <i class="dripicons-user-group text-muted shadow" style="font-size: 50px;color:teal"></i>
                                                <?php
                                                    $countCitizen = mysqli_query($connect,"select cit_id from citizen_tbl") or die(mysqli_error($connect));
                                                     $user = mysqli_num_rows($countCitizen);
                                                     if(empty($user) >= 0){
                                                       ?>
                                                      <h4 style="color:white;font-size:20px"><?php echo $user;?></h>
                                                     <?php } ?>
                                                        <a href="../admin_files/citizen_files/CitizensAccount.php" class="text-muted font-15 mb-0">Total <b>Citizen</b> available</a>
                                                    </div>
                                                </div>
                                            </div>
                
                                            <div class="col-sm-6 col-xl-3">
                                             <!----count card for advisors av-->
                                                <div class="card shadow-none m-0 border-start">
                                                    <div class="card-body text-center">
                                                         <i class="dripicons-user-group text-muted shadow" style="font-size: 50px;color:teal"></i>
                                                               <i class="dripicons-user-group text-muted shadow" style="font-size: 50px;color:teal"></i>

                                                        <?php
                                                    $countCitizen = mysqli_query($connect,"select cit_id from deletedcitizen_tbl") or die(mysqli_error($connect));
                                                     $user = mysqli_num_rows($countCitizen);
                                                     if(empty($user) >= 0){
                                                       ?>
                                                      <h4 style="color:teal;font-size:20px"><?php echo $user;?></h>
                                                     <?php } ?>
                                                        <a href="../admin_files/InActiveMbembers.php" class="text-muted font-15 mb-0">Deleted <b>Citizen</b> available</a>
                                                    </div>
                                                </div>
                                            </div>
                
                                            <div class="col-sm-6 col-xl-3">
                                             <!----count card for sms of students av-->
                                                <div class="card shadow-none m-0 border-start">
                                                    <div class="card-body text-center">
                                                            <i class="dripicons-user-group text-muted shadow" style="font-size: 50px;color:white"></i>
                                                        <i class="dripicons-user-group text-muted shadow" style="font-size: 50px;color:teal"></i>
                                                                <i class="dripicons-user-group text-muted shadow" style="font-size: 50px;color:teal"></i>
                                                        <?php
                                                    $countCitizen = mysqli_query($connect,"select text_id from admin_txts_tbl") or die(mysqli_error($connect));
                                                     $user = mysqli_num_rows($countCitizen);
                                                     if(empty($user) >= 0){
                                                       ?>
                                                      <h4 style="color:teal;font-size:20px"><?php echo $user;?></h>
                                                     <?php } ?>
                                                        <a href="" class="text-muted font-15 mb-0">Total messages of Admin</a>
                                                    </div>
                                                </div>
                                            </div>
                
                                            <div class="col-sm-6 col-xl-3">
                                             <!----count card for sms of advisor av--->
                                                <div class="card shadow-none m-0 border-start"  style="border-radius:10px;background-color:#003e6a">
                                                    <div class="card-body text-center">
                                                            <i class="dripicons-user-group text-muted shadow" style="font-size: 50px;color:teal"></i>
                                                      <?php
                                                    $countCitizen = mysqli_query($connect,"select text_id from citizen_txts_tbl") or die(mysqli_error($connect));
                                                     $user = mysqli_num_rows($countCitizen);
                                                     if(empty($user) >= 0){
                                                       ?>
                                                      <h4 style="color:white;font-size:20px"><?php echo $user;?></h>
                                                     <?php } ?>
                                                        <p class="text-muted font-15 mb-0">Total messages of Citzens</p>
                                                    </div>
                                                </div>
                                            </div>
                
                                        </div> <!-- end row -->
                                    </div>
                                </div> <!-- end card-box-->
                            </div> <!-- end col-->
                        </div>
                        <!-- end row-->
                        <div class="row" style="margin-top:70px">
<div class="col-md-12">
<h4><center>ADMIN PANNEL</center></h4>
</div>
</div>
 </div> </div>
 <div class="rightbar-overlay"></div> <!-- /End-bar -->

<?php }?>


 
       <?php if ($_SESSION['role'] == 'chairP' ){ ?>


   <!-- Begin page -->
        <div class="wrapper">
            <!-- ========== Left Sidebar Start ========== -->
            <div class="leftside-menu" style="background-color: #003e6a;">
                <div class="h-100" id="leftside-menu-container" data-simplebar="" style="background-color:#003e6a">
                    <!--- Sidemenu -->
                    <ul class="side-nav">
                        <li class="side-nav-item">
                            <a data-bs-toggle="collapse" href="#sidebarDashboards" aria-expanded="false" aria-controls="sidebarDashboards" class="side-nav-link">
                                <i class="uil-home-alt" style="color:white;font-size:30px"></i>
                                <span style="color:white"><b>ChairP Dashbord<hr></b> </span>
                            </a>
                        </li>

          <!------------citizen account----------->
                        <li class="side-nav-item">
                            <a data-bs-toggle="collapse" href="#sidebarEcommerce" aria-expanded="false" aria-controls="sidebarEcommerce" class="side-nav-link">
                                <i class="uil-user" style="color:white;font-size:30px"></i>
                                <span  style="color:white">CITIZEN ACCOUNT</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="sidebarEcommerce">
                                <ul class="side-nav-second-level">
                                    <li>
                                        <a href="./ChairP/CitizensAccount.php"  style="color:white">View_citizens</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                           <!------------chating pannel-->
                        <li class="side-nav-item">
                            <a data-bs-toggle="collapse" href="#sidebarEmail" aria-expanded="false" aria-controls="sidebarEmail" class="side-nav-link">
                                <i class="uil-message" style="color:white;font-size:30px"></i>
                                <span  style="color:white">CHATING AREA</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="sidebarEmail">
                                <ul class="side-nav-second-level">
                                    <li>
                                        <a href="./Chats/AdminChatPannel.php"  style="color:white">Start_chating</a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                           <!----------report pannel----------->
                           <li class="side-nav-item">
                            <a data-bs-toggle="collapse" href="#sidebarEmail" aria-expanded="false" aria-controls="sidebarEmail" class="side-nav-link">
                                <i class="uil-home" style="color:white;font-size:30px"></i>
                                <span  style="color:white">REPORT_PANNEL</span>
                                 <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="sidebarEmail">
                                <ul class="side-nav-second-level">
                                    <li>
                                        <a href="./ChairP/View&print_report.php"  style="color:white">View_&_PrintReport</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
      <!-------ends here----->
                </div>
            </div>
         <!-- Sidebar bar ends here -->

            <div class="content-page">
                <div class="content">
                    <!-- Topbar Start -->
                    <div class="navbar-custom">
                        <ul class="list-unstyled topbar-menu float-end mb-0">
                   <!-------header bar foR & account --->
                            <li class="dropdown notification-list">
                                <a class="nav-link dropdown-toggle nav-user arrow-none me-0" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                   <p style="color:teal" class="shadow"><b>Account</b></p>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated topbar-dropdown-menu profile-dropdown">
                                  <?php 
                              $select_adim_row = "select * from admin where role= 'chairP'" or die(mysqli_error($connect));
                              $result = mysqli_query($connect,$select_adim_row);
                             $number = mysqli_num_rows($result);
                             if ($number > 0) {
                             while($row = mysqli_fetch_assoc($result)) { ?>       
                             <a href="AccountSetting.php?admin_id=<?php echo $row['admin_id'] ?>" style="color:teal;margin-left:30px">Profile</a>
                            <?php } }?>
                                         <!-- logout item-->
                                    <a href="../logout.php" class="dropdown-item notify-item">
                                        <i class="mdi mdi-logout me-1">Logout</i></a>
                                </div>
                            </li>

                        </ul>
                        <button class="button-menu-mobile open-left">
                            <i class="mdi mdi-menu"></i>
                        </button>
                        <div class="app-search dropdown d-none d-lg-block">
                            <div class="dropdown-menu dropdown-menu-animated dropdown-lg" id="search-dropdown">
                            </div>
                        </div>
                    </div>
                    <!-- end Topbar -->
                    <!-- Start Content-->
                    <div class="container-fluid">
                        <!-- count for current user -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 
                        <div class="row" style="margin-top:200px">
                            <div class="col-12">
                                <div class="card widget-inline">
                                    <div class="card-body p-0">
                                        <div class="row g-0">
                                            <div class="col-sm-6 col-xl-3">
                                             <!----count card for sms of students av-->
                                                <div class="card shadow-none m-0 border-start" style="border-radius:10px;background-color:#003e6a">
                                                    <div class="card-body text-center">
                                                            <i class="dripicons-user-group text-muted shadow" style="font-size: 50px;color:white"></i>
                                                        <i class="dripicons-user-group text-muted shadow" style="font-size: 50px;color:teal"></i>
                                                <?php
                                                    $countCitizen = mysqli_query($connect,"select cit_id from citizen_tbl") or die(mysqli_error($connect));
                                                     $user = mysqli_num_rows($countCitizen);
                                                     if(empty($user) >= 0){
                                                       ?>
                                                      <h4 style="color:white;font-size:20px"><?php echo $user;?></h>
                                                     <?php } ?>
                                                        <a href="./ChairP/CitizensAccount.php" class="text-muted font-15 mb-0">Total <b>Citizen</b> available</a>
                                                    </div>
                                                </div>
                                            </div>
                
                                            <div class="col-sm-6 col-xl-3">
                                             <!----count card for advisors av-->
                                                <div class="card shadow-none m-0 border-start">
                                                    <div class="card-body text-center">
                                                         <i class="dripicons-user-group text-muted shadow" style="font-size: 50px;color:teal"></i>
                                                               <i class="dripicons-user-group text-muted shadow" style="font-size: 50px;color:teal"></i>

                                                        <?php
                                                    $countCitizen = mysqli_query($connect,"select cit_id from deletedcitizen_tbl") or die(mysqli_error($connect));
                                                     $user = mysqli_num_rows($countCitizen);
                                                     if(empty($user) >= 0){
                                                       ?>
                                                      <h4 style="color:teal;font-size:20px"><?php echo $user;?></h>
                                                     <?php } ?>
                                                        <a href="./ChairP/InActiveM.php" class="text-muted font-15 mb-0">Deleted <b>Citizen</b> available</a>
                                                    </div>
                                                </div>
                                            </div>
                
                                            <div class="col-sm-6 col-xl-3">
                                             <!----count card for sms of students av-->
                                                <div class="card shadow-none m-0 border-start">
                                                    <div class="card-body text-center">
                                                            <i class="dripicons-user-group text-muted shadow" style="font-size: 50px;color:white"></i>
                                                        <i class="dripicons-user-group text-muted shadow" style="font-size: 50px;color:teal"></i>
                                                                <i class="dripicons-user-group text-muted shadow" style="font-size: 50px;color:teal"></i>
                                                        <?php
                                                    $countCitizen = mysqli_query($connect,"select text_id from admin_txts_tbl") or die(mysqli_error($connect));
                                                     $user = mysqli_num_rows($countCitizen);
                                                     if(empty($user) >= 0){
                                                       ?>
                                                      <h4 style="color:teal;font-size:20px"><?php echo $user;?></h>
                                                     <?php } ?>
                                                        <a href="" class="text-muted font-15 mb-0">Total messages of Admin</a>
                                                    </div>
                                                </div>
                                            </div>
                
                                            <div class="col-sm-6 col-xl-3">
                                             <!----count card for sms of advisor av--->
                                                <div class="card shadow-none m-0 border-start"  style="border-radius:10px;background-color:#003e6a">
                                                    <div class="card-body text-center">
                                                            <i class="dripicons-user-group text-muted shadow" style="font-size: 50px;color:teal"></i>
                                                      <?php
                                                    $countCitizen = mysqli_query($connect,"select text_id from citizen_txts_tbl") or die(mysqli_error($connect));
                                                     $user = mysqli_num_rows($countCitizen);
                                                     if(empty($user) >= 0){
                                                       ?>
                                                      <h4 style="color:white;font-size:20px"><?php echo $user;?></h>
                                                     <?php } ?>
                                                        <p class="text-muted font-15 mb-0">Total messages of Citzens</p>
                                                    </div>
                                                </div>
                                            </div>
                
                                        </div> <!-- end row -->
                                    </div>
                                </div> <!-- end card-box-->
                            </div> <!-- end col-->
                        </div>
                        <!-- end row-->
                        <div class="row" style="margin-top:70px">
<div class="col-md-12">
<h4><center>CHAIR PERSION PANNEL</center></h4>
</div>
</div>
 </div> </div>
 <div class="rightbar-overlay"></div> <!-- /End-bar -->




       <?php }?>

 <!-- bundle -->
        <script src="assets/js/vendor.min.js"></script>
        <script src="assets/js/app.min.js"></script>

        <!-- third party js -->
        <script src="assets/js/vendor/Chart.bundle.min.js"></script>
        <!-- third party js ends -->

        <!-- demo app -->
        <script src="assets/js/pages/demo.dashboard-projects.js"></script>
        <!-- end demo js-->

        

    </body>
</html>
