
<?php
include("../include/connection.php");

//post citizen data
if (isset($_POST["post_citzen_data"])) {
  $fullname = $_POST['fullname'];
 $gender = $_POST['gender'];
 $date_OfBirth =$_POST['date_OfBirth'];
 $education_level= $_POST['education_level'];
  $health_status = $_POST['health_status'];
  $occupation = $_POST['occupation'];
  $phone = $_POST['phone'];
  $postal_codes = $_POST['postal_codes'];
  $house_ownership = $_POST['house_ownership'];
  $email = $_POST['email'];
  $password = md5($_POST['password']);

  $insert_new_citizen = "INSERT INTO citizen_tbl (fullname,gender,date_OfBirth,education_level,health_status,occupation,phone,postal_codes,house_ownership,email,password)
      VALUES('$fullname','$gender','$date_OfBirth','$education_level','$health_status','$occupation','$phone','$postal_codes','$house_ownership','$email','$password');";

  if (mysqli_query($connect, $insert_new_citizen)) {
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
        <title>Sreet registration part</title>
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
            <div class="leftside-menu" style="background-color:#003e6a;">
                <div class="h-100" id="leftside-menu-container" data-simplebar="">
                    <!--- Sidemenu -->
                    <ul class="side-nav">
                        <li class="side-nav-item">
                            <a data-bs-toggle="collapse" href="#sidebarDashboards" aria-expanded="false" aria-controls="sidebarDashboards" class="side-nav-link">
                                <i class="uil-user" style="color:white;font-size:30px;font-weight: bold;"></i>
                                <span style="color: white;font-size:12px;">REGISTER STREET MEMBER </span>
                            </a>
                        </li>
                        
          <!------------advisor account----------->
                        <li class="side-nav-item">
                            <a data-bs-toggle="collapse" href="#sidebarEcommerce" aria-expanded="false" aria-controls="sidebarEcommerce" class="side-nav-link">
                                <i class="uil-home-alt" style="color:white;font-size:40px"></i>
                                <span style="color:white;margin-left:15px;font-size:12px;"><b>BACK IN BASHBOARD</b> </span>
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
                            <div class="dropdown-menu dropdown-menu-animated dropdown-lg" id="search-dropdown">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end Topbar -->
                    <!-- form content Content-->
                    <div class="card shadow-lg" style="width: 980px;height: 700px;margin-top: 20px;">
                        
                        <!-------registration form---------------------->
                    <form action="" method="POST">
                    <div class="container-fluid text-center text-secondary">
                            <br><h4  style="color:#003e6a;font-weight: bold;"><center>STREET MEMBER REGISTRATION</center></b></h4><hr>
                            <div class="row">
                     <div class="col-md-4">  <div class="form-group">
                        <label class="form-label">full name</label>
                        <input type="text" placeholder="" class="form-control shadow" value="" name="fullname" required autocomplete="off" style="height: 50px;border-radius:5px">
              </div>
            </div>

            <div class="col-md-4">   
                <div class="form-group">
                    <label class="form-label">Gender</label>
                    <select class="form-select"name="gender"  autocomplete="off" style="height: 50px;border-radius:5px"> required>
                       <option selected></option>
                       <option>Male</option>
                       <option>Female</option>
                   </select>
                       </div>
                </div>
                <div class="col-md-4"> 
                     <div class="form-group">
                    <label class="form-label">Date Of Birth</label>
                    <input type="date" placeholder="" class="form-control shadow" value="" name="date_OfBirth" required autocomplete="off" style="height: 50px;border-radius:5px">
                </div>
                   </div>
                    </div>
                            <div class="row" style="margin-top: 15px;">
                                <div class="col-md-4">   
                                    <div class="form-group">
                                     <label class="form-label">Education Level</label>
                                     <select class="form-select" name="education_level"  autocomplete="off" style="height: 50px;border-radius:5px"> required>
                                        <option selected></option>
                                        <option>Primary</option>
                                        <option>Secondary</option>
                                        <option>Tertialy</option>
                                        <option>None of the above</option>
                                    </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4"> 
                                         <div class="form-group">
                                        <label class="form-label">Health Status</label>
                                        <input type="text" placeholder="" class="form-control shadow" value="" name="health_status" required autocomplete="off" style="height: 50px;border-radius:5px">
                                    </div>
                                       </div>
                                       <div class="col-md-4">  
                                        <div class="form-group">
                                        <label class="form-label">Occupation</label>
                                        <input type="text" placeholder="" class="form-control shadow" value="" name="occupation" required autocomplete="off" style="height: 50px;border-radius:5px">
                                    </div>
                                       </div>
                            </div>
                            <div class="row" style="margin-top: 25px;">
                                <div class="col-md-4">  
                                    <div class="form-group">
                                    <label class="form-label">Phone/Contact</label>
                                    <input type="number" placeholder="" class="form-control shadow" value="" name="phone" required autocomplete="off" style="height: 50px;border-radius:5px">
                                </div>
                                   </div>
                                    <div class="col-md-4">   
                                        <div class="form-group">
                                         <label class="form-label">Postal Code</label>
                                         <input type="text" placeholder="" class="form-control shadow" value="" name="postal_codes" required autocomplete="off" style="height: 50px;border-radius:5px">
                                            </div>
                                        </div>
                                        <div class="col-md-4">   
                                            <div class="form-group">
                                                <label class="form-label">House Ownership</label>
                                                <select class="form-select" name="house_ownership"  autocomplete="off" style="height: 50px;border-radius:5px"> required>
                                                   <option selected></option>
                                                   <option>Rented</option>
                                                   <option>Owned</option>
                                                   <option>Others</option>
                                               </select>
                                                   </div>
                                            </div>
                                <div class="row" style="margin-top: 25px;">
                                    <div  class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Email</label>
                                            <input type="email" placeholder="" class="form-control shadow" value="" name="email" required autocomplete="off" style="height: 50px;border-radius:5px;">
                                  </div>
                                    </div>
                                     <div  class="col-md-4">
                                 <div class="form-group">
                                                 <label class="form-label">Password</label>
                                                 <input type="text" placeholder="" class="form-control shadow" value="" name="password" required autocomplete="off" style="height: 50px;border-radius:5px;">
                                      </div>
                                     </div>
                                      <div  class="col-md-4">
                                           <button type="submit" name="post_citzen_data" class="btn btn-primary" style="margin-left:30px;margin-top:45px;border-radius: 40px;width: 150px;">Register</button>
                                      </div>
                                    </div>
                        </div>   
                        </form>
                    </div>
                            </div>
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


  
                                     
                                        