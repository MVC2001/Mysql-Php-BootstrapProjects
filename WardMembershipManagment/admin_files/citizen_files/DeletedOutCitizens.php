
<?php
include("../include/connection.php");

//post citizen data
if (isset($_POST["post_deletedcitzen_data"])) {
  $fullname = $_POST['fullname'];
 $gender = $_POST['gender'];
  $occupation = $_POST['occupation'];
  $postal_codes = $_POST['postal_codes'];

  $insert_deleted_citizen = "INSERT INTO deletedcitizen_tbl (fullname,gender,occupation,postal_codes)
      VALUES('$fullname','$gender','$occupation','$postal_codes');";

  if (mysqli_query($connect, $insert_deleted_citizen)) {
    echo "<div class='alert alert-success'>New Citzen/Street Member  Added Successfull</div>";
    header("location:CitizensAccount.php");
    exit();
  } else{
  echo "<div class='alert alert-danger'>wrong unsuccessfull enrollment try again</div>";
  }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Add deleted citizen</title>
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
        <!-- Begin page -->
        <div class="wrapper">
            <!-- ========== Left Sidebar Start ========== -->
            <div class="leftside-menu" style="background-color: teal;">
                <div class="h-100" id="leftside-menu-container" data-simplebar="">
                    <!--- Sidemenu -->
                    <ul class="side-nav">
                        <li class="side-nav-item">
                            <a data-bs-toggle="collapse" href="#sidebarDashboards" aria-expanded="false" aria-controls="sidebarDashboards" class="side-nav-link">
                                <i class="uil-user" style="color:white;font-size:30px;font-weight: bold;"></i>
                                <span style="color: white;">ADD DELETED CITIZEN </span>
                            </a>
                        </li>

                        <li class="side-nav-title side-nav-item" style="color:white;font-weight: bold;"><center>Actions</center></li>

          <!------------advisor account----------->
                        <li class="side-nav-item">
                            <a data-bs-toggle="collapse" href="#sidebarEcommerce" aria-expanded="false" aria-controls="sidebarEcommerce" class="side-nav-link">
                                <i class="uil-home-alt" style="color:white;font-size:40px"></i>
                                <span style="color:teal;"><b>Back in dashboard</b> </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <!-----advisors modal-->
                            <div class="collapse" id="sidebarEcommerce">
                                <ul class="side-nav-second-level">
                                    <li>
                                        <a href="../Dashboard.php">back now</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                </div>
            </div>
         <!-- Sidebar bar ends here -->



       <!-- ============================================================== -->
            <!-- Start Page Content here -->
      <!-- ============================================================== -->

            <div class="content-page">
                <div class="content">
                    <!-- Topbar Start -->
                    <div class="navbar-custom">
                        <button class="button-menu-mobile open-left">
                            <i class="mdi mdi-menu"></i>
                        </button>
                        <div class="app-search dropdown d-none d-lg-block">
               <!-----search modal-------->
                            <form>
                                <div class="input-group">
                                    <input type="text" class="form-control dropdown-toggle" placeholder="Search..." id="top-search">
                                    <span class="mdi mdi-magnify search-icon"></span>
                                    <button class="input-group-text btn-success" type="submit">Search</button>
                                </div>
                            </form>
                            <div class="dropdown-menu dropdown-menu-animated dropdown-lg" id="search-dropdown">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end Topbar -->
                    <!-- form content Content-->
                    <div class="card shadow-lg" style="width: 980px;height: 700px;margin-top: 20px;">
                
                <form action="" method="POST">
                        <div class="container-fluid text-center text-secondary">
                            <br><h4  style="color: teal;font-weight: bold;"><center><b>ADD NOW </center></b></h4><hr>
                            <div class="row">
                          <div class="col-md-6">  <div class="form-group">
                        <label class="form-label">fullname</label>
                        <input type="text" placeholder="" class="form-control shadow" value="" name="fullname" required autocomplete="off" style="border-radius: 20px;height: 50px;">
                        </div>
                       </div>

                           <div class="col-md-6">   
                         <div class="form-group">
                                <label class="form-label">Gender</label>
                            <select class="form-select"name="gender"  autocomplete="off" style="height: 50px;border-radius: 20px"> required>
                       <option selected></option>
                       <option>Male</option>
                       <option>Female</option>
                       <option>Others</option>
                           </select>
                             </div> </div> </div>
                    
                     <di class="row" style="margin-top: 25px;">
                                <div class="col-md-4">  
                                    <div class="form-group">
                                    <label class="form-label">Occupation</label>
                                    <input type="text" placeholder="" class="form-control shadow"  name="occupation" required autocomplete="off" style="border-radius: 20px;height: 50px;">
                                 </div>
                                   </div>
                                    <div class="col-md-4">   
                                        <div class="form-group">
                                         <label class="form-label">Postal Code</label>
                                         <input type="text" placeholder="" class="form-control shadow" value="" name="postal_codes" required autocomplete="off" style="height: 50px;border-radius: 20px;">
                                            </div>
                                        </div>
                                          <div  class="col-md-4">
                                           <button type="submit" name="post_deletedcitzen_data" class="btn btn-primary" style="margin-left:30px;margin-top:45px;border-radius: 40px;width: 150px;">Enroll now</button>
                                      </div>
                                    </div>
                                    </div>   
                        </form>
                    </div> </div>
                </div>
 </div> </div>
 <div class="rightbar-overlay">
 </div> 
 <!-- /Ends -->




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


  
                                     
                                        