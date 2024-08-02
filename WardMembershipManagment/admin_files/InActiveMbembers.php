
<?php
include("../include/connection.php");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title> Shifted Account Pannel</title>
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
            <div class="leftside-menu" style="background-color:  #003e6a;">
                <div class="h-100" id="leftside-menu-container" data-simplebar="">
                    <!--- Sidemenu -->
                    <ul class="side-nav">
                        <li class="side-nav-item">
                            <a data-bs-toggle="collapse" href="#sidebarDashboards" aria-expanded="false" aria-controls="sidebarDashboards" class="side-nav-link">
                                <i class="uil-user" style="color:white;font-size:30px;font-weight: bold;"></i>
                                <span style="color: white;font-size:12px;">STREET MEMBER ACCOUNT </span>
                            </a>
                        </li>

          <!------------advisor account----------->
                        <li class="side-nav-item">
                            <a data-bs-toggle="collapse" href="#sidebarEcommerce" aria-expanded="false" aria-controls="sidebarEcommerce" class="side-nav-link">
                                <i class="uil-home-alt" style="color:white;font-size:40px"></i>
                                <span style="color:white;margin-left:10px"><b>BACK HOME</b> </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <!-----advisors modal-->
                            <div class="collapse" id="sidebarEcommerce">
                                <ul class="side-nav-second-level">
                                    <li>
                                        <a href="./Dashboard.php" style="color: white;">back now</a>
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
                    </div>
                    <!-- end Topbar -->
                    <!-- form content Content-->
                    <div class="card shadow-sm" style="width: 997px;margin-top: 10px;">
                       <div class="container-fluid text-success text-center">
                        <div class="row">
                            <div class="col-md-12">
                                <br><br>
                                <h4 style="color: #003e6a;font-weight: bold;"><center>SHIFTED MEMBERS ACCOUNT</center></h4>
                                <br>
                                <br>
                                 <input class = "form-control" id = "demo" type = "text" placeholder = "Seach here,..">
                                <br>
                                <table id="brandList" class="table table-striped  datatable " style="font-size: 15px;">
                                    <thead>
                                        <tr>
                                            <th>S/N</th>
                                            <th>Name</th>
                                            <th>Gender</th>
                                            <th>Occupation</th>
                                              <th>Postal Codes</th>
                                               <th>Created_At</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody id="test">
                                        <tr>
                                             <?php 
                                             $count_deletedstreet_member=1;
                 $select_hoseer_keepers = "select * from deletedcitizen_tbl" or die(mysqli_error($connect));
                 $result = mysqli_query($connect,$select_hoseer_keepers);
                 $number = mysqli_num_rows($result);
                 if ($number > 0) {
                     while($row = mysqli_fetch_assoc($result)) { ?>       
                          <tr>
                              <td class="text-center"><?php echo $count_deletedstreet_member ?></td>
                              <td class="text-center"><?php echo $row['fullname'];?></td>
                                  <td class="text-center"><?php echo $row['gender'];?></td>
                                   <td class="text-center"><?php echo $row['occupation'];?></td>
                                   <td class="text-center"><?php echo $row['postal_codes'];?></td>
                                   <td class="text-center"><?php echo $row['created_at'];?></td>
                                  <td>
                                    <p>
                                 <a href="EditInActive.php?cit_id=<?php echo $row['cit_id'] ?>"><button class="btn btn-warning">Edit</button>
                     </p>
                            </td>
                                        </tr>
                                        <?php $count_deletedstreet_member++?>
                            <?php } }  else {
  echo "0 results";
}?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                       </div>
                    </div>
                              
</div>
</div>
 </div> </div>
 <div class="rightbar-overlay"></div> <!-- /End-bar -->

 <!-- bundle -->
        <script src="assets/js/vendor.min.js"></script>
        <script src="assets/js/app.min.js"></script>

        <!-- third party js -->
        <script src="assets/js/vendor/Chart.bundle.min.js"></script>
        <!-- third party js ends -->
 <!-- third party js -->
        <script src="assets/js/vendor/Chart.bundle.min.js"></script>
        <!-- third party js ends -->

      <script>
         $(document).ready(function(){
            $("#demo").on("keyup", function() {
               var value = $(this).val().toLowerCase();
               $("#test tr").filter(function() {
                  $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
               });
            });
         });
      </script>

    </body>
</html>
